@extends('layouts.app')

@section('content')
    <user-dashboard :products="{{$products}}" :category="{{$category}}" ></user-dashboard>
@endsection
