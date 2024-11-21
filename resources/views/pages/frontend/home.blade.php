@if (!empty($sliders) && $sliders->isNotEmpty())
    <section class="cd-hero">
        <ul class="cd-hero-slider autoplay">
            @foreach ($sliders as $slider)
            <li class="{{ $loop->first ? 'selected' : '' }}" style="background-image: url('{{ asset('storage/' . $slider->slide_image) }}');">
                    <div class="cd-full-width">
                        <div class="tm-slide-content-div slide-caption">
                            <span>{{ $slider->slide_subtitle }}</span>
                            <h2>{{ $slider->slide_title }}</h2>
                            <p>{{ $slider->slide_description }}</p>
                            @if ($slider->button_link && $slider->button_name)
                                <div class="primary-button">
                                    <a href="{{ $slider->button_link }}">{{ $slider->button_name }}</a>
                                </div>
                            @endif
                        </div>
                    </div> <!-- .cd-full-width -->
                </li>
            @endforeach
        </ul> <!-- .cd-hero-slider -->

        <div class="cd-slider-nav">
            <nav>
                <span class="cd-marker item-1"></span>
                <ul>
                    @foreach ($sliders as $slider)
                        <li class="{{ $loop->first ? 'selected' : '' }}"><a href="#0"></a></li>
                    @endforeach
                </ul>
            </nav>
        </div> <!-- .cd-slider-nav -->
    </section> <!-- .cd-hero -->
@else
    <section class="cd-hero">
        <ul class="cd-hero-slider autoplay">
            <!-- Fallback sliders in case no data is available -->
            <li class="selected first-slide">
                <div class="cd-full-width">
                    <div class="tm-slide-content-div slide-caption">
                        <span>Introduction to</span>
                        <h2>Creative Meteor</h2>
                        <p>Phasellus interdum tortor sem. Quisque sit amet condimentum sem. Phasellus luctus, felis sit
                            amet pulvinar luctus.</p>
                        <div class="primary-button">
                            <a href="#" class="scroll-link" data-id="about">Discover More</a>
                        </div>
                    </div>
                </div> <!-- .cd-full-width -->
            </li>

            <li class="second-slide">
                <div class="cd-full-width">
                    <div class="tm-slide-content-div slide-caption">
                        <span>We Are Perfect Staffs</span>
                        <h2>Our Team Members</h2>
                        <p>Donec dolor ipsum, laoreet nec metus non, tempus elementum massa. Donec non elit rhoncus,
                            vestibulum enim sed, rutrum arcu.</p>
                        <div class="primary-button">
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div> <!-- .cd-full-width -->
            </li>

            <li class="third-slide">
                <div class="cd-full-width">
                    <div class="tm-slide-content-div slide-caption">
                        <span>Design is a hobby</span>
                        <h2>Responsive Layout</h2>
                        <p>Integer ut dolor eget magna congue gravida ut at arcu. Vivamus maximus neque quis luctus
                            tempus. Vestibulum consequat.</p>
                        <div class="primary-button">
                            <a href="#">View Details</a>
                        </div>
                    </div>
                </div> <!-- .cd-full-width -->
            </li>
        </ul> <!-- .cd-hero-slider -->

        <div class="cd-slider-nav">
            <nav>
                <span class="cd-marker item-1"></span>
                <ul>
                    <li class="selected"><a href="#0"></a></li>
                    <li><a href="#0"></a></li>
                    <li><a href="#0"></a></li>
                </ul>
            </nav>
        </div> <!-- .cd-slider-nav -->
    </section> <!-- .cd-hero -->
@endif
