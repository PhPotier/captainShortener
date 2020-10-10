@extends('layouts.master')

@section('content')

<div style="width:75%;">
    {!! $chartjs->render() !!}
</div>

@endsection
