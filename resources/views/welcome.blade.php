@extends('layouts.front')
@section('content')
    <front_dashboard :products="{{ json_encode($products) }}" :user="{{ json_encode($user) }}"></front_dashboard>
@endsection
