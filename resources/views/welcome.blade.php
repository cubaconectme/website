@extends('layouts.front')
@section('content')
    <front_dashboard
        :products="{{ json_encode($products) }}"
        :user="{{ json_encode($user) }}"
        :contacts="{{ json_encode($user_contacts) }}"
        :recharges="{{ json_encode($recharges) }}"
        :planes_cubacel="{{ json_encode($planes_cubacel) }}"
        :planes_nauta="{{ json_encode($planes_nauta) }}"
    ></front_dashboard>
@endsection
