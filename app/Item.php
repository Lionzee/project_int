<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    //
    protected $table = 'items';

    protected $fillable = [
        'image_url', 'item_name', 'item_description','user_id'
    ];

    public function getLikesCountAttribute(){
        return DB::table('likes')->where('likes.item_id',$this->id)->sum('likes.id');
    }

    public $appends = ['likes_count'];
}
