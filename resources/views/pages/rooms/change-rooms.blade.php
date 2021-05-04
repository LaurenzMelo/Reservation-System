@extends('layouts.app')

@section('content')
    <change-rooms :auth="{{ Auth::user() }}"></change-rooms>
@endsection

