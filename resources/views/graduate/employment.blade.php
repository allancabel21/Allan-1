@extends('layouts.dashboard')

@section('page-title', 'Employment Information')
@section('page-description', 'Update your current employment status and history.')

@section('content')
<div id="content-area">
    @include('graduate.partials.employment')
</div>
@endsection