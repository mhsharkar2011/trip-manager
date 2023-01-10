<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
    <style>
        body {
            margin: 0;
        }
    </style>
    <script>
        window.api_info_url = "{{route('laravelapiexplorer.info')}}";
    </script>
    <title>API explorer</title>
</head>

<body>
    <div id="app"></div>
    <script src="{{route('laravelapiexplorer.asset', ['file' => 'bundle.js'])}}"></script>

    <script>
        /**
         * ITC Boilerplate - Take/make the first user's token and set it in localstorage
         */
        try {
            const ITEM_KEY = 'global:headers';
            let headers = JSON.parse(localStorage.getItem(ITEM_KEY)) || [];

            if (! headers.find(item => item.name === 'Authorization')) {
                headers.push({
                    'checked': true,
                    'name': 'Authorization',
                    'value': 'Bearer {{ __getTokenForPostman() }}'
                });
                window.localStorage.setItem(ITEM_KEY, JSON.stringify(headers));
                window.location.reload(); 
            } 
        } catch (error) {
            console.error('ITC Boilerplate - setting auth token failed, reason: ', error);
        }
    </script>

</body>

</html>