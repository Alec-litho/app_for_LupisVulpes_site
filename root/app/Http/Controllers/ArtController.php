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

        if(!isset($request->parameters['isCommission'])) {$request->request->add(['isCommission'],['false']);};//if there's no isCommission parameter then add it to request object thus it's possible to validate this field
        if(!isset($request->parameters['isPlushie'])) {$request->request->add(['isPlushie'],['false']);};
        $data = request()->validate([
            'colors'=>['required','string'],
            'link'=>['required','string'],
            'characters'=>['required','string'],
            'show'=>['required','string'],
            'fandom'=>['required','string'],
            'artType'=>['required','string'],
            'year'=>['required','string'],
            'isPlushie'=>['nullable','string'],
            'isCommission'=>['nullable','string']

        ]);
        //------------------change types---------------
        settype($data['year'], 'int');
        settype($data['isPlushie'], 'bool');
        settype($data['isCommission'], 'bool');
        //------------------change types---------------
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
