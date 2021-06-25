<?php

namespace App\Repositories;

use App\Http\Requests\CommonProductRequest;
use App\Models\CommonProduct;
use App\Models\CommonProductPhoto;
use App\Repositories\DocumentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Support\Carbon;
use Image;

class CommonProductRepository implements CommonProductRepositoryInterface
{
    public function __construct(
        DocumentRepositoryInterface $document_repository
    ) {
        $this->document_repository = $document_repository;
    }

    /**
     * マシン検索
     *
     * @param Request $request
     * @return CommonProduct
     */
    public function search(Request $request)
    {
        $query = CommonProduct::leftJoin('common_product_stocks', 'common_product_stocks.common_product_id', '=', 'common_products.id')
            ->groupBy('common_products.id')
            ->select('common_products.*')
            ->selectRaw("count(distinct common_product_stocks.id) as stock_count");

        if ($request->get('keyword')) {
            $search_array = space_array_conversion($request->get('keyword'));
            foreach ($search_array as $search_word) {
                $query->where(function($q) use ($search_word) {
                    $q->where('common_products.name', 'like', "%$search_word%")
                        ->orWhere('common_products.name_kana', 'like', "%$search_word%")
                        ->orWhere('common_products.name_abbreviation', 'like', "%$search_word%");
                });
            }
        }

        if ($request->get('common_product_category_id')) {
            $query = $query->where('common_products.common_product_category_id', $request->get('common_product_category_id'));
        }

        return $query;
    }

    /**
     * マシン作成
     *
     * @param CommonProductRequest $request
     * @return CommonProduct
     */
    public function store(CommonProductRequest $request)
    {
        $common_product = new CommonProduct;
        $data = $request->all();

        DB::beginTransaction();

        try {
            $common_product->fill($data)->save();

            $photos = $request->get('photos');

            if ($photos) {
                foreach ($photos as $photo) {
                    $common_product_photo = new CommonProductPhoto;
                    $common_product_photo->common_product_id = $common_product->id;
                    $common_product_photo->fill($photo);
                    $common_product_photo->save();
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return;
        }

        DB::commit();

        return $common_product;
    }

    /**
     * マシン更新
     *
     * @param CommonProduct $common_product
     * @param CommonProductRequest $request
     * @return CommonProduct
     */
    public function update(CommonProduct $common_product, CommonProductRequest $request)
    {
        $data = $request->all();

        DB::beginTransaction();

        try {
            $common_product->fill($data)->save();

            $photos = $request->get('photos');
            if ($photos) {
                foreach ($photos as $photo) {
                    if (isset($photo['id']) && $photo['id']) {
                        $common_product_photo = CommonProductPhoto::where('id', $photo['id'])->first();
                    }
                    if (!(isset($common_product_photo) && $common_product_photo)) {
                        $common_product_photo = new CommonProductPhoto;
                        $common_product_photo->common_product_id = $common_product->id;
                    }
                    $common_product_photo->fill($photo);
                    $common_product_photo->save();
                    unset($common_product_photo);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return;
        }

        DB::commit();

        return $common_product;
    }

    /**
     * マシン削除
     *
     * @param CommonProduct $common_product
     * @return CommonProduct
     */
    public function destroy(CommonProduct $common_product)
    {
        DB::beginTransaction();

        try {
            $common_product->delete();
        } catch (\Exception $e) {
            DB::rollback();
            return;
        }

        DB::commit();

        return $common_product;
    }
}
