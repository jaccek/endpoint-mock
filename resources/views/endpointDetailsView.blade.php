<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <div class="content">
                <h1>{{ $endpoint->name }}</h1>
                <a href="{{ '../../'.$projectName.'/query/'.$endpoint->name }}">Test query</a>
                <a href="{{ '../../'.$projectName.'/edit/'.$endpoint->name }}">Edit</a>
                <h2>Original url</h2>
                {{$endpoint->originalUrl}}

                <h2>Fixed parameters</h2>
                @foreach ($endpoint->parameters as $param)
                    {{ $param->name.' -> '.$param->fixedValue }}
                @endforeach

                <h2>Response changes</h2>
                @foreach ($endpoint->modifications as $modification)
                    {{ $modification->path.' -> '.$modification->value }}
                @endforeach
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
        <script>
            function addParamInputs()
            {
                var inputs = '<input type="text" name="params[]"/> -> <input type="text" name="fixedValues[]"/><br/>';
                $('#add_param').before($(inputs));
            }

            $('#add_param').click(addParamInputs);
        </script>
    </body>
</html>