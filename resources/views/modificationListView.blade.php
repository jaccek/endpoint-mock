@extends('baseView')


@section('content')
    @foreach($modList as $mod)
        <h1>{{ $mod->name }}</h1>
        <a href="<?php echo action('ModificationController@showEditable', [
                'projName' => $projName,
                'modId' => $mod->id
            ]) ?>">Edit</a>
        <a href="<?php echo action('ModificationController@removeModification', [
                'projName' => $projName,
                'modId' => $mod->id
            ]) ?>">Remove</a><br/>
        Path:<br/>
        {{ $mod->path }}<br/>
        Value:<br/>
        {{ $mod->value }}<br/>
    @endforeach

    <br/><br/>
    <form method="post" action="<?php action('ModificationController@addModification', [
            'projName' => $projName
        ])?>">

        {{ csrf_field() }}

        Name:<br/>
        <input type="text", name="name", value="{{ old('name') }}"/>
        {{ $errors->first('name') }}<br/>
        <input type="submit"/>
    </form>
@endsection
