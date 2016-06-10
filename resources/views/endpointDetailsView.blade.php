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
                <a href="<?php echo action('SingleEndpointController@query', [
                        'projName' => $projectName,
                        'endpointName' => $endpoint->name]) ?>">
                    Test query</a>
                <a href="<?php echo action('SingleEndpointController@editEndpoint', [
                        'projName' => $projectName,
                        'endpointName' => $endpoint->name]) ?>">
                    Edit</a>
                <h2>Original url</h2>
                {{$endpoint->originalUrl}}

                <h2>Fixed parameters</h2>
                @foreach ($endpoint->parameters as $param)
                    {{ $param->name.' -> '.$param->fixedValue }}<br/>
                @endforeach

                <h2>Response changes</h2>
                @foreach ($endpoint->modifications as $modification)
                    {{ $modification->path.' -> '.$modification->value }}<br/>
                @endforeach
            </div>
        </div>
    </body>
</html>
