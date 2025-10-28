@extends('layouts.dashboard')

@section('page-title', 'Profile Management')
@section('page-description', 'Update your personal and academic information.')

@section('content')
<div id="content-area">
    @include('graduate.partials.profile')
</div>
@endsection