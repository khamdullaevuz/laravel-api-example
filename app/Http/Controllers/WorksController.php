<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Works;
use Validator;

class WorksController extends Controller
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
            'message'=>"Works found!",
            'data'=>Works::all()
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
            'description'=>'required|min:10|max:500|string',
            'amount'=>'required|integer'
        ]);

        if($validator->fails()){
            return [
                'success'=>false,
                'message'=>$validator->errors()
            ];
        }
        
        $response = Works::create($request->all());

        return [
            'success'=>true,
            'message'=>"Work added!",
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
        $data = Works::find($id);
        if($data){
            return [
                'success'=>true,
                'message'=>"Work found!",
                'data'=>$data
            ];
        }else{
            return [
                'success'=>false,
                'message'=>"Work not found!"
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
            'description'=>'required|min:10|max:500|string',
            'amount'=>'required|integer'
        ]);

        if($validator->fails()){
            return [
                'success'=>false,
                'message'=>$validator->errors()
            ];
        }
        
        $response = Works::whereId($id)->update($data);

        if($response){
            return [
                'success'=>true,
                'message'=>"Work updated!",
            ];
        }else{
            return [
                'success'=>false,
                'message'=>"Work not found!",
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
        $data = Works::destroy($id);
        if($data){
            return [
                'success'=>true,
                'message'=>"Work deleted"
            ];
        }else{
            return [
                'success'=>false,
                'message'=>"Work not found"
            ];
        }
    }
}
