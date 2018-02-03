<?php

namespace App\Http\Controllers;

use App\Vegetation;
use App\Helpers;
use Illuminate\Http\Request;

class VegetationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($firebase)
    {
        if(Helpers\check($firebase)){
            $vegetations = Vegetation::orderBy('updated_at', 'desc')->get();
            return response()->json($vegetations);
        }else{
            return response()->json([]);
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vegetation  $vegetation
     * @return \Illuminate\Http\Response
     */
    public function show(Vegetation $vegetation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vegetation  $vegetation
     * @return \Illuminate\Http\Response
     */
    public function edit(Vegetation $vegetation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vegetation  $vegetation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vegetation $vegetation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vegetation  $vegetation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vegetation $vegetation)
    {
        //
    }
}
