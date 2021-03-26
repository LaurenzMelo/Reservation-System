@extends('layouts.app')

@section('content')
    <reservation :auth="{{ Auth::user() }}"></reservation>
@endsection

