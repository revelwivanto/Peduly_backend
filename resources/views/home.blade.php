@extends('frontend.layouts.app')

@section('styles')
<style>
    .slider .indicators .indicator-item.active {
        background-color: #c4112f !important;
    }
    .slider img {
        object-fit: contain; /* Prevent cropping */
        width: 100%; /* Ensure image takes full width of its container */
        height: 100%; /* Ensure image takes full height of its container */
    }
</style>
@endsection

@section('content')

<div class="slider">
    <ul class="slides">
        {{-- Loop through the image file paths --}}
        @foreach($sliderImages as $imagePath)
            <li>
                {{-- Use asset() helper for public path --}}
                <img src="{{ asset($imagePath) }}">
                {{-- You can add captions here if needed, maybe based on filenames --}}
                {{-- <div class="caption center-align">
                    <h3>Caption Title</h3>
                    <h5 class="light grey-text text-lighten-3">Caption Description</h5>
                </div> --}}
            </li>
        @endforeach
    </ul>
</div>

{{-- Include the search partial --}}
@include('frontend.partials.search')

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.slider');
        var instances = M.Slider.init(elems, {
            indicators: true,
            height: 400,
            transition: 500,
            interval: 6000
        });
    });
</script>
@endsection


