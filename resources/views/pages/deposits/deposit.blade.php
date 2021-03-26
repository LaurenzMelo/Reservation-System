@extends('layouts.app')

@section('content')
    <deposit :auth="{{ Auth::user() }}"></deposit>
@endsection

