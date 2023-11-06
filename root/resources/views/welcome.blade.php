<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="http://localhost/app_for_lupisvulpes-site/root/resources/css/loaderAnimation.css">
        <link rel="stylesheet" href="http://localhost/app_for_lupisvulpes-site/root/resources/css/imageAnimation.css">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"></link>
    </head>
    <body class="antialiased">
        <div class="container mt-5">
            <div class="row d-flex position-relatve justify-content-center">
                <div class="col-6 ">
                    <form action="{{route('art.store')}}" method="post" enctype="multipart/form-data" class="form">
                      @csrf
                      <h5 for="formFile">{{__('Load Art')}}</h5> 
                        <x-imageInput required>
                            <input name="artFile" class="form-control" type="file" id="formFile" >
                            <div class="lds-ring-hide" id="loader"><div></div><div></div><div></div><div></div></div>
                        </x-imageInput>
                        <div class="form-group d-flex justify-content-center align-content-center gap-2 mt-2 fileResult">
                          <h4 class="text-primary">Result: </h4>
                          <input name="link" type="text" class="form-control w-75 result" placeholder="{{__("result")}}">
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-center gap-4">
                          <div class="cont d-flex  align-items-center gap-2">
                            <span class="fs-5" for="isCommision">{{__('isCommision')}}</span>
                            <input name="is_commission" class="form-check-input" type="checkbox" value="true" id="isCommission">
                          </div>
                          <div class="cont  d-flex align-items-center gap-2">
                            <span class="fs-5" for="isPlushie">{{__('isPlushie')}}</span>
                            <input name="is_plushie" class="form-check-input" type="checkbox" value="true" id="isPlushie">
                          </div>
                          <div class="cont  d-flex align-items-center gap-2">
                            <span class="fs-5" for="isAnimationClip">{{__('isAnimationClip')}}</span>
                            <input name="is_animation_clip" class="form-check-input" type="checkbox" value="true" id="animationClip">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlInput1" class="mb-1">{{__('Characters')}}</label>
                          <input name="characters" type="text" class="characters form-control" id="exampleFormControlInput1" placeholder="{{__('character1, character2')}}">
                          @error('characters')
                          <p class="text-danger">{{$message}}</p>
                          @enderror
                        </div>
                        <div class="race mt-2 mb-2 ">
                          <div class="d-flex gap-2"><label for="race">Race</label><p class="text-secondary mb-1 user-select-none">(hold ctrl to pick multiple options)</p></div>
                          <select multiple='' name="race[]" class="form-control" id="race">
                            <option selected>wolf</option>
                            <option>rabbit</option>
                            <option>ferret</option>
                            <option>human</option>
                            <option>furry</option>
                            <option>dragon</option>
                            <option>pony</option>
                          </select>
                        </div>
                        
                        <div class="form-group">
                          <div class="d-flex gap-2"><label for="showInp">{{__('Show')}}</label><p class="text-secondary mb-1 user-select-none">(if it's not from a show, just skip it)</p></div>
                          <select name="show" class="form-control" id="fandom">
                            <option selected>none</option>
                            <option>Audience</option>
                            <option>Captain and His Crew</option>
                            <option>Home grown dogs</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="tradOrdigit" class="mb-1">{{__('Traditional or digital art')}}</label>
                          <input name="art_type" type="text" class="form-control" id="tradOrdigit" placeholder="{{__('traditional/digital')}}">
                          @error('art_type')
                          <p class="text-danger">{{$message}}</p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <div class="d-flex gap-2"><label for="fandom" class="mb-1">{{__('Fandom')}}</label><p class="text-secondary mb-1 user-select-none">(if it's not from any fandom, just skip it)</p></div>
                          <select name="fandom" class="form-control" id="fandom">
                            <option selected>none</option>
                            <option>Audience</option>
                            <option>Captain and His Crew</option>
                            <option>Portal</option>
                            <option>Five nights at Freddie's</option>
                            <option>My little pony</option>
                            <option>Home grown dogs</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect1" class="mb-1">{{__('Year')}}</label>
                          <select name="year" class="form-control" id="exampleFormControlSelect1">
                            <option selected>2010</option>
                            <option>2011</option>
                            <option>2012</option>
                            <option>2013</option>
                            <option>2014</option>
                            <option>2015</option>
                            <option>2016</option>
                            <option>2017</option>
                            <option>2018</option>
                            <option>2019</option>
                            <option>2020</option>
                          </select>
                        </div>
                        <input class="colorsIds d-none" name="colors_ids"/>
                        <div class="btn w-100 d-flex gap-3 justify-content-center mt-2">
                          <button type="submit" disabled class="btn btn-primary w-50">Load Image</button>
                          <button type="button" class="btn btn-danger w-25 d-none" id="btn-discard">Discard</button>
                        </div>
                       
                      </form>
                </div>
                <div class="col-6 flex-column">
                    <img class="imagePreview" src="https://i.ibb.co/2yMxNnQ/placeholder-image-icon-21.jpg" alt="">
                  <div class="palettes">
                  </div>
                  <canvas class="canvas"></canvas>
                </div>
                <div class="artExists d-none">
                  <div class="model">
                    <h3>Art you tried to upload already exists in Database</h3>
                    <img class="modelImg" src="" alt="">
                    <div class="w-100 d-flex"><button class="btn btn-primary w-25" id="ok">Ok</button></div>
                  </div>

                </div>
            </div>
        </div>
    </body>
    <script src="../resources/js/color-thief.umd.js"></script>
    <script type="module" src="http://localhost/app_for_lupisvulpes-site/root/resources/js/scripts.js"></script>
    <script type="module" src="http://localhost/app_for_lupisvulpes-site/root/resources/js/loadImg.js"></script>
    <script type="module" src="http://localhost/app_for_lupisvulpes-site/root/resources/js/identifyBaseColor.js"></script>
    <script type="module" src="http://localhost/app_for_lupisvulpes-site/root/resources/js/setColors.js"></script>
</html>
