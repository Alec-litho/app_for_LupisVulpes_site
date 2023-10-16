<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="http://localhost/app_for_lupisvulpes-site/root/resources/css/loaderAnimation.css">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"></link>
        <style>
           
        </style>
    </head>
    <body class="antialiased">
        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-6 ">
                    <form action="{{route('art.store')}}" method="post" enctype="multipart/form-data">
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
                        <div class="form-group">
                          <label for="exampleFormControlInput1">{{__('Characters')}}</label>
                          <input name="characters" type="text" class="form-control" id="exampleFormControlInput1" placeholder="{{__('character1, character2')}}">
                        </div>
                        <div class="form-group">
                          <label for="showInp">{{__('Show')}}</label>
                          <input name="show" type="text" class="form-control" id="showInp" placeholder="{{__('show')}}">
                        </div>
                        <div class="form-group">
                          <label for="tradOrdigit">{{__('Traditional or digital art')}}</label>
                          <input name="artType" type="text" class="form-control" id="tradOrdigit" placeholder="{{__('traditional/digital')}}">
                        </div>
                        <div class="form-group">
                          <label for="fandom">{{__('Fandom')}}</label>
                          <input name="fandom" type="text" class="form-control" id="fandom" placeholder="{{__('fandom')}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">{{__('Year')}}</label>
                          <select name="year" class="form-control" id="exampleFormControlSelect1">
                            <option>2010</option>
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
                        <div class="form-group">
                        </div>
                        <div class="palettes">
                          <p >Colors</p>
                        </div>
                        <div class="btn w-100 d-flex justify-content-center">
                          <button type="submit" class="btn btn-primary w-50 mt-2">Load Image</button>
                        </div>
                       
                      </form>
                </div>
                <div class="col-6">
                  <img class="imagePreview" src="https://i.ibb.co/n62thZS/placeholder-image-icon-21.jpg" alt="">
                  <canvas class="canvas"></canvas>
                </div>
            </div>
        </div>
    </body>
    <script type="module" src="http://localhost/app_for_lupisvulpes-site/root/resources/js/loadImg.js"></script>
    <script type="module" src="http://localhost/app_for_lupisvulpes-site/root/resources/js/colorPaletteExtracter.js"></script>
</html>
