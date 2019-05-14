<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DiDom\Document;

class Parse extends Controller
{
    public function getData($twitterId){

        if(!empty($twitterId)){
            $url = "https://twitter.com/".$twitterId;
            $response = $this->getResponse($url);
    
            if($response){
                $result = $this->parse($url);
                $result["twitterId"] = $twitterId;
                return $result;
            }
    
            return false;
        }
        return false;
    }

    protected function getResponse($url){

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_TIMEOUT,10);
        $output = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($httpcode=="200"){
            return true;
        }

        return false;
    }
    
    protected function parse($url){

        $document = new Document($url, true);
        $photo = $document->find('.ProfileAvatar-image')[0]->getAttribute('src');
        $name = $document->find('.ProfileHeaderCard-nameLink')[0]->text();
        $description = $document->find('.ProfileHeaderCard-bio')[0]->text();
        $tweets = $this->getTweets($document);
        $following = $this->getFollowing($document);
        $followers = $this->getFollowers($document);
        $likes = $this->getLikes($document);

        $result = array(
            "photo" => $photo,
            "name" => $name,
            "description" => $description,
            "tweets" => (int)$tweets,
            "following" => (int)$following,
            "followers" => (int)$followers,
            "likes" => (int)$likes
        );

        return $result;
    }

    protected function getTweets($document){
        if($document->find('.ProfileNav-item--tweets .ProfileNav-value')){
            $tweets = $document->find('.ProfileNav-item--tweets .ProfileNav-value')[0]->getAttribute('data-count');
        }else{
            $tweets = 0;
        }

        return $tweets;
    }

    protected function getFollowing($document){
        if($document->find('.ProfileNav-item--following .ProfileNav-value')){
            $following = $document->find('.ProfileNav-item--following .ProfileNav-value')[0]->getAttribute('data-count');
        }else{
            $following = 0;
        }

        return $following;
    }

    protected function getFollowers($document){
        if($document->find('.ProfileNav-item--followers .ProfileNav-value')){
            $followers = $document->find('.ProfileNav-item--followers .ProfileNav-value')[0]->getAttribute('data-count');
        }else{
            $followers = 0;
        }

        return $followers;
    }

    protected function getLikes($document){
        if($document->find('.ProfileNav-item--favorites .ProfileNav-value')){
            $likes = $document->find('.ProfileNav-item--favorites .ProfileNav-value')[0]->getAttribute('data-count');
        }else{
            $likes = 0;
        }

        return $likes;
    }
}
