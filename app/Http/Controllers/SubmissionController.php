<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function __construct()
    {
        //$this->autorizeResource(Image::class, 'image');
    }

    public function create()
    {
        return view('submission.add',[
            'action' => route('submission.store'),
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
