<!DOCTYPE html>
<html>
    <head>
        <title>Students</title>
    </head>
    <body>

        <h3>Students</h3>

        <hr/>

        <h4>Welcome to our site</h4>
        <p>This is student page - edit</p>

        <ul>
            <li><a href="{{ URL::to('/students') }}">Index</a></li>
            <li><a href="{{ URL::to('/students/show') }}">Show</a></li>
            <li><a href="{{ route('students.edit') }}">Edit</a></li>
        </ul>

    </body>
</html>