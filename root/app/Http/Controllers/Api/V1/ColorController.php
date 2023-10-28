<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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


    public function store(Request $request)
    {
        return $request;
        // $data = request()->validate([
        //     "originalHue"=>["required","string"],
        //     "baseColor"=>["required","string"],
        //     "closeHueName"=>["required","string"],
        //     "closeHue"=>["required","string"],
        //     "hsv"=>["required","string"],
        // ]);
        // dd($data);
        // $isExists = Color::find("originalHue",$data[0]);
        // Color::create($data);

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
