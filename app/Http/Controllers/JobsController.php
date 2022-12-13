<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobs;
use Validator;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'success'=>true,
            'message'=>"Jobs found!",
            'data'=>Jobs::all()
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required|min:5|max:100|string',
            'amount'=>'required|integer'
        ]);

        if($validator->fails()){
            return [
                'success'=>false,
                'message'=>$validator->errors()
            ];
        }
        
        $response = Jobs::create($request->all());

        return [
            'success'=>true,
            'message'=>"Job added!",
            'data'=>$response
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Jobs::find($id);
        if($data){
            return [
                'success'=>true,
                'message'=>"Job found!",
                'data'=>$data
            ];
        }else{
            return [
                'success'=>false,
                'message'=>"Job not found!"
            ];
        }
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'name'=>'required|min:5|max:100|string',
            'amount'=>'required|integer'
        ]);

        if($validator->fails()){
            return [
                'success'=>false,
                'message'=>$validator->errors()
            ];
        }
        
        $response = Jobs::whereId($id)->update($data);

        if($response){
            return [
                'success'=>true,
                'message'=>"Job updated!",
            ];
        }else{
            return [
                'success'=>false,
                'message'=>"Job not found!",
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Jobs::destroy($id);
        if($data){
            return [
                'success'=>true,
                'message'=>"Job deleted"
            ];
        }else{
            return [
                'success'=>false,
                'message'=>"Job not found"
            ];
        }
    }
}
