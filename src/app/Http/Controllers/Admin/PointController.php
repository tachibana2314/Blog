<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\PointSearch;
use App\Repositories\PointRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Storage;
use Session;

class PointController extends Controller
{
    public function __construct(PointRepositoryInterface $pointRepository)
    {
        $this->pointRepository = $pointRepository;
    }

    public function index(Request $request)
    {
        $url = request()->fullUrl();
        $request->session()->put('back_url', $url);

        $search = new PointSearch();
        $params = $request->query();

        $points = $this->pointRepository
            ->search($search->fill($params))
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.point.index', [
            'title' => 'ポイント景品管理',
            'points' => $points,
            'search' => $search,
        ]);
    }
}
