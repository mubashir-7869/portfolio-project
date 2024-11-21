
<div id="about" class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h4>What We Do</h4>
                    <div class="line-dec"></div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($whatWeDo as $what_we_do)
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="service-item {{ $loop->first ? 'first-service' : ($loop->last ? 'fourth-service' : '') }}">
                       @if($what_we_do->icon)
                       <i data-feather="{{$what_we_do->icon}}" class="service-icon"></i>
                       @else
                       <div class="icon"> </div>
                       @endif
                        <h4>{{ $what_we_do->title }}</h4>
                        <p>{{ $what_we_do->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div id="what-we-do">
    <div class="container">
        <div class="row">
            @foreach ($services as $service)
                <div class="col-md-6">
                    <div class="left-text">
                        <h4>{{ $service->title }}</h4>
                        <p>{{ $service->description }}</p>
                        <ul>
                            <li>
                                <div class="white-button">
                                    <a href="{{ $service->first_btn_link }}" 
                                        data-id="portfolio">{{ $service->first_btn_name ?? 'discover more' }}</a>
                                </div>
                            </li>
                            <li>
                                <div class="primary-button">
                                    <a href="{{ $service->second_btn_link }}">{{ $service->second_btn_name ?? 'purchase now'}}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right-image">
                        <img src="{{ asset('storage/' . $service->right_image_url) }}" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
