@extends('livewire.website.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ url('css/assets/css/welcome.css') }}">
@endsection


@section('content')
<style>
    .category-Slider1 {
        position: relative;
        left: -191px;
        top: -66px;
        width: 130% !important;

    }



    @media screen and (max-width:768px) {
        .category-Slider1 {
            width: 100% !important;
            position: static;
            margin: auto
        }
    }
</style>
<!-- Hero Banner -->




@endsection
