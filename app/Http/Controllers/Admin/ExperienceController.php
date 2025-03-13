<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experience = Experience::first();
        return view('admin.experience.index', compact('experience'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $request->validate([
            'title' => ['required', 'max:200'],
            'description' => ['required', 'max:1000'],
            'image' => ['image', 'max:5000'],
            'phone' => ['nullable', 'max:13'],
            'email' => ['email', 'nullable', 'max:100']
        ]);

        $experience = Experience::first();
        $imagePath = handleUpload('image', $experience);
        Experience::updateOrCreate(
            ['id' => $id],
            [

                'title' => $request->title,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
                'image' => (!empty($imagePath) ? $imagePath : $experience->image)
            ]
        );

        toastr()->success('Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
