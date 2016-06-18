@extends('baseView')


@section('content')
    <form method="post" action="<?php
        action('ModificationController@editModification', [
                'modId' => $modification->id
        ]) ?>">

        Name:<br/>
        <input type="text" name="name" value="{{ old('name', $modification->name) }}"/><br/>
        Path:<br/>
        <input type="text" name="path" value="{{ old('path', $modification->path) }}"/><br/>
        Value:<br/>
        <textarea name="value">{{ old('value', $modification->value) }}</textarea>
        <input type="submit"/>
    </form>
@endsection
