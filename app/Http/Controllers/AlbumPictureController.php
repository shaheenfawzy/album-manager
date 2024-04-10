<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAlbumPictureRequest;
use App\Models\Album;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AlbumPictureController extends Controller
{
    public function index(Album $album): View
    {
        if (!auth()->user()->can('view', $album)) {
            abort(403, __('You\'re not authorized to see any of this album\'s pictures'));
        }

        $pictures = $album->pictures()->latest()->paginate(9);

        return view('albums.pictures.index', compact('album', 'pictures'));
    }

    public function store(SaveAlbumPictureRequest $request, Album $album): JsonResponse
    {
        $album->pictures()->createMany(
            data_get($request->all(), 'pictures')
        );

        $pictures = $album->pictures()->latest()->paginate(9);

        return response()->json([
            'success' => true,
            'message' => __('Pictures were added to the album'),
            'html' => view('albums.pictures._partials.items', compact('pictures'))->render()
        ], Response::HTTP_CREATED);
    }

}
