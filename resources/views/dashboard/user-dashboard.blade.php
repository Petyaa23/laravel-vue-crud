@extends('layouts.app')

@section('content')
    <user-dashboard :products="{{$products}}" :categories="{{$categories}}" ></user-dashboard>
@endsection
