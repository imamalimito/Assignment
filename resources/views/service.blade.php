<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services</title>
</head>
<body>
    <div>
        <h2>Our Services</h2>
        <p>We offer the following services:</p>
        <ul>
            @foreach($services as $s)
            <li>{{ $s }}</li>
            @endforeach
        </ul>
    </div>
</body>
</html>