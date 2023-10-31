<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Color;
use App\Models\Art;
use App\Models\ArtColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtController extends Controller
{
    public function index()
    {
        dd(Art::all());
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
            'ids_for_test'=>['required','string'],//ids of colors
            'link'=>['required','string'],
            'characters'=>['required','string'],
            'show'=>['required','string'],
            'fandom'=>['required','string'],
            'artType'=>['required','string'],
            'year'=>['required','string'],
            'isPlushie'=>['nullable','string'],
            'isCommission'=>['nullable','string'],
        ]);
        //------------------change types---------------
        settype($data['year'], 'int');
        settype($data['isPlushie'], 'bool');
        settype($data['isCommission'], 'bool');
        //------------------change types---------------
        $colorsId = $data['ids_for_test'];
        unset($data['ids_for_test']);
        $art = Art::create($data);

        foreach($colorsId as $colorId) {
            ArtColor::firstOrCreate([
                "art_id" => $art->id,
                "color_id" => $colorId
            ]);
        };

        // return redirect()->route('/home');
    }
    public function checkIfExists(Request $request) {
        $ids = $request->all();//'11,12,13,14,15...'
        $matchingArts = Art::where('ids_for_test', $ids)->get();
        return $matchingArts;
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'colors_table', 'art_id', 'color_id');
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
