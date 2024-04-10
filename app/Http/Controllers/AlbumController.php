<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAlbumRequest;
use App\Models\Album;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlbumController extends Controller
{
    public function index(): View
    {
        $albums = auth()->user()->albums()->with('pictures')->get();

        return view('albums.index', compact('albums'));
    }

    public function store(SaveAlbumRequest $request)
    {
        $album = auth()->user()->albums()->create($request->only('name'));

        $album->pictures()->createMany(
            data_get($request->all(), 'pictures')
        );

        return response()->json([
            'success' => true,
            'message' => __('Album was created successfully'),
            "albumId" => $album->id
        ], Response::HTTP_CREATED);
    }

    public function edit(Album $album)
    {
        if (!auth()->user()->can('update', $album)) {
            $response = response()->json([
                'success' => true,
                'message' => "You\'re not authorized to update this album"
            ], Response::HTTP_FORBIDDEN);

            throw new HttpResponseException($response);
        }

        return response()->json([
            'success' => true,
            'html' => view('albums._partials.fields.edit', compact('album'))->render()
        ], Response::HTTP_OK);

    }

    public function update(Request $request, Album $album): RedirectResponse
    {
        if (!auth()->user()->can('update', $album)) {
            abort(403, __('You\'re not authorized to update this album'));
        }

        $album->update($request->only('name') + ['user_id' => auth()->id()]);

        return back()->withSuccess(__("Album was updated successfully"));
    }

    public function destroy(Album $album): RedirectResponse
    {
        if (!auth()->user()->can('delete', $album)) {
            abort(403, __('You\'re not authorized to delete this album'));
        }

        $album->delete();

        return back()->withSuccess(__("Album was deleted successfully"));
    }

    public function transferAndDestroy(Album $album)
    {
        if (!auth()->user()->can('update', $album)) {
            abort(403, __('You\'re not authorized to update this album'));
        }

        $album->pictures()->update([
            'album_id' => request('album_id'),
        ]);

        $album->delete();

        return back()->withSuccess(__("Album was delete and pictures were transfered succuessfully"));
    }

    public function search()
    {
        $results = auth()->user()->albums()
            ->when(request('q'), function (Builder $query, $search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->selectRaw('name AS text, id')
            ->get();

        return compact('results');
    }
}
