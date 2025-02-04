<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fav;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavController extends Controller
{
    public function create(Image $img)
    {
        Fav::creade([
           "user_id" => Auth::id(),
           "image_id" => $img->id,
        ]);

        return response()->json([
            "faved"=>true
        ]);
    }

    public function delete(Fav $fav)
    {
        $fav->delete();
        return response()->json([
            "faved" => false
        ]);
    }

    public function favToggle(Request $request){
        $request->validate([
            'imgID' => 'required|integer',
        ]);
        $imgID = $request->imgID;
        $img = Image::find($imgID);
        if(is_null($img)){
            return response()->json(['error'=>'img not found']);
        }

        $fav = Fav::where('image_id', $imgID)->where('user_id', Auth::id())->first();
        if(is_null($fav)){
            Fav::create([
                "user_id" => Auth::id(),
                "image_id" => $img->id,
            ]);

            return response()->json([
                "faved"=>true
            ]);
        }
        else{
            $fav->delete();
            return response()->json([
                "faved" => false
            ]);
        }
    }
}
