<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Image Upload Form</title>
        <link rel="stylesheet" type="text/css" href="/livecms/dropzone.css" media="all">
        <link rel="stylesheet" type="text/css" href="/livecms/basic.css" media="all">
        <script type="text/javascript" src="/livecms/dropzone.js"></script>
    </head>
    <body>
        <div>                    
            <form action="{{ route('imagesUpload') }}" class="dropzone">
            @csrf
            <div style="text-align: center">
                <h3>Image Replace for</h3>
                <div>
                    <img id="orig_img"  alt="" width="100" height="60">
                </div>
                <span id="image_info"></span>
            </div>
                <div class="dz-message"><i class="fa fa-upload" aria-hidden="true"></i></div>
                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>
            </form>
        </div>
    </body>
</html>