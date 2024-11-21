{{-- <div id="portfolio" class="page-section">
    <div class="content-wrapper">
        <div class="inner-container container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h4>Our Portfolio</h4>
                        <div class="line-dec"></div>
                    </div>
                </div>
            </div>
            <div class="projects-holder-3">
                <div class="filter-categories">
                    <ul class="project-filter">
                        <li class="filter" data-filter="all"><span>All</span></li>
                        <li class="filter" data-filter="nature"><span>Nature</span></li>
                        <li class="filter" data-filter="workspace"><span>Workspace</span></li>
                        <li class="filter" data-filter="city"><span>City</span></li>
                        <li class="filter" data-filter="technology"><span>Technology</span></li>
                    </ul>
                </div>
                <div class="projects-holder">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 project-item mix workspace">
                            <div class="thumb">
                                <div class="image">
                                    <img src="img/portfolio_01.jpg">
                                </div>
                                <div class="hover-effect">
                                    <a href="img/portfolio_big_01.jpg" data-lightbox="image-1"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 project-item mix workspace">
                            <div class="thumb">
                                <div class="image">
                                    <img src="img/portfolio_02.jpg">
                                </div>
                                <div class="hover-effect">
                                    <a href="img/portfolio_big_02.jpg" data-lightbox="image-1"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 project-item mix technology">
                            <div class="thumb">
                                <div class="image">
                                    <img src="img/portfolio_03.jpg">
                                </div>
                                <div class="hover-effect">
                                    <a href="img/portfolio_big_03.jpg" data-lightbox="image-1"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 project-item mix city">
                            <div class="thumb">
                                <div class="image">
                                    <img src="img/portfolio_04.jpg">
                                </div>
                                <div class="hover-effect">
                                    <a href="img/portfolio_big_04.jpg" data-lightbox="image-1"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 project-item mix nature">
                            <div class="thumb">
                                <div class="image">
                                    <img src="img/portfolio_05.jpg">
                                </div>
                                <div class="hover-effect">
                                    <a href="img/portfolio_big_05.jpg" data-lightbox="image-1"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 project-item mix technology">
                            <div class="thumb">
                                <div class="image">
                                    <img src="img/portfolio_06.jpg">
                                </div>
                                <div class="hover-effect">
                                    <a href="img/portfolio _06.jpg" data-lightbox="image-1"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 project-item mix workspace">
                            <div class="thumb">
                                <div class="image">
                                    <img src="img/portfolio_07.jpg">
                                </div>
                                <div class="hover-effect">
                                    <a href="img/portfolio_big_07.jpg" data-lightbox="image-1"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 project-item mix city">
                            <div class="thumb">
                                <div class="image">
                                    <img src="img/portfolio_08.jpg">
                                </div>
                                <div class="hover-effect">
                                    <a href="img/portfolio_big_08.jpg" data-lightbox="image-1"><i
                                            class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<div class="page-section" id="portfolio">
    <div class="content-wrapper">
        <div class="inner-container container">
            <div class="section-heading">
                <h4>Our Portfolio</h4>
                <div class="line-dec"></div>
            </div>
            <div class="filter-categories">
                <ul class="project-filter">
                    <li class="filter" data-filter="all"><span>All</span></li>
                    @foreach($categories as $category)
                        <li class="filter" data-filter="{{ $category->id }}"><span>{{ $category->title }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="projects-holder">
                <div class="row">
                    @foreach($portfolios as $portfolio)
                        <div class="col-md-3 col-sm-6 project-item mix {{ $portfolio->category_id }}">
                            <div class="thumb">
                                <div class="image">
                                        <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                                </div>
                                <div class="hover-effect">
                                        <a href="{{ asset('storage/' . $portfolio->image) }}" data-lightbox="image-1"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>