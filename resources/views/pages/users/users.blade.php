@extends('layouts.app')

@section('content')
    <users :auth="{{ Auth::user() }}"></users>
@endsection

