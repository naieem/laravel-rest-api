<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Firebase\JWT\JWT;
use App\Task;
use Illuminate\Support\Facades\DB;
use Faker;
use App\Http\Requests\UploadRequest;
use App\Product;
use App\ProductPhoto;
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

    /*
     * file upload checking
     */
    public function fileUpload(Request $request){
        if ($request->file('photo')->isValid()) {
            return response()->json([
                'fileInfo'=>$request->file('photo')->getFilename()
            ]);
        }else{
            return response()->json([
                'error'=>'file is not valid'
            ]);
        }
    }
    /*
     * Getting all information
     */
    public function getData(){
//        $users = DB::select('select * from tasks'); // getting all record
//        $users = DB::table('tasks')->get(); // getting all record
//        $users = DB::table('tasks')->pluck('title'); // getting only a specific field
        $users = Task::all(); // getting all data using model
        $users = Task::find(1);
        return response()->json([
            'information'=>$users
        ]);
    }
    /*
     * update query api endpoint
     * Sample query string
     * {
            "datas":{
                "name":"naieem",
                "title":"hello world"
            },
            "field":{
                "fieldName":"id",
                "value":"1"
            }
        }
     */
    public function updateData(Request $request){
        $temparray = array();
        $queryStr="update tasks set ";
        if(gettype($request->datas) == 'array'){
            $lnth=count($request->datas);
            $count=0;
            foreach ($request->datas as $key => $value) {
                $count++;
                $queryStr .=$key."='$value'";
                if($count != $lnth)
                    $queryStr .=',';
            }
        }
        $queryStr.=' where '.$request->field['fieldName'].'='.$request->field['value'];
        $affected = DB::update($queryStr);
        if($affected)
            $isupdated=true;
        else
            $isupdated=false;

        return response()->json([
            "query"=>$queryStr,
            'isUpdate'=>$isupdated
        ]);
    }

    /*
     * Generating dummy data
     */
    public function generateData(){
        $faker = Faker\Factory::create();
        $info=array();
        for ($i=0; $i < 10; $i++) {
            array_push($info,[
                'name'=>$faker->name(),
                'title'=>$faker->title,
                'city'=>$faker->city,
                'country'=>$faker->country,
                'email'=>$faker->email,
                'url'=>$faker->url,
                'imageUrl'=>$faker->imageUrl(640,480),
                'itemId'=>$faker->uuid
            ]);
        }
        $insert=DB::table('infos')->insert($info);
        return response()->json([
            'information'=>$insert
        ]);
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

    public function uploadFile(Request $request)
    {
        $product = Product::create($request->all());
        if($file = $request->hasFile('photos')) {

            $file = $request->file('photos');
            $fileName = $file->getClientOriginalName();
            ProductPhoto::create([
                'product_id' => $product->id,
                'filename' => $fileName
            ]);
            $destinationPath = public_path().'/images/' ;
            $file->move($destinationPath,$fileName);
        }
        return response()->json([
            'UploadedPath'=>public_path(),
            'result'=>'File information saved succesfully'
        ]);
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
