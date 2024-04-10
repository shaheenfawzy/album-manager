<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PictureController extends Controller
{
    public function edit(Picture $picture): JsonResponse
    {
        if (!auth()->user()->can('update', $picture)) {
            $response = response()->json([
                'success' => true,
                'message' => "You\'re not authorized to update this picture"
            ], Response::HTTP_FORBIDDEN);

            throw new HttpResponseException($response);
        }

        return response()->json([
            'success' => true,
            'html' => view('albums.pictures._partials.fields.edit', compact('picture'))->render()
        ], Response::HTTP_OK);
    }

    public function update(Request $request, Picture $picture): RedirectResponse
    {
        if (!auth()->user()->can('update', $picture)) {
            abort(403, 'You\'re not authorized to update this picture');
        }

        $picture->update(array_filter($request->only(['name', 'path'])));

        return back()->withSuccess(__("Picture was updated successfully"));
    }

    public function destroy(Picture $picture): RedirectResponse
    {
        if (!auth()->user()->can('delete', $picture)) {
            abort(403, __('You\'re not authorized to delete any of this album\'s pictures'));
        }

        $picture->delete();

        return back()->withSuccess(__("Picture was deleted successfully"));
    }

    public function download(Picture $picture): StreamedResponse
    {
        return Storage::disk('public')->download($picture->getRawOriginal('path'));
    }
}
