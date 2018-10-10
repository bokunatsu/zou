@extends('layouts.base')
@section('title', 'hoge')
@section('content')
<div class="ui container aligned center">
    <h2>wikiやつ</h2>
    <form action="/wikiru/map">
        <input type="text" name="target" >
        <button type="submit"><i class="icon search"></i></button>
    </form>
</div>
@endsection
