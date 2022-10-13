@extends('layouts.app')

@section('content')
    <user-dashboard :products="{{ json_encode($products) }}" :categories="{{ json_encode($categories) }}" ></user-dashboard>
@endsection
