<?php

namespace App\Http\Controllers;

use App\Item;
use Faker\Provider\File;
use Faker\Provider\Image;
use http\Env\Response;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    //

    public function create(Request $request){
        $user_id = Auth::user()->id;
        $statement = DB::select("SHOW TABLE STATUS LIKE 'items'");
        $nextId = $statement[0]->Auto_increment;
        $image = $request->file('item_image');
        $fileName = "item_image_".$nextId.".".$image->getClientOriginalExtension();
        $path  = $request->file('item_image')->move('storage/image/',$fileName);
        $imagepath = 'storage/image/'.$fileName;

       $item = Item::create([
            'user_id' => $user_id,
            'image_url' => $imagepath,
            'item_name' => $request->item_name,
            'item_description' => $request->item_desc,
        ]);


       return response()->json($item,201);
    }

    public function image_update(Request $request,$item_id){
        $user_id = Auth::user()->id;
        $item = Item::where('id',$item_id)->where('user_id',$user_id)->first();

        $path = explode('storage', $item->image_url);
        if(Storage::disk('public')->exists($path[1])){
            Storage::disk('public')->delete($path[1]);
        }
       $image = $request->file('item_image');
        $extension = $image->getClientOriginalExtension();
        $imageName = "item_image_".$item->id.".".$extension;
        $image_path = 'storage/image/'.$imageName;
        $image->move('storage/image/',$imageName);

        return response()->json(['item_data' => $item,'message' => 'item image has been updated'],200);
    }

    public function update(Request $request,$item_id){
        $user_id = Auth::user()->id;
        $item = Item::where('id',$item_id)->where('user_id',$user_id)->first();
        if($item){
            $item->item_name = $request->item_name;
            $item->item_description = $request->item_desc;
            $item->save();

            return response()->json(['item_data' => $item,'message' => 'item data has been updated'],200);
        }else{
            return response()->json(['message' => 'can not find the item id'],404);
        }
    }


    public function delete($item_id){
        $user_id = Auth::user()->id;
        $item = Item::where('id',$item_id)->where('user_id',$user_id)->first();
        if($item){
            $deleteitem = Item::findOrFail($item_id);;
            $deleteitem->delete();

            return response()->json(['message' => 'item has been deleted'],200);
        }else{
            return response()->json(['message' => 'can not find the item id'],404);
        }
    }

    public function viewAll(){
        $item = Item::all();
        if($item->count() > 0){
            return response()->json($item,200);
        }else{
            return response()->json(['message' => 'You dont have any dribble shots yet '],200);
        }
    }

    public function viewUserItems($user_id){
        $item = Item::where('user_id',$user_id)->get();
        if($item->count() > 0){
            return response()->json($item,200);
        }else{
            return response()->json(['message' => 'You dont have any dribble shots yet '],200);
        }
    }

}
