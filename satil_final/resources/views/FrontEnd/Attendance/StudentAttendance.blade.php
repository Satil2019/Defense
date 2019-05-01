@extends('home')
@section('MainContainer')
    @can('isStudent')
        <h1>student</h1>
    @endcan
    @can('isTeacher')
        <h1>isTeacher</h1>

    @endcan
@endsection
