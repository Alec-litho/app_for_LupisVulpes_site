<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"></link>
        <style>
           
        </style>
    </head>
    <body class="antialiased">
        <div class="container mt-5">
            <div class="row d-flex justify-content-center">
                <div class="col-6 ">
                    <form>
                        <x-imageInput required>
                            <label for="formFile">{{__('Load Art')}}</label>
                            <input class="form-control" type="file" id="formFile">
                        </x-imageInput>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">{{__('Characters')}}</label>
                          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="{{__('character1, character2')}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">{{__('Year')}}</label>
                          <select class="form-control" id="exampleFormControlSelect1">
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
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">{{__('description')}}</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </body>
</html>
