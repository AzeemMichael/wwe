<?php

namespace App\Http\Controllers;

use App\Models\Video;
//use App\Services\Flvinfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVideo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $videos = DB::table('videos')->paginate(15);

        foreach ($videos as $video) {
//            $flvinfo = new Flvinfo();
//            $info = $flvinfo->getInfo(asset("storage/{$video->path}"),true);

            $video->duration = $info['duration'] ?? 'na';
            $video->size = Storage::size($video->path);
            $video->format = Storage::getMimeType($video->path);
            $video->bitRate = $info['video']['bitrate'] ?? 'na';
        }

        return view('videos.index', ['videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreVideo $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreVideo $request)
    {
        $path = $request->file('video')->store('videos');

        Video::create([
            'title' => $request->input('title'),
            'path' => $path
        ]);

        return redirect()->back(201)->with('success', 'File uploaded');
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function like(Request $request, int $id) : JsonResponse
    {
        /** @var Video $video */
        $video = Video::find($id);

        $video->likedByUsers()->attach($request->user()->getKey());

        $video->save();

        return response()->json([
            'message' => 'Data Saved'
        ]);
    }
}
