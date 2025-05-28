<footer style="background-color:rgb(103, 9, 25);">
    <div class="container">
        <div class="row">
            <div class="col m4 s12">
                <h5 class="white-text uppercase">About Us</h5>
                @if(isset($footersettings[0]) && $footersettings[0]['aboutus'])
                    <p class="grey-text text-lighten-4">{{ $footersettings[0]['aboutus'] }}</p>
                @else
                    <p class="grey-text text-lighten-4">Help Others</p>
                @endif
            </div>
            <div class="col m6 s12">
                <ul class="collection border0">

                    @foreach($footerproperties as $property)
                    <li class="collection-item transparent clearfix p-0 border0">
                        <span class="card-image-bg m-r-10" style="background-image:url({{Storage::url('property/'.$property->image)}});width:60px;height:45px;float:left;"></span>
                        <div class="float-left">
                            <h5 class="font-18 m-b-0 m-t-5">
                                <a href="{{ route('properties.show',$property->slug) }}" class="white-text">{{ Str::limit($property->title,40) }}</a>
                            </h5>
                            <p class="m-t-0 m-b-5 grey-text text-lighten-1">Activity Type: {{ ucfirst($property->activity_type) }} Difficulty: {{ ucfirst($property->difficulty_level) }} </p>
                        </div>
                    </li>
                    @endforeach

                </ul>
            </div>
            <div class="col m2 s12">
                <h5 class="white-text uppercase">Menu</h5>
                <ul>
                    <li class="uppercase {{ Request::is('property*') ? 'underline' : '' }}">
                        <a href="{{ route('properties.index') }}" class="grey-text text-lighten-3">Activities</a>
                    </li>

                    <!-- Agents link removed to prevent route error -->

                    <li class="uppercase {{ Request::is('blog*') ? 'underline' : '' }}">
                        <a href="{{ route('blog.index') }}" class="grey-text text-lighten-3">Blog</a>
                    </li>

                    <li class="uppercase {{ Request::is('contact') ? 'underline' : '' }}">
                        <a href="{{ route('contact') }}" class="grey-text text-lighten-3">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            @if(isset($footersettings[0]) && $footersettings[0]['footer'])
                {{ $footersettings[0]['footer'] }}
            @else
                © {{ date('Y') }} 
            @endif

            @if(isset($footersettings[0]) && $footersettings[0]['facebook'])
                <a class="grey-text text-lighten-4 right" href="{{ $footersettings[0]['facebook'] }}" target="_blank">FACEBOOK</a>
            @endif
            @if(isset($footersettings[0]) && $footersettings[0]['twitter'])
                <a class="grey-text text-lighten-4 right m-r-10" href="{{ $footersettings[0]['twitter'] }}" target="_blank">TWITTER</a>
            @endif
            @if(isset($footersettings[0]) && $footersettings[0]['linkedin'])
                <a class="grey-text text-lighten-4 right m-r-10" href="{{ $footersettings[0]['linkedin'] }}" target="_blank">LINKEDIN</a>
            @endif

        </div>
    </div>
</footer>