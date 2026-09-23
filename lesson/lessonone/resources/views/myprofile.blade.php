<!DOCTYPE html>
<html>
    <head>
        <title>Profile</title>
    </head>
    <body>

        <h3>Profile</h3>

        <hr/>

        <h4>Welcome to our site</h4>
        <p>This is profile page</p>

        <ul>
            <li><a href="{{ URL::to('/') }}">Home</a></li>
            <li><a href="{{ URL::to('/about') }}">About</a></li>
            <li><a href="{{ URL::to('/contact') }}">Contact</a></li>
            <li><a href="{{ URL::to('/about/company/hninhnin') }}">Company</a></li>
            <li><a href="{{ route('prof') }}">Profile</a></li>
        </ul>

    </body>
</html>