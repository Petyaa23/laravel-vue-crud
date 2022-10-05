@extends('layouts.app')

@section('content')
    <admin-dashboard :products="{{$products}}"></admin-dashboard>
@endsection
