<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
</head>
<body>
    @foreach ($users as $user)
        @foreach ($user->vehicles as $vehicle)
            {{ $vehicle }}
        @endforeach

        
    @endforeach
</body>
</html>