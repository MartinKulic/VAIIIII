<?php

namespace App\Http\Controllers;

use App\Helpers\Submission;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $images = Image::orderBy('created_at','DESC')->get();

        return view('home.index', [
            "images" => $images,
        ]);
    }

    public function detail(Request $request, int $imgID)
    {
        if (!is_numeric($imgID)) {
            abort(404, 'Invalid image ID');
        }

        $submission = new Submission($imgID, Auth::id());

        return view('home.detail', [
            "submission" => $submission
        ]);
    }
}
