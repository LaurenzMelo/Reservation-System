@extends('layouts.app')

@section('content')
    <list-of-rooms :auth="{{ Auth::user() }}"></list-of-rooms>
@endsection

