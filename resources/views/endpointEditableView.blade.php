@extends('baseView')


@section('content')
    <form method="post" action="<?php
        action('SingleEndpointController@editEndpoint', [
                'projName => $projectName',
                'endpointName => $endpoint->name'
        ]) ?>">

        {{ csrf_field() }}

        <h1>{{ $endpoint->name }}</h1>

        Original URL:<br/>
        <input type="text" name="originalUrl" value="{{ $endpoint->originalUrl }}"/>{{ $errors->first('originalUrl') }}<br/>

        Parameters:<br/>
        <?php $count = count(old('params', $endpoint->parameters)); ?>
        @for($i = 0; $i < $count; $i++)
            <?php $param = array_get($endpoint->parameters, $i, null); ?>
            <input type="text" name="params[{{ $i }}]" value="{{ old("params.$i", array_get($param, 'name')) }}"/> ->
            <input type="text" name="fixedValues[{{ $i }}]" value="{{ old("fixedValues.$i", array_get($param, 'fixedValue')) }}"/>
            {{ $errors->first('params.'.$i).' '.$errors->first('fixedValues.'.$i) }}<br/>
        @endfor
        <a id="add_param">Dodaj parametr</a><br/>

        Modifications:<br/>
        @foreach($modList as $mod)
            <label><input type="checkbox" name="modificationIds[]" value="{{ $mod->id }}"/>{{ $mod->name }}<label><br/>
        @endforeach
        <input type="submit"/>
    </form>
@endsection


@section('script')
    function addParamInputs()
    {
        var inputs = '<input type="text" name="params[]"/> -> <input type="text" name="fixedValues[]"/><br/>';
        $('#add_param').before($(inputs));
    }

    $('#add_param').click(addParamInputs);
@endsection


<!-- <!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <div class="content">
                <h1>{{ $endpoint->name }}</h1>
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

            <form method="post" action="{{ action('EndpointListController@addEndpoint', $projectName) }}">
                {{ csrf_field() }}

                Endpoint Name:<br/>
                <input type="text" name="endpointName"/><br/>
                Parameters:<br/>
                <input type="text" name="params[]"/> -> <input type="text" name="fixedValues[]"/><br/>
                <a id="add_param">Dodaj parametr</a><br/>
                Modifications:<br/>
                <label><input type="checkbox" name="modificationNames[]" value="aaa"/>aaa<label><br/>
                <input type="submit"/>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
        <script>

        </script>
    </body>
</html> -->
