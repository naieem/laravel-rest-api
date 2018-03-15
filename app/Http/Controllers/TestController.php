<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Firebase\JWT\JWT;
class TestController extends Controller
{
    private $key="Hello_world";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function test(Request $request){
        return "hello world";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function generateToken(Request $request)
    {
        $now = time();
        $expired_time=$now + (1*60);
        $payload = array(
            "iat" => $now,
            "nbf" => $now,
            "exp" => $expired_time,
            "Data"=>$request->all()
        );
        $token=JWT::encode($payload,$this->key);
        return response()->json([
            "data"=>$request->all(),
            "token"=>$token
        ]);
    }

    public function verifyToken(Request $request)
    {
        $token = $request->header('Authorization');
        $decodedToken=JWT::decode($token,$this->key,array('HS256'));
        $result=[
            'status'=>'200',
            'data'=>$decodedToken
        ];
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
