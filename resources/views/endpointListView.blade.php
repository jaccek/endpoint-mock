<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <div class="content">
                @foreach ($endpointList as $endpoint)
                    <a href="{{ action('SingleEndpointController@showDetails', [ 'projName' => $projectName, 'endpointName' => $endpoint->name ]) }}"><h1>{{ $endpoint->name }}</h1></a>
                    <a href="{{ action('SingleEndpointController@query', [ 'projName' => $projectName, 'endpointName' => $endpoint->name ]) }}">Test query</a>
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
                @endforeach
            </div>

            <form method="post" action="{{ action('EndpointListController@addEndpoint', $projectName) }}">
                {{ csrf_field() }}

                Endpoint Name:<br/>
                <input type="text" name="endpointName"/><br/>
                Original URL:<br/>
                <input type="text" name="originalUrl"/><br/>
                <!-- <input type="text" name="params[]"/> -> <input type="text" name="fixedValues[]"/><br/>
                <a id="add_param">Dodaj parametr</a><br/>
                Modifications:<br/>
                <label><input type="checkbox" name="modificationNames[]" value="aaa"/>aaa<label><br/> -->
                <input type="submit"/>
            </form>
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
