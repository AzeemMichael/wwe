<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVideo;

class VideoController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreVideo  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVideo $request)
    {
//        if ($request->file('video')->getMimeType() !== 'video/x-m4v') {
//            return redirect()->back()->with('error', ['Unsupported file type given']);
//        }

        $path = $request->file('video')->store('videos');

        Video::create([
            'title' => $request->input('title'),
            'path' => $path
        ]);

        return redirect()->back(201)->with('success', 'File uploaded');
    }
}
