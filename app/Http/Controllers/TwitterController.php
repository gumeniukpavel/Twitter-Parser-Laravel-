<?php

namespace App\Http\Controllers;

use App\Twitter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Parse;

class TwitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Twitter::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $parser = new Parse();
        $twitterId = $request->input("twitterId");
        $data = $parser->getData($twitterId);

        if($data){
            $twitter = Twitter::create($data);

            if( $twitter ){
                return $twitter;
            }else{
                return response(['error' => 'Don`t save'], 500);
            }
        }
        return response(['error' => 'Don`t find data'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Twitter::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $parser = new Parse();
        $data = $parser->getData($id);

        if( $data ){
            $twitter = Twitter::findOrFail($id);
            $twitter->update($data);
    
            return response()->json($twitter);
        }
        return response(['error' => 'Don`t find data'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $twitter = Twitter::findOrFail($id);
        if($twitter->delete()) return response(null, 204);
    }
}
