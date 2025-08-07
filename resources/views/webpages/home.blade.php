@extends('layouts.master')

@section('content')
    <div class="min-h-screen">
        @include('webpages.partials.home.jumbotron')
        @include('webpages.partials.home.whyme')
        @include('webpages.partials.home.ourprogram')
        @include('webpages.partials.home.joinwithus')
        @include('webpages.partials.home.testimonial')
        @include('webpages.partials.home.galery')
    </div>
@endsection
