<?php

namespace App\Http\Controllers;

use App\Repository;
use App\User;
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

    //createRepository -> repository/create/{firebase}



    public function index($firebase)
    {
        $user = Cache::rememberForever('user_repository:all', function () use ($firebase) {
            return \App\User::with('repositories.photos', 'repositories.color','repositories.distribution','repositories.category','repositories.family', 'repositories.repository', 'repositories.vegetations')->where('firebase_uid', $firebase)->first()['repositories'];

        });


        $repositories = \App\Repository::with('distribution','photos', 'color', 'repository', 'category', 'family', 'vegetations')
            ->where('published', 1)
            ->orderBy('updated_at', 'desc')
            ->get();

        $repository_user = $user->merge($repositories);

//        return response()->json($repositories);
        return response()->json($repository_user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check($firebase)
    {
        return 2 === \App\User::where('firebase_uid', $firebase)->first()->role_id;
    }

    public function createRepository(Request $request, $firebase)
    {
        if($this->check($firebase)){
            $location = $request->location;
            $repositoryInfo = $request->repositoryInfo;
            $selected = $request->selected;
            $user = \App\User::where('firebase_uid', $firebase)->first();

            //photo
            $imageData = $request->image;
            $fileName = uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            $img = Image::make($request->image);

            $img->save(public_path('images/') . $fileName);
            $img->resize(60, 60, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('images/thumb_') . $fileName);
            $photo = \App\Photo::create(['file' => $fileName]);

            /*
             * */

            $color = $request->colors ? \App\Color::create([
                'colors' => $request->colors
            ]) : null;
            $repository = new Repository([
                'family_id' => $selected['family'],
                'distribution_id' => $selected['distribution'],
                'category_id' => $selected['category'],
                'color_id' => $color->id,
                'commonName'=> $repositoryInfo['commonName'] ,
                'description'=> $repositoryInfo['description'],
                'scientificName'=> $repositoryInfo['scientificName'],
                'specie'=> $repositoryInfo['species'],
                'title'=> $repositoryInfo['title'] ,
                'economicImportance'=> $repositoryInfo['economicImportance'] ,
                'estimatedDensity' => $selected['density'],
                'latitude'=> $location['latitude'],
                'altitude'=> $location['altitude'],
                'longitude'=> $location['longitude'],
                'published' => 1,
                'photos' => $photo
            ]);
            $repositories = $user->repositories()->save($repository);
            $repositories->vegetations()->attach($selected['vegetation']);
            $repositories->photos()->attach($photo->id);
        }
        $repository_ = \App\Repository::with('distribution','photos', 'color', 'repository', 'category', 'family')
            ->where('id',  $repository->id)->get()[0];
        Cache::forget('user_repository:all');
        return response()->json($repository_);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return response()->json($request->all());
        $user = \App\User::where('firebase_uid', $request->firebase)->first();


        $imageData = $request->photos;
        $fileName = uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        $img = Image::make($request->photos);

        $img->save(public_path('images/') . $fileName);
        $img->resize(60, 60, function ($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('images/thumb_') . $fileName);
        $photo = \App\Photo::create(['file' => $fileName]);

        $color = $request->colors ? \App\Color::create([
            'colors' => $request->colors
        ]) : null;
        $repositoryID = '';
        $repository_id = '';
        if (!is_string((int)$request->repository_id)) {
            $repositoryID = $request->repository_id;
            $repository_id = \App\Repository::find($repositoryID);
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
        Cache::forget('user_repository:all');
        return response()->json([
            'id' => $repository->id,
            'title' => $request->title,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'altitude' => $request->altitude,
            'longitude' => $request->longitude,
            'color_id' => $color->id,
            'repository_id' => $repositoryID === 'null' ? null : $repositoryID,
            'photos' => [
                [
                    'file' => $fileName
                ]
            ],
            'color' => [
                'colors' => $request->colors ? $request->colors : null
            ],
            "repository" => $repository_id,
            'published' => 0

        ]);


        /*


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
        Cache::forget('repositories:all');*/
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
    public function updateRepository(Request $request, $firebase){

        $updateRepository = [
            'image' => $request->image,
            'palletes' => $request->palletes,
            'title' => $request->title,
            'economicImportance' => $request->economicImportance,
            'description' => $request->description,
            'species' => $request->species,
            'commonName' => $request->commonName,
            'scientificName' => $request->scientificName,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'altitude' => $request->altitude,
            'estimatedDensity' => $request->estimatedDensity,
            'family' => $request->family,
            'category' => $request->category,
            'distribution' => $request->distribution,
            'vegetation' => $request->vegetation
        ];
        \App\Repository::update($updateRepository);
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
        $repository->title = $request->title;
        $repository->description = $request->description;
        $repository->save();
        Cache::forget('user_repository:' . $repository->id);
        Cache::forget('user_repository:all');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repository $repository
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repository $repository, $firebase)
    {
        $user_repository = \App\User::with(['repositories' => function($query) use ($repository){
            $query->where('id', $repository->id)->first()->delete();
            Cache::forget('user_repository:'.$repository->id);
            Cache::forget('user_repository:all');
        }])->where('firebase_uid', $firebase)->first();

        return response()->json('Deleted Sucessfully!');
    }

    public function getPhoto(Request $user_repository)
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

    public function logout(){
        Cache::forget('user_repository:all');
        return response()->json('Sign out!');
    }

}
