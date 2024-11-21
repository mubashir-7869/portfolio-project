<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\WhatWeDo;
use App\Models\Portfolio;
use App\Models\Category;
use App\Models\Admin\Blog;
use App\Models\Admin\SocialLink;
use App\Models\Admin\FunFact;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {

        $sliders = Slider::all();
        $services = Service::all();
        $whatWeDo = WhatWeDo::all();
        $portfolios = Portfolio::all();
        $categories = Category::all();
        $socialLinks = SocialLink::all();
        $blogs = Blog::all();
        $funFacts = FunFact::all();

        $pageData = [
            'sliders' => $sliders,
            'services' => $services,
            'whatWeDo' => $whatWeDo,
            'portfolios' => $portfolios,
            'categories' => $categories,
            'blogs' => $blogs,
            'funFacts' => $funFacts,
            'socialLinks' => $socialLinks
        ];

        return view('pages.frontend.index')->with($pageData);
    }
    public function show()
    {

    }
    public function create()
    {

    }
    public function store()
    {

    }

}
