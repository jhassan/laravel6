<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Provider;
use DB;

class ProviderController extends Controller
{

  public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $provider = Provider::all();
      return response()->json(['success' => $provider], $this-> successStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      // echo "provider"; die;
      $validator = Validator::make($request->all(), [
          'provider_name' => 'required',
          'logo' => 'required'
      ]);
      if ($validator->fails()) {
              return response()->json(['error'=>$validator->errors()], 401);
          }
      $input = $request->all();
          // $input['provider_name'] = bcrypt($input['password']);
          $provider = Provider::create($input);
          $success['token'] =  $provider->createToken('MyApp')-> accessToken;
          $success['provider_name'] =  $provider->provider_name;
      return response()->json(['success'=>$success], $this-> successStatus);
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
      print_r($request); die;
      DB::table('providers')
          ->where('id', $id)
          ->update(['provider_name' => $request->provider_name,
                    'logo'  => $request->logo
        ]);
        return response()->json(['success' => "update record successfully"], $this-> successStatus);
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
