<?php

namespace App\Http\Controllers;

use App\Models\Art;
use Illuminate\Http\Request;

class ArtController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $data = request()->validate([
            // 'colors'=>'required',
            'link'=>'required',
            'characters'=>'required',
            'show'=>'required',
            'fandom'=>'required',
            'artType'=>'required',
            'year'=>'required'

        ]);
        Art::create($data);
        return redirect()->route('/home');
    }
    public function show(Art $art)
    {
        //
    }
    public function edit(Art $art)
    {
        //
    }

    public function update(Request $request, Art $art)
    {
        //
    }
    public function destroy(Art $art)
    {
        //
    }
}
