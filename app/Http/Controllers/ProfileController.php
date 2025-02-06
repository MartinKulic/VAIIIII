<?php

namespace App\Http\Controllers;

use App\Helpers\Submission;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Fav;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request, string $userID, string $what): View
    {
        $user = User::find($userID);
        if(!$user)
        {
            abort(404, 'User not found.');
        }

        $images = [];

        if($what === 'Fav') {

//            select * from images
//              where id in (select image_id from favs where user_id = $userID);

            $images = Image::whereIn('id', function($query) use ($userID) {
                $query->select('image_id')
                    ->from('favs')
                    ->where('user_id', $userID);
            })->orderBy('created_at','DESC')->paginate(16);
        }
        else{
            $images = Image::where("autor_id", $userID)->orderBy('created_at','DESC')->paginate(16);
        }
        return view('profile.index',[
            "images" => $images,
            "userName" => $user->name,
        ]);
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
