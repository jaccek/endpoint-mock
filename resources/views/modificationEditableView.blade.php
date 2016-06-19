@extends('baseView')


@section('content')
    <form method="post" action="<?php
        action('ModificationController@editModification', [
                'modId' => $modification->id
        ]) ?>">

        {{ csrf_field() }}

        <h1>{{ $modification->name }}</h1>
        Path:<br/>
        <input type="text" name="path" value="{{ old('path', $modification->path) }}"/>
        {{ $errors->first('path') }}<br/>
        Value:<br/>
        <textarea name="value">{{ old('value', $modification->value) }}</textarea><br/>
        <input type="submit"/>
    </form>
@endsection
