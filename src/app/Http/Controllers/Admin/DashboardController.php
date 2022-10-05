<?php

namespace App\Http\Controllers\Admin;


use App\Models\StampCard;
use App\Models\User;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Store;
use App\Repositories\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function __construct(
        UserRepositoryInterface $user_repository
    ) {
        $this->middleware('auth:admin');
        $this->user_repository = $user_repository;
    }


    public function index(Request $request)
    {
        // カウント
        $user_count = User::count();
        // グラフ
        $user_count_graph = User::whereNull('left_at')->count();
        $product_count = Product::count();
        $coupon_count = Coupon::count();
        $store_count = Store::count();
        $stamp_card_count = StampCard::count();

        // お気に入り商品ランキング
        $products = Product::open()
            ->limited()
            ->favorite()
            ->having('favorites_count', '>', 0)
            ->limit(10)
            ->get();

        return view('admin.dashboard.index', [
            'user_count' => $user_count,
            'product_count' => $product_count,
            'coupon_count' => $coupon_count,
            'store_count' => $store_count,
            'stamp_card_count' => $stamp_card_count,
            'products' => $products,
            'user_count_graph' => $user_count_graph
        ]);
    }

    public function getRanks()
    {
        return DB::table('products as a')
            ->select(
                'name',
                'favorites_count',
                DB::raw(
                    "(select count(favorites_count) FROM products b WHERE a.favorites_count < b.favorites_count) + 1 as rank"
                )
            )
            ->whereNotNull('a.favorites_count')
            ->orderBy('rank', 'ASC')
            ->get();
    }

    public function _getGraphDataForCustomerCount (Request $request) {

        $now = new \DateTime(date('Y/m/d'));
        if ($request->get('type') == 'monthly') {
            $start = new \DateTime(date('Y/m/d', strtotime(data_get($request, 'start', date('Y/m/d', strtotime('-1 year'))))));
            $end = new \DateTime(date('Y/m/d', strtotime(data_get($request, 'end', date('Y/m/d')))));
        } else {
            $start = new \DateTime(date('Y/m/d', strtotime(data_get($request, 'start', date('Y/m/d', strtotime('-3 year'))))));
            $end = new \DateTime(date('Y/m/d', strtotime(data_get($request, 'end', date('Y/m/d')))));
        }

        $now_end_diff = $end->diff($now);
        $now_end_month_diff = $now_end_diff->y * 12 + $now_end_diff->m;
        $now_end_day_diff = $now_end_diff->days;

        if ($request->get('type') == 'monthly') {
            // 月別
            $diff = $start->diff($end);
            $month_diff = $diff->y * 12 + $diff->m;

            $labels = [];
            $data = [];
            for($i = 0; $i < $month_diff + 1; $i++) {
                $labels[] = Carbon::parse($start->format('Y-m-d'))->addMonthsNoOverflow($i)->format('y/m');
                $data[] =  $this->user_repository->getUsersInAMonth($now_end_month_diff + ($month_diff - $i));
            }
        } else {
            // 日別
            $diff = $start->diff($end);
            $day_diff = min($diff->days, 365);
            $labels = [];
            $data = [];
            for($i = 0; $i < $day_diff + 1; $i++) {
                $labels[] = Carbon::parse($start->format('Y-m-d'))->addDay($i)->format('m/d');
                $data[] =  $this->user_repository->getUsersInADay($now_end_day_diff + ($day_diff - $i));
            }
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
