<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img src="../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <!-- Dashboard Menu Item -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-house-door"></i> <!-- Updated to Bootstrap icon -->
                        <p>
                            Dashboard
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Dashboard v1</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Components Header -->
                <li class="nav-header">COMPONENTS</li>

                <!-- Home Page Menu -->
                <li
                    class="nav-item {{ request()->is('slider') || request()->is('slider/create') || request()->is('slider/edit/*') ? 'active menu-open' : '' }}">
                    <a href="{{ url('slider') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i> <!-- Font Awesome home icon -->
                        <p>Home Page</p>
                    </a>
                </li>

                <!-- About Us Menu with submenus -->
                <li
                    class="nav-item {{ request()->is('services') || request()->is('services/create') || request()->is('services/edit/*') || request()->is('whatwedo') || request()->is('whatwedo/create') || request()->is('whatwedo/edit/*') ? 'active menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-info-circle"></i> <!-- Font Awesome info-circle icon -->
                        <p>
                            About Us
                            <i class="nav-arrow fas fa-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('whatwedo') }}"
                                class="nav-link {{ request()->is('whatwedo') || request()->is('whatwedo/create') || request()->is('whatwedo/edit/*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>What We Do</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('services') }}"
                                class="nav-link {{ request()->is('services') || request()->is('services/create') || request()->is('services/edit/*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Services</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Portfolio Menu -->
                <li
                    class="nav-item {{ request()->is('portfolio') || request()->is('portfolio/create') || request()->is('portfolio/edit/*') ? 'active menu-open' : '' }}">
                    <a href="{{ url('portfolio') }}" class="nav-link">
                        <i class="nav-icon fas fa-briefcase"></i> <!-- Font Awesome briefcase icon -->
                        <p>Portfolio</p>
                    </a>
                </li>

                <!-- Blogs and Fun Facts Menu -->
                <li
                    class="nav-item {{ request()->is('blogs') || request()->is('blogs/create') || request()->is('blogs/edit/*') || request()->is('funfacts') || request()->is('funfacts/create') || request()->is('funfacts/edit/*') ? 'active menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-pen"></i> <!-- Font Awesome pen icon -->
                        <p>
                            Blogs
                            <i class="nav-arrow fas fa-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('blogs') }}"
                                class="nav-link {{ request()->is('blogs') || request()->is('blogs/create') || request()->is('blogs/edit/*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Blog</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('funfacts') }}"
                                class="nav-link {{ request()->is('funfacts') || request()->is('funfacts/create') || request()->is('funfacts/edit/*') ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Fun Facts</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ url('social-links') }}"
                        class="nav-link {{ request()->is('social-links') || request()->is('social-links/create') || request()->is('social-links/edit/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-share-alt"></i>
                        <p>Social Links</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('contact') }}"
                        class="nav-link {{ request()->is('contact') || request()->is('contact/create') || request()->is('contact/edit/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>Contact Messages</p>
                    </a>
                </li>
                </li>
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
