<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Color;
use App\Models\Art;
use App\Models\ArtColor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\ColorController;
use \Illuminate\Support\Facades\Validator;
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

        if(!isset($request->parameters['is_commission'])) {$request->request->add(['is_commission'],['false']);};//if there's no isCommission parameter then add it to request object thus it's possible to validate this field
        if(!isset($request->parameters['is_plushie'])) {$request->request->add(['is_plushie'],['false']);};
        if(!isset($request->parameters['is_animation_clip'])) {$request->request->add(['is_animation_clip'],['false']);};
        $data= request()->all();
        $validator = Validator::make(request()->all(), [
            'colors_ids'=>['required','string'],
            'link'=>['required','string'],
            'characters'=>['required','string'],
            'race.*'=>['required','string'],
            'show'=>['nullable','string'],
            'fandom'=>['nullable','string'],
            'art_type'=>['required','string'],
            'year'=>['required','string'],
            'is_animation_clip'=>['nullable','string'],
            'is_plushie'=>['nullable','string'],
            'is_commission'=>['nullable','string'],
        ]);
        if($validator->fails()) {
            ColorController::destroyLastColors();
            return redirect()->back()->withErrors($validator->errors());
        } else {
        //------------------change types---------------
            settype($data['year'], 'int');
            settype($data['is_animation_clip'], 'bool');
            settype($data['is_plushie'], 'bool');
            settype($data['is_commission'], 'bool');

        //------------------change types---------------
            $data['race'] = implode(",",$data['race']);
            $colorsId = explode(',',$data['colors_ids']);

            $art = Art::create($data);

            foreach($colorsId as $colorId) {

                ArtColor::firstOrCreate([
                    "color_id" => $colorId,
                    "art_id" => $art->id
                ]);
            };

            return redirect()->route('/arts');
        }
    }
    public function checkIfExists(Request $request) {
        $ids = $request->all();//'11,12,13,14,15...'
        $matchingArts = Art::where('colors_ids', $ids)->get();
        return response()->json($matchingArts);
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
