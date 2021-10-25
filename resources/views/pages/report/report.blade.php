@extends('layouts.app')

@section('content')
    <report :auth="{{ Auth::user() }}"></report>
@endsection

