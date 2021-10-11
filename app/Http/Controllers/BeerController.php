<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Beer;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome')->with('beers', Beer::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createBeer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $beer = new Beer();
        $beer->name = $request->name;
        $beer->description = $request->description;

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $path = $image->store('beers/original');

            /* cоздание thumbnail */
            $thumbnailImage = Image::make($image);
            $thumbnailPath = storage_path().'\\app\\public\\beers\\thumbnail\\';

            if(!file_exists($thumbnailPath)) mkdir($thumbnailPath);

            $thumbnailImage->resize(50,50);
            $thumbnailImage->save($thumbnailPath. basename($path));

            $beer->image = '/' . basename($path);

        }

        $beer->save();

        return redirect()->route('admin');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('editBeer')->with('beer', Beer::find($id));
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
        $beer = Beer::find($id);
        $beer->name = $request->name;
        $beer->description = $request->description;

        if($request->hasFile('image')) {

            $image = $request->file('image');
            $path = $image->store('beers/original');

            /* cоздание thumbnail */
            $thumbnailImage = Image::make($image);
            $thumbnailPath = storage_path().'\\app\\public\\beers\\thumbnail\\';

            if(!file_exists($thumbnailPath)) mkdir($thumbnailPath);

            $thumbnailImage->resize(50,50);
            $thumbnailImage->save($thumbnailPath. basename($path));

            $beer->image = '/' . basename($path);

        }

        $beer->save();

        return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Beer::find($id)->delete();
        return redirect()->back();
    }
}
