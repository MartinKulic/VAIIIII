<?php



namespace App\Http\Controllers;

use App\Helpers\Submission;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
//        SELECT images.*, COALESCE(SUM(ratings.value), 0) AS total_ratings
//        FROM images
//        LEFT JOIN ratings ON images.id = ratings.image_id and
//          ratings.updated_at between ADD_MONTHS((select NOW()), -1) and (SELECT NOW())
//        GROUP BY id
//        ORDER BY total_ratings DESC;

        $startDate = Carbon::now()->subMonth();
        $endDate = Carbon::now();

        $images = Image::select('images.*')
            ->selectRaw('COALESCE(SUM(ratings.value), 0) AS total_ratings')
            ->leftJoin('ratings', function($join) use ($startDate, $endDate) {
                $join->on('images.id', '=', 'ratings.image_id')
                    ->whereBetween('ratings.updated_at', [$startDate, $endDate]);
            })
            ->groupBy('images.id', 'images.path', 'images.name', 'images.desc', 'images.caption', 'images.autor_id', 'images.created_at', 'images.updated_at')
            ->orderByDesc('total_ratings')
            ->take(10)
            ->paginate(self::PAGING);

        return view('home.index', ["images" => $images]);
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
