<?php

namespace App\Http\Controllers\Api;

use App\Twitter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Parse;


class TwitterController extends Controller
{
    public function index()
    {
        $all = Twitter::orderBy('updated_at', 'desc')->get();;

        return view('index',[
            'all'=>$all
        ]);
    }

    public function store(Request $request)
    {

        $parser = new Parse();
        $twitterId = $request->input("twitterId");
        $data = $parser->getData($twitterId);

        if($data){
            if($twitter = Twitter::find($data["twitterId"])){
                $this->update($data, $twitter);
            }else{
                $twitter = Twitter::create($data);
            }
            return $this->show($twitter);
        }
        
        return Redirect::to('/')->with('message', 'User not found!');
    }

    public function update($data, $twitter)
    {
        foreach ($data as $key => $value) {
            $twitter->$key = $value;
        }

        $twitter->save();
    }

    public function refresh(Request $request)
    {
        $twitteId = $request->get("twitterId");
        $parser = new Parse();
        $data = $parser->getData($twitteId);
        $twitter = Twitter::find($data["twitterId"]);
        $this->update($data, $twitter);

        return Redirect::to('/')->with('message', 'Updated!');
    }

    public function destroy(Request $request)
    {
        $twitteId = $request->get("twitterId");
        $twitter = Twitter::findOrFail($twitteId);
        $twitter->delete();

        return Redirect::to('/')->with('message', 'Deteled!');
    }
    
    public function show($twitter)
    {
        return Redirect::to('/')->with('twitter', $twitter);
    }
}
