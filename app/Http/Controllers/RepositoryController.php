<?php

namespace App\Http\Controllers;

use App\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repository = Cache::rememberForever('repositories:all', function () {
            return Repository::with('photos', 'color')
                ->orderBy('updated_at', 'desc')
                ->get();
        });
        return response()->json($repository);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->photos){
            $photos = $this->getPhoto($request);
        }

        dd($request->all());
//        die(var_dump($request->name));

       /* $this->validate($request, [
            'title' => 'required|max:100',
            'body' => 'required'
        ]);
        $article = new Article;
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();
        Cache::forget('article:all');
        return response()->json($repository);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function show(Repository $repository)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function edit(Repository $repository)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repository $repository)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repository  $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repository $repository)
    {
        //
    }

    public function getPhoto(Request $request)
    {
        $photo = new \App\Photo();
        if ($file = $request->photos) {
            list($type, $imageData) = explode(';', $request->photos);
            list(, $extension) = explode('/', $type);
            list(, $imageData) = explode(',', $imageData);
            $fileName = uniqid() . '.' . $extension;
            $source = fopen($request->photos, 'r');
            $destination = fopen('images/' . $fileName, 'w');
            stream_copy_to_stream($source, $destination);
            fclose($source);
            fclose($destination);
            $photo = \App\Photo::create(['file' => $fileName]);
            return $photo;
        }
        return $photo;
    }
}
