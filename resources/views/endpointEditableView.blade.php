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
        <input type="text" name="originalUrl" value="{{ old('originalUrl', $endpoint->originalUrl) }}"/>{{ $errors->first('originalUrl') }}<br/>

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
        <?php $hasOld = !is_null(old('originalUrl')); ?>
        <?php $count = count($modList); ?>
        @for($i = 0; $i < $count; $i++)
            <?php $isChecked = in_array($modList[$i]->id, old("modificationIds", [])) || (!$hasOld && $modSelectionList[$i]); ?>
            <label><input type="checkbox" name="modificationIds[]" value="{{ $modList[$i]->id }}" {{ $isChecked ? 'checked="checked"' : '' }}/>{{ $modList[$i]->name }}<label><br/>
        @endfor
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
