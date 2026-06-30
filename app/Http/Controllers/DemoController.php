<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index()
    {
        return view('demoindex');
    }

    public function index2()
    {
        $data = "ABC";

        return view('demoindex2', compact('data'));
    }

    public function index3()
    {
        return response()->json([
            'status' => true,
            'data' => [
                'name' => 'Sản phẩm 1',
                'price' => 240000
            ]
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
    public function index4($id)
{
    $data = "ABC" ;
    return view('demoindex4', compact('data','id'));
}
public function index5($id = null)
{
    $data = "ABC" ;
    return view('demoindex5', compact('data','id'));
}
public function index6($parram1, $parram2)
{
    $data = "Hệ thống Web 2";

    return view('demoindex6', [
        'data' => $data,
        'parram1' => $parram1,
        'parram2' => $parram2
    ]);
}


}
