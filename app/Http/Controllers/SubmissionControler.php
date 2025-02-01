<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionControler extends Controller
{
    public function create()
    {
        return view('submission.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('uploads', 'public');

        Image::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'image_path' => $path,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Obrázok bol úspešne nahraný!');
    }

    public function edit(Image $submission)
    {
        // Povoliť len vlastníkovi editáciu
        if ($submission->user_id !== Auth::id()) {
            abort(403, 'Nemáte oprávnenie na úpravu tohto obrázka.');
        }

        return view('submissions.edit', compact('submission'));
    }

    public function update(Request $request, Image $submission)
    {
        if ($submission->user_id !== Auth::id()) {
            abort(403, 'Nemáte oprávnenie na úpravu tohto obrázka.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $submission->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('home')->with('success', 'Obrázok bol upravený.');
    }


}
