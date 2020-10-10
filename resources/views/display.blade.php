@extends('layouts.master')

@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">Origin Url</th>
        <th scope="col">Shorten Url</th>
      </tr>
    </thead>
    <tbody>
    @foreach ($data as $url)
        <tr>
            <td>{{$url->origin_url}}</td>
            <td>{{$url->short_full_url}} </td>
        </tr>
    @endforeach
    </tbody>
@endsection