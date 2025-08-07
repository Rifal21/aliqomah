@extends('layouts.master')

@section('content')
    <section class="relative min-h-screen bg-gray-100 ">
        @include('webpages.partials.alumni.jumbotron')
        @include('webpages.partials.alumni.sambutanAlumni')
        @include('webpages.partials.alumni.dataAlumni')
    </section>
@endsection
