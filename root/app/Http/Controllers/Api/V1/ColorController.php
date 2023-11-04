<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\v1\StoreColorRequest;
use App\Http\Resources\ColorResource;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(StoreColorRequest $request) 
    {
        $originalHue = $request->all()["original_hue"];
        $isExists = Color::where("original_hue", $originalHue)->get();
        dd($isExists->original);// i need to get actual model 
        if(!$isExists->exists) {
            $color = new ColorResource(Color::create($request->all()));
            return response()->json($color);
        } else {
            return response()->json(["message"=>"already exists"]);
        }


    }


    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        //
    }
}
