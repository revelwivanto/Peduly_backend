@extends('frontend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Select Your T-shirt Size</span>
                    
                    <div class="row">
                        <div class="col s12">
                            <h5>Activity: {{ $property->title }}</h5>
                            <p>Base Price: ${{ $property->price }}</p>
                            <p>Final Price (with T-shirt): ${{ $property->price + 10 }}</p>
                        </div>
                    </div>

                    <form action="{{ route('payment.tshirt.process', $property->slug) }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="input-field col s12">
                                <select name="tshirt_size" id="tshirt_size" required>
                                    <option value="" disabled selected>Choose your size</option>
                                    <option value="S">Small (S)</option>
                                    <option value="M">Medium (M)</option>
                                    <option value="L">Large (L)</option>
                                    <option value="XL">Extra Large (XL)</option>
                                    <option value="XXL">2XL</option>
                                </select>
                                <label>T-shirt Size</label>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        var selectElement = document.getElementById('tshirt_size');
                                        if (selectElement) {
                                            M.FormSelect.init(selectElement);
                                            console.log('Materialize select initialized for tshirt_size');
                                        }
                                    });
                                </script>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves-effect waves-light" type="submit">
                                    Proceed to Payment
                                    <i class="material-icons right">payment</i>
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

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // grab every <select> on the page
    var elems = document.querySelectorAll('select');
    // initialize them all
    M.FormSelect.init(elems);
  });
</script>

@endpush 