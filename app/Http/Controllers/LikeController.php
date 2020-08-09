<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //
    public function create(Request $request){
        $user_id = Auth::user()->id;

        if(Like::where('item_id',$request->item_id)->where('user_id',$user_id)->count() > 0){
            return response()->json(['message' => 'duplicate entry'],400);
        }else{
            $like = Like::create([
                'user_id' => $user_id,
                'item_id' => $request->item_id,
            ]);

            return response()->json(['message' => 'request successfull'],201);
        }


    }

    public function delete($item_id){
        $user_id = Auth::user()->id;
        $like = Like::where('user_id',$user_id)->where('item_id',$item_id)->first();
        if($like){
            $unlike = Like::findOrFail($like->id);
            $unlike->delete();

            return response()->json(['message' => 'item has been unliked'],200);
        }else{
            return response()->json(['message' => 'can not find the the resource'],404);
        }
    }

    public function list($item_id){
        $likes = Like::select('id','user_id')->with('user')->where('item_id',$item_id)->get();
        if($likes->count() > 0){
            return response()->json(['like-data' => $likes],200);
        }else{
            return response()->json(['message' => 'You dont have any likes yet '],200);
        }
    }
}
