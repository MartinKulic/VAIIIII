<?php



namespace App\Http\Controllers;

use App\Helpers\Submission;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    const PAGING = 64;
    public function index(Request $request)
    {
        $images = Image::orderBy('created_at','DESC')->paginate(self::PAGING);

        return view('home.index', [
            "images" => $images,
        ]);
    }

    public function najlepsieZa(Request $request, string $obdobie)
    {

    }

    public function search(Request $request)
    {
        $request->validate([
            "caption" => "string"
        ]);

        $caption = $request->caption;
        $tags = $request->tags;

        $dotaz = Image::orderBy('created_at','DESC');

        if (!empty($caption)) {
            if ( $caption == "_no_caption_")
            {
                $dotaz = $dotaz->where("caption", null);
            }
            else {
                $dotaz->where('caption', 'LIKE', '%'.$caption . '%');
            }
        }

        return view('home.index', [
            "images" => $dotaz->paginate(self::PAGING),
        ]);
    }

    public function detail(Request $request, int $imgID)
    {
        if (!is_numeric($imgID)) {
            abort(404, 'Invalid image ID');
        }

        $submission = new Submission($imgID, Auth::id());

        if (($submission->getImageId()) == 0) {
            abort(404, 'Image not found');
        }

        return view('home.detail', [
            "submission" => $submission
        ]);
    }
}
