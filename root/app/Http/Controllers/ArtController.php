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
            'colors'=>['required','string'],
            'link'=>['required','string'],
            'characters'=>['required','string'],
            'show'=>['required','string'],
            'fandom'=>['required','string'],
            'artType'=>['required','string'],
            'year'=>['required','integer'],
            'isPlushie'=>['required','boolean'],
            'isCommission'=>['required','boolean']

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
