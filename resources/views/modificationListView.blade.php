@extends('baseView')


@section('content')
    @foreach($modList as $mod)
        <h1>{{ $mod->name }}</h1>
        <a href="{{ action('ModificationController@showEditable', ['projName' => $projName, 'modId' => $mod->id]) }}">Edit</a><br/>
        Path:<br/>
        {{ $mod->path }}<br/>
        Value:<br/>
        {{ $mod->value }}<br/>
    @endforeach
@endsection
