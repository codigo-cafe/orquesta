<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrchestraRequest;
use App\Models\Orchestra;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;

class OrchestraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Orchestra/Index', [
            'orchestra' => Orchestra::first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orchestra  $orchestra
     * @return \Illuminate\Http\Response
     */
    public function update(OrchestraRequest $request, Orchestra $orchestra)
    {
        $data = $request->all();
        if ($request->hasFile('banner'))
        {
            $photoPath = str_replace('storage', 'public', $orchestra->banner);
            Storage::delete($photoPath);

            $file = $request->banner->store('public');
            // correct the date format
            $image = Image::make(Storage::get($file))
                ->widen(1280)
                ->limitColors(255)
                ->encode();

            Storage::put($file, (string) $image);
            $data['banner'] = Storage::url($file);
        }
        $orchestra->update($data);
        return redirect()->route('orchestra.index');
    }
}
