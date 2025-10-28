@extends('layouts.dashboard')

@section('page-title', 'Graduate Dashboard')
@section('page-description', 'Welcome back, ' . auth()->user()->name . '!')

@section('content')
<div id="content-area">
    @include('graduate.partials.dashboard')
</div>
@endsection