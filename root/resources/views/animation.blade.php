
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="http://localhost/app_for_lupisvulpes-site/root/public/api/googledriveapi/animations/uploadAnimation" method="post" enctype="multipart/form-data">
        @csrf 
        Select animation to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Animation" name="submit">
      </form>
</body>
</html>

