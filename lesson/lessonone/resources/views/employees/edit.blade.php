<!DOCTYPE html>
<html>
    <head>
        <title>Employee Page</title>
    </head>
    <body>

        <h3>Employee Page</h3>

        <hr/>

        <h4>Welcome to our site</h4>
        <p>This is employee page - edit</p>

        @php 
            echo "<pre>".print_r($data['employees'],true)."</pre>";
            echo $data['employees'][0] . "<br/>";
            echo $data['employees'][1] . "<br/>";
            echo $data['employees'][2] . "<br/>";
        @endphp

        <ul>
            @foreach($data['employees'] as $employee) 
                <li>{{$employee}}</li>
            @endforeach
        </ul>
     

    </body>
</html>