<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Picture;
use App\Models\Favorite;
use App\Models\MAllergy;
use App\Models\ProductMAllergy;
use App\Models\ProductSearch;
use App\Models\MProductCategory;
use App\Repositories\ProductRepositoryInterface;
use App\Services\DynamicLink\GeneratorInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Kreait\Firebase\DynamicLink\CreateDynamicLink\FailedToCreateDynamicLink;
use Session;

class ProductController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {

        $url = request()->fullUrl();
        $request->session()->put('back_url', $url);

        $search = new ProductSearch();
        $product = new Product;
        $params = $request->query();

        $product = $this->productRepository->search($search->fill($params))
            ->sortable()
            ->withCount('favorites')
            ->orderBy('status', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.product.index', [
            'title' => '商品管理',
            'm_product_category' => MProductCategory::pluck('name', 'id')->toArray(),
            'm_allergies' => MAllergy::pluck('name', 'id')->toArray(),
            'product' => $product,
            'search' => $search,
        ]);
    }

    public function productExport()
    {
        $this->productRepository->productExport();
    }

    public function add()
    {
        return view('admin.product.add.index', [
            'm_product_category' => MProductCategory::pluck('name', 'id')->toArray(),
            'title' => '商品追加',
        ]);
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = new Product;
            //postデータ取得
            $data = $request->all();
            $product->fill($data)->save();
            // 画像保存
            $new_images = $data['path'];
            // ２枚の画像を保存しない場合 $max_image_count = 1
            // ２枚の画像を保存する場合 $max_image_count = 1 or 2
            $max_image_count = Arr::get($request, 'delete_flg') ? 1 : count($new_images);
            $disk = Storage::disk('s3');
            for ($i = 0; $i < $max_image_count; $i++) {
                if (array_key_exists($i, $new_images)) {
                    if ($new_images[$i]) {
                        $imagefile = $new_images[$i];
                        $path = $disk->putFile('product', $imagefile, 'public');
                        $paths = Picture::create([
                            // s3の保存先のパスを生成
                            'product_id' => $product->id,
                            // アップロードした画像のパスをpostデータにDBカラムに保存
                            'path' => $path,
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('message', "商品の追加に失敗しました。");
        }
        DB::commit();
        return redirect()->route('admin.product')->with('message', "商品情報を追加しました。");
    }


    public function detail(Request $request, Product $product)
    {
        $url = $request->session()->get('back_url');

        $favorites = (new Favorite())
            ->select('favorites.*')
            ->groupBy('favorites.id')
            ->leftJoin('products', 'favorites.product_id', '=', 'products.id')
            ->where('favorites.product_id', $product->id)
            ->paginate(5, ["*"], 'userpage');

        $favorites_count = $favorites->count();

        return view('admin.product.detail.index', [
            'title' => '商品情報詳細',
            'url' => $url,
            'product' => $product,
            'favorites' => $favorites,
            'favorites_count' => $favorites_count,
        ]);
    }

    public function edit(Product $product)
    {
        $product = Product::find($product->id);
        $image = $product->pictures;

        return view('admin.product.detail.edit.index', [
            'title' => '商品情報編集',
            'm_allergies' => MAllergy::pluck('name', 'id')->toArray(),
            'm_product_category' => MProductCategory::pluck('name', 'id')->toArray(),
            'product' => $product,
            'image' => $image,
        ]);
    }

    public function update(Product $product, ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();
            if (empty($data['recommend_flg'])) {
                $data['recommend_flg'] = null;
            }
            if (empty($data['online_flg'])) {
                $data['online_flg'] = null;
            }
            if (empty($data['limited_flg'])) {
                $data['limited_flg'] = null;
            }
            if (empty($data['online_flg'])) {
                $data['online_flg'] = null;
            }
            $product->fill($data)->save();
            if ($request->allergy) $product->mAllergies()->sync($request->allergy);
            if ($request->has('path')) {
                $disk = Storage::disk('s3');
                $images = $request->file('path');
                //DB上にある画像情報
                $pictures = Picture::where([
                    'product_id' => $product->id,
                ])->get();
                foreach ((array)$images as $key => $image_path) {
                    // s3に保存。
                    $path = $disk->putFile('product', $image_path, 'public');
                    if (!isset($pictures[$key])) {
                        $picture = new Picture();
                        $picture->product_id = $product->id;
                    } else {
                        $picture  = $pictures[$key];
                    }
                    $picture->path = $path;
                    $picture->save();
                }
            }
            if (!empty($request['delete_image_id'])) {
                $target_picture = Picture::find($request['delete_image_id']);
                Storage::disk('s3')->delete('product', $target_picture->path);
                $target_picture->delete();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('message', "商品の編集に失敗しました。");
        }
        DB::commit();
        return redirect()->route('admin.product.detail', $product)->with('message', "商品情報を更新しました。");
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $disk = Storage::disk('s3');
        $images = $product->pictures;
        foreach ($images as $image) {
            $file = $image->path;
            $disk->delete('product', $file);
        }

        $product->delete($id);
        return redirect()->route('admin.product')->with('message', "商品情報を削除しました");
    }

    /**
     * 商品一覧（カテゴリー別）の取得
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function order(Request $request)
    {
        if (Arr::get($request, 'm_product_category_id')) {
            $category = MProductCategory::find($request['m_product_category_id']);
        } else {
            $category = MProductCategory::find(1);
        }
        // 該当カテゴリーに属する商品を取得
        $products = Product::open()->category($category->id)->order()->get();
        return view('admin.product.order.index', [
            'category' => $category,
            'm_product_category' => MProductCategory::pluck('name', 'id')->toArray(),
            'products' => $products,
            'title' => '表示順設定',
        ]);
    }

    /**
     * 表示順の保存
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function orderStore(Request $request)
    {
        try {
            if (Arr::get($request, 'products')) {
                foreach ($request->products as $key => $id) {
                    Product::where('id', $id)->update([
                        'order' => ++$key
                    ]);
                }
            }
            return redirect()->back()->with('message', '表示順序を更新しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('message_error', '表示順序を更新できませんでした。');
        }
    }

    public function qrGenerate(Product $product, GeneratorInterface $dynamicLinkGenerator)
    {
        try {
            $product_url = $dynamicLinkGenerator->generate($product->id);
        } catch (FailedToCreateDynamicLink $e) {
            echo $e->getMessage(); exit;
        }

        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' .$product->name. '.png"',
        ];

        $qrcodeImage = QrCode::format('png')->size(400)->generate($product_url);
        return response($qrcodeImage, 200, $headers);
    }
}
