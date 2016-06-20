<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <div class="content">
                <a href="{{ action('ModificationController@showList', ['projName' => $projectName]) }}">Modification List</a><br/><br/>

                @foreach ($endpointList as $endpoint)
                    <h1>{{ $endpoint->name }}</h1>

                    <a href="<?php echo action('SingleEndpointController@query', [
                            'projName' => $projectName,
                            'endpointName' => $endpoint->name
                        ]) ?>">Test query</a>

                    <a href="<?php echo action('SingleEndpointController@showEditable', [
                            'projName' => $projectName,
                            'endpointName' => $endpoint->name
                        ]) ?>">Edit</a>

                    <a href="<?php echo action('SingleEndpointController@removeEndpoint', [
                            'projName' => $projectName,
                            'endpointName' => $endpoint->name
                        ]) ?>">Remove</a>

                    <h2>Original url</h2>
                    {{$endpoint->originalUrl}}

                    <h2>Fixed parameters</h2>
                    @foreach ($endpoint->parameters as $param)
                        {{ $param->name.' -> '.$param->fixedValue }}
                        <a href="<?php echo action('SingleEndpointController@removeParameter', [
                                'projName' => $projectName,
                                'endpointName' => $endpoint->name,
                                'parameterId' => $param->id
                            ]) ?>">Remove</a><br/>
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
                <input type="text" name="endpointName" value="{{ old('endpointName') }}"/>{{ $errors->first('endpointName') }}<br/>
                Original URL:<br/>
                <input type="text" name="originalUrl" value="{{ old('originalUrl') }}"/>{{ $errors->first('originalUrl') }}<br/>
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
