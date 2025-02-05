<?php

namespace App\Http\Controllers;

use App\Helpers\Submission;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request, string $userID, string $what): View
    {
        $submissions = array();
        if($what === 'Fav') {
            return view('profile.index');
        }
        else{
            $quie = Image::where("autor_id", $userID)->orderBy('created_at','DESC')->paginate(2);


            foreach ($quie as $image) {
                $newSub = new Submission($image->id, Auth::id());
                if ($newSub->getImageId() != 0)
                {
                    $submissions[] = $newSub;
                }
            }

            return view('profile.index',[
                "submissions" => $submissions
            ]);
        }

    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'profile deleted');
    }
}
