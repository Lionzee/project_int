<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //
    protected $table = 'likes';

    protected $fillable = [
        'item_id','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
