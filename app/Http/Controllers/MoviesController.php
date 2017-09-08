<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MoviesController extends Controller
{
    const defaultTake = 10;
    const defaultSkip = '';

    public function index(Request $request)
    {
        $name = $request->get('name');
        $take = $request->has('take') ? $request->get('take') : self::defaulTake;
        $skip = $request->has('skip') ? $request->get('skip') : self::defaultSkip;

        if($name){
            return $this->searchByName($name);
        }
        return Movie::skip($skip)->take($take)->get();
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
        return Movie::create($request->all(), [
            'name' => 'required|unique:movies',
            'director' => 'required',
            'duration' => 'required|between:1,500',
            'releaseDate' => 'required|unique:movies',
            'imageUrl' => 'url'

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Movie::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->update($request->all(), [
            'name' => 'required|unique:movies',
            'director' => 'required',
            'duration' => 'required|between:1-500',
            'releaseDate' => 'required|unique:movies',
            'imageUrl' => 'url'
        ]);
        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
        return $movie;
    }

    public function searchByName($name){
        return Movie::where('name', 'like', '%' . $name . '%')->paginate();
    }
}
