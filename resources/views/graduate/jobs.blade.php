@extends('layouts.dashboard')

@section('page-title', 'Job Opportunities')
@section('page-description', 'Browse available job postings from our partner companies.')

@section('content')
<div id="content-area">
    @include('graduate.partials.jobs')
</div>
@endsection