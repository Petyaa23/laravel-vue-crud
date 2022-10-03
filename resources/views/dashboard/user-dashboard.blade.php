@extends('layouts.app')

@section('content')
    <user-dashboard :products="{{$products}}" :categories="{{$categories}}" ></user-dashboard>
    <add-products :products="{{$products}}" :categories="{{$categories}}" ></add-products>
@endsection
