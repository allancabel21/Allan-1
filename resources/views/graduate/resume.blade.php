@extends('layouts.dashboard')

@section('page-title', 'Resume Management')
@section('page-description', 'Create and manage your professional resumes.')

@section('content')
<div id="content-area">
    @include('graduate.partials.resume')
</div>
@endsection