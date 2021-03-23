<?php

/** *****************************************************************************/

namespace App\Http\Controllers;
/** *****************************************************************************/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/** *****************************************************************************/
class MainController extends Controller
{
    /** *************************************************************************/
    public static $sortbydate = false;
    public static $sortbyprice = false;
    /** *************************************************************************/
    public function index(Request $request)
    {
        $page = $request->has('page') ? ((int)$request->get('page') - 1) : 0;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $sortbydate = $request->has('sortbydate') ? ($request->get('sortbydate') === 'true') : false;
        $sortbyprice = $request->has('sortbyprice') ? ($request->get('sortbyprice') === 'true'): false;

        $shema = 'ad.';

        $db = DB::table($shema . 'main')
            ->join($shema . 'images', $shema . 'main.images', '=', $shema . 'images.id_main')
            ->select($shema . 'main.id', $shema . 'main.name', $shema . 'main.price', $shema . 'main.created_by', $shema . 'main.description', $shema . 'images.url')->where($shema . 'images.isMain', 1)
            ->orderBy($shema . 'main.created_by', $sortbydate ? 'DESC' : 'ASC')
            ->orderBy($shema . 'main.price', $sortbyprice ? 'DESC' : 'ASC')
            ->offset($limit * $page)
            ->take($limit);

        return view('index', [
            'data' => $db->get(),
            'paginator' => $db->paginate($limit)
        ]);
    }
    /** *************************************************************************/
}
/** *****************************************************************************/
