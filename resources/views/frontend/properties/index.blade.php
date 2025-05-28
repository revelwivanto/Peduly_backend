@extends('frontend.layouts.app')

@section('styles')
<style>
    .searchbar {
        padding: 20px 0;
    }
    .searchbar .input-field {
        margin: 0;
    }
    .searchbar select.browser-default {
        height: 45px;
        background-color: white;
        border: none;
        border-radius: 4px;
        padding: 0 10px;
    }
    .searchbar input {
        height: 45px;
        background-color: white;
        border: none;
        border-radius: 4px;
        padding: 0 10px;
        margin: 0;
    }
    .btnsearch {
        height: 45px;
        width: 100%;
        background-color: #3f51b5;
    }
    .btnsearch:hover {
        background-color: #303f9f;
    }
</style>
@endsection

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <h4 class="section-heading">Activities</h4>
            </div>

            <!-- Search Filter Section -->
            <section style="background-color: #f5f5f5;" class="center">
                <div class="container">
                    <div class="row m-b-0">
                        <div class="col s12">
                            <form action="{{ route('activities') }}" method="GET">
                                <div class="searchbar">
                                    <div class="input-field col s12 m3">
                                        <select name="city" class="browser-default">
                                            <option value="" disabled {{ !request('city') ? 'selected' : '' }}>Pilih Daerah</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->city_slug }}" {{ request('city') == $city->city_slug ? 'selected' : '' }}>
                                                    {{ $city->city }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="input-field col s12 m2">
                                        <select name="type" class="browser-default">
                                            <option value="" disabled {{ !request('type') ? 'selected' : '' }}>Choose Type</option>
                                            <option value="" {{ request('type') == '' ? 'selected' : '' }}>All</option>
                                            <option value="workshop" {{ request('type') == 'workshop' ? 'selected' : '' }}>Workshop</option>
                                            <option value="cooking" {{ request('type') == 'cooking' ? 'selected' : '' }}>Masak</option>
                                            <option value="outdoor" {{ request('type') == 'outdoor' ? 'selected' : '' }}>Outdoor</option>
                                            <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                    </div>

                                    <div class="input-field col s12 m2">
                                        <select name="target" class="browser-default">
                                            <option value="" disabled {{ !request('target') ? 'selected' : '' }}>Target</option>
                                            <option value="" {{ request('type') == '' ? 'selected' : '' }}>All</option>
                                            <option value="yatim" {{ request('target') == 'yatim' ? 'selected' : '' }}>Yatim Piatu</option>
                                            <option value="orangtua" {{ request('target') == 'orangtua' ? 'selected' : '' }}>Orang Tua</option>
                                            <option value="odgj" {{ request('target') == 'odgj' ? 'selected' : '' }}>ODGJ</option>
                                            <option value="alam" {{ request('target') == 'alam' ? 'selected' : '' }}>Alam</option>
                                        </select>
                                    </div>
                                    

                                    <div class="input-field col s12 m2">
                                        <input type="number" name="maxprice" id="maxprice" class="custominputbox" value="{{ request('maxprice') }}" placeholder="Max Price">
                                    </div>

                                    <div class="input-field col s12 m2">
                                        <input type="date" name="created_date" id="created_date" class="custominputbox" value="{{ request('created_date') }}" placeholder="Created Date">
                                    </div>
                                    
                                    <div class="input-field col s12 m1">
                                        <button class="btn btnsearch waves-effect waves-light w100" type="submit">
                                            <i class="material-icons">search</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <div class="row">
                @foreach($properties as $property)
                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-image">
                                @if($property->image && file_exists(public_path('images/'.$property->image)))
                                    <span class="card-image-bg" style="background-image:url({{asset('images/'.$property->image)}});"></span>
                                @else
                                    <span class="card-image-bg" style="background-image:url({{asset('images/default.png')}}); background-size: cover;"><span>
                                @endif
                                @if($property->featured == 1)
                                <a href="{{ route('payment.show', $property->slug) }}" class="btn-floating halfway-fab waves-effect waves-light red"><i class="small material-icons">shopping_cart</i></a>
                                @endif
                            </div>
                            <div class="card-content property-content">
                                <a href="{{ route('properties.show',$property->slug) }}">
                                    <span class="card-title tooltipped" data-position="bottom" data-tooltip="{{ $property->title }}">{{ Str::limit($property->title, 18) }}</span>
                                </a>

                                <div class="address">
                                    <i class="small material-icons left">place</i>
                                    <span>City: {{ ucfirst($property->city) }}</span>
                                </div>
                                <div class="address">
                                    <i class="small material-icons left">category</i>
                                    <span>Type: {{ ucfirst($property->activity_type) }}</span>
                                </div>
                                <div class="address">
                                    <i class="small material-icons left">schedule</i>
                                    <span>Start at: {{ $property->start_time }}</span>
                                </div>
                                <div class="address">
                                    <i class="small material-icons left">schedule</i>
                                    <span>End at: {{ $property->end_time }}</span>
                                </div>

                                <h5>
                                    &dollar;{{ number_format($property->price, 2) }}
                                </h5>                                
                            </div>
                            <div class="card-action property-action">
                                <span class="btn-flat">
                                    <i class="material-icons">group</i>
                                    Participants: <strong>{{ $property->min_participants}} - {{ $property->max_participants}}</strong> 
                                </span>
                                <span class="btn-flat">
                                    <i class="material-icons">comment</i> 
                                    <strong>{{ $property->comments_count ?? 0}}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="m-t-30 m-b-60 center">
                {{ $properties->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection 