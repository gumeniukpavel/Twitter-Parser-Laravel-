<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Twitter extends Model
{
    protected $table = 'twitters';

    protected  $primaryKey = 'twitterId';

    public $incrementing = false;

    // id - айди записи
    // photo - фото профиля
    // name - название профиля
    // twitterId - айди в Twitter
    // description - описание профиля
    // tweets - количество tweets
    // following - количество following
    // followers - количество followers
    // likes - количество likes
    protected $fillable = [
        "id", "photo", "name", "twitterId", "description", "tweets", "following", "followers",  "likes"
    ];
}
