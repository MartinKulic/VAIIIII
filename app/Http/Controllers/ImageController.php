<?php

namespace App\Http\Controllers;

use App\Core\HTTPException;
use App\Helpers\RatingForImgInfo;
use App\Models\Image;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function create()
    {
        return view('submission.add',[
            'action' => route('image.store'),
            'purpose' => "add",
            'method' => 'post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3584',
            'desc' => 'nullable|string',
            'capt' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('uploads', 'public');

        Image::create([
            'autor_id' => Auth::id(),
            'name' => $request->title,
            'path' => $path,
            'desc' => $request->desc,
            'caption' => $request->capt
        ]);

        return redirect()->route('home')->with('success', 'Obrázok bol úspešne nahraný!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        return view('submission.edit',[
            'action' => route('image.update', ['image' => $image->id]),
            'purpose' => "edit",
            'method' => 'put',
            'model' => $image
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'capt' => 'nullable|string',
        ]);

        $image->update([
            'name' => $request->title,
            'desc' => $request->desc,
            'caption' => $request->capt
        ]);

        return redirect()->route('home')->with('success', 'Obrázok bol úspešne upraveny!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        Storage::disk('public')->delete($image->path);

        $image->delete();

        return redirect()->route('home')->with('success', 'Obrázok bol úspešne odstraneny!');
    }

    public function rate(Request $request, Image $image)
    {
        if (!$image->exists())
        {
            return response()->json(['error' => 'Image does not exist'], 402);
        }

        $voteVal = (int) $request->get('voted');
        if($voteVal == 0){
            return response()->json(['error' => 'Incorect value'], 402);
        }
        $ratingInfo = new RatingForImgInfo($image->id, Auth::id());
        $rating = $ratingInfo->getCurUserRate();


        // Ratin este neexistuje
        if (is_null($rating)) {
            $rating = new Rating();
            $rating->setImageId($image->id);
            $rating->setUserId(Auth::id());
            $rating->setValue($voteVal);

            $ratingInfo->setScore($ratingInfo->getScore() + $voteVal);

            if($voteVal > 0){
                $ratingInfo->setUp($ratingInfo->getUp()+1);
            }
            else if($voteVal < 0){
                $ratingInfo->setDown($ratingInfo->getDown()+1);
            }
            $rating->save();
            //$ratingInfo->setCurUserRateId($rating->getId());
        }

        // Rating uz existoval
        //Bol UP votnuty
        else if($ratingInfo->getCurUserVote() > 0){
            // zas upvote = zmaz
            if ($voteVal > 0) {
                $rating->delete();
                $ratingInfo->chngeUp(-1);
                $ratingInfo->deleteRateMem();
                $voteVal = 0;
            }
            // downvote
            else if($voteVal < 0){
                $ratingInfo->chngeUp(-1);
                $ratingInfo->chngeDown(1);
                $ratingInfo->chngeScore($voteVal);

                $rating->setValue($voteVal);
                $rating->save();

            }

        }
        //Bol DOWN votnuty
        else if ($ratingInfo->getCurUserVote() < 0){
            // zas downvote = zmaz
            if ($voteVal < 0) {
                $rating->delete();
                $ratingInfo->chngeDown(-1);
                $ratingInfo->deleteRateMem();
                $voteVal = 0;
            }
            // upvote
            else if($voteVal > 0){
                $ratingInfo->chngeUp(1);
                $ratingInfo->chngeDown(-1);
                $ratingInfo->chngeScore($voteVal);

                $rating->setValue($voteVal);
                $rating->save();
            }
        }
        $ratingInfo->setCurUserVote($voteVal);

        // Not implemented yet. for now just sent back what you recieve

        return response()->json([
            'score' => $ratingInfo->getScore(),
            'up' => $ratingInfo->getUp(),
            'down' => $ratingInfo->getDown(),
            'curUserVote' => $ratingInfo->getCurUserVote()
        ]);
    }
}
