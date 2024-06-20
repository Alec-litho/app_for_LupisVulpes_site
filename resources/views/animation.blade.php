
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="http://localhost/app_for_lupisvulpes_site/root/resources/css/animations.css">
    <link rel="stylesheet" href="http://localhost/app_for_lupisvulpes_site/root/resources/css/loaderAnimation.css">

    <title>Document</title>
</head>
<body>
    <x-header></x-header>
    <div class="container mt-5">
        <div class="row d-flex position-relative justify-content-center">
            <div class="col-6">
            <form action="http://localhost/app_for_lupisvulpes_site/root/public/index.php/api/v1/db/animations" method="post" enctype="multipart/form-data">
                Select animation to upload:
                <input type="file" class="form-control" id="fileToUpload">
                <input name="animationLink" type="text" class="d-none" id="animationLink">
                <div class="filters">
                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="mb-1">{{__('Characters')}}</label>
                        <input name="characters" type="text" class="characters form-control" id="exampleFormControlInput1" placeholder="{{__('character1, character2')}}">
                        @error('characters')
                          <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="year">year</label>
                        <select name="year" class="form-control" id="year">
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
                        @error('year')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="preview">preview</label>
                        <input class="form-control preview" type="file" id="preview" >
                        <input name="previewLink" type="text" class="d-none" id="previewLink">
                       @error('preview')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fandom">fandom</label>
                        <select name="fandom" class="form-control" id="fandom">
                            <option selected>none</option>
                            <option>Audience</option>
                            <option>Captain and His Crew</option>
                            <option>Portal</option>
                            <option>Five nights at Freddie's</option>
                            <option>My little pony</option>
                            <option>Home grown dogs</option>
                          </select>
                       @error('fandom')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="show">show</label>
                        <select name="show" class="form-control" id="fandom">
                            <option selected>none</option>
                            <option>Audience</option>
                            <option>Captain and His Crew</option>
                            <option>Home grown dogs</option>
                          </select>
                       @error('show')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="is_commission">is_commission</label>
                       <input name="isCommission" class="form-check-input" type="checkbox" value="true" id="animationClip">
                       @error('isCommission')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
 
                </div>

                <input type="submit" value="Upload Animation" name="submit">


            </form>
           
            </div>
            <div class="col-6">
                <div class="animationPreviewContainer">
                    <video controls controls="controls autoplay">
                        <source src="https://drive.google.com/file/d/1qzE8b--uc0rfZy6eL3MHHaLN6kPVYQTa/view?usp=drive_link">
                    </video>
                    <div class="lds-ring-hide" id="loader"><div></div><div></div><div></div><div></div></div>
                    <button type="button" class="btn btn-danger w-25 d-none" id="btn-discard">Discard</button>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="http://localhost/app_for_LupisVulpes_site/root/resources/js/animationPreview.js"></script>
    <script type="module" src="http://localhost/app_for_LupisVulpes_site/root/resources/js/createPreview.js"></script>
    <script type="module" src="http://localhost/app_for_LupisVulpes_site/root/resources/js/scripts.js"></script>

</body>
</html>

