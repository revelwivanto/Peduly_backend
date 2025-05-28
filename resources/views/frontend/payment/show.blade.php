@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Payment Details</span>
                    
                    <div class="row">
                        <div class="col s12">
                            <h5>Activity: {{ $property->title }}</h5>
                            <p>Base Price: ${{ $property->price }}</p>
                        </div>
                    </div>

                    <form action="{{ route('payment.process', $property->slug) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="name" type="text" name="name" class="validate" required>
                                <label for="name">Full Name</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="phone" type="tel" name="phone" class="validate" required>
                                <label for="phone">Phone Number</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <p>
                                    <label>
                                        <input type="checkbox" name="has_tshirt" value="1" class="filled-in" checked />
                                        <span>I already have a Peduly t-shirt</span>
                                    </label>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves-effect waves-light" type="submit">
                                    Continue
                                    <i class="material-icons right">arrow_forward</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 