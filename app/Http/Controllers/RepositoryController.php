<?php

namespace App\Http\Controllers;

use App\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Image;
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
            return Repository::with('photos', 'color', 'repository')
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'colors' =>'required',
            'photos' =>'required',
        ]);
        $user = \App\User::find(1);
        $photo = null;
        if ($files =$request->file('photos')) {
            $destinationPath = public_path('thumbnail/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 666, true);
            }
            $name = time() . $files->getClientOriginalName();
            $img = Image::make($files->getRealPath())->resize(60, 60, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.$name);
            $files->move('images', $name);

            $photo = \App\Photo::create(['file' => $name]);
        }
        $color = \App\Color::create([
            'colors' => $request->colors
        ]);
        $repositoryID = '';
        if(!is_string((int)$request->repository_id)) {
            $repositoryID = $request->repository_id;
        }
        $repository = new \App\Repository([
            'title' => $request->title,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'altitude' => $request->altitude,
            'longitude' => $request->longitude,
            'color_id' => $color->id,
            'repository_id' => $repositoryID === 'null' ? null : $repositoryID
        ]);

        $user->repositories()->save($repository)->photos()->attach($photo->id);
        Cache::forget('repositories:all');
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
     * @param  \App\Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function show(Repository $repository)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function edit(Repository $repository)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repository $repository)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repository $repository
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
