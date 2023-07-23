<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>

    <link rel="stylesheet" href="{{ asset('dist/venobox.min.css') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('adminassets/assets/bootstrap/dist/css/bootstrap.min.css') }}" />

    {{-- BOOTSTRAP  --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- ===============================================-->
    <!--    assets from dashboard-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('adminassets/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('adminassets/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('adminassets/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('adminassets/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('adminassets/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('adminassets/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{ asset('adminassets//assets/js/config.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/overlayscrollbars/OverlayScrollbars.min.js') }}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets from dashboard-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('adminassets/vendors/overlayscrollbars/OverlayScrollbars.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminassets/assets/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
    <link href="{{ asset('adminassets/assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('adminassets/assets/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
    <link href="{{ asset('adminassets/assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminassets/assets/toastr/toastr.min.css') }}" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('adminassets/assets/datatables.net/css/jquery.dataTables.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('adminassets/assets/datatables.net/css/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('adminassets/assets/datatables.net/css/buttons.dataTables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('adminassets/assets/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('adminassets/vendors/flatpickr/flatpickr.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('adminassets/css/custom.css') }}" asp-append-version="true" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        if (isRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));
                if (isFluid) {
                    var container = document.querySelector('[data-layout]');
                    container.classList.remove('container');
                    container.classList.add('container-fluid');
                }
            </script>

            {{-- =======================================================================================

                                    ------SIDEBAR PANEL STARTS--------

            ======================================================================================= --}}

            <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
                <script>
                    var navbarStyle = localStorage.getItem("navbarStyle");
                    if (navbarStyle && navbarStyle !== 'transparent') {
                        document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
                    }
                </script>
                <div class="d-flex align-items-center">
                    <div class="toggle-icon-wrapper">
                        <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle"
                            data-bs-toggle="tooltip" data-bs-placement="left" aria-label="Toggle Navigation"
                            data-bs-original-title="Toggle Navigation"><span class="navbar-toggle-icon"><span
                                    class="toggle-line"></span></span></button>
                    </div><a class="navbar-brand" href="index.html">
                        <div class="d-flex align-items-center py-3"><img class="me-2"
                                src="assets/img/icons/spot-illustrations/falcon.png" alt=""
                                width="40"><span class="font-sans-serif">falcon</span></div>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                    <div class="navbar-vertical-content scrollbar">
                        <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                            <li class="nav-item">
                                <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard"
                                    role="button" data-bs-toggle="collapse" aria-expanded="true"
                                    aria-controls="dashboard">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><svg
                                                class="svg-inline--fa fa-chart-pie fa-w-17" aria-hidden="true"
                                                focusable="false" data-prefix="fas" data-icon="chart-pie"
                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 544 512" data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M527.79 288H290.5l158.03 158.03c6.04 6.04 15.98 6.53 22.19.68 38.7-36.46 65.32-85.61 73.13-140.86 1.34-9.46-6.51-17.85-16.06-17.85zm-15.83-64.8C503.72 103.74 408.26 8.28 288.8.04 279.68-.59 272 7.1 272 16.24V240h223.77c9.14 0 16.82-7.68 16.19-16.8zM224 288V50.71c0-9.55-8.39-17.4-17.84-16.06C86.99 51.49-4.1 155.6.14 280.37 4.5 408.51 114.83 513.59 243.03 511.98c50.4-.63 96.97-16.87 135.26-44.03 7.9-5.6 8.42-17.23 1.57-24.08L224 288z">
                                                </path>
                                            </svg>
                                            <!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com --></span><span
                                            class="nav-link-text ps-1">System</span></div>
                                </a>
                                <ul class="nav collapse show" id="dashboard">
                                    <li class="nav-item"><a class="nav-link active" href="{{ route('dashboard') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">All Dashboard</span></div>
                                        </a><!-- more inner pages-->
                                    </li>

                                    @role('admin')

                                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.index') }}">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Admin Dashboard</span></div>
                                        </a><!-- more inner pages-->
                                    </li>

                                    @endrole
                                </ul>
                            </li>
                            <li class="nav-item">
                                <!-- label-->
                                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                    <div class="col-auto navbar-vertical-label">App</div>
                                    <div class="col ps-0">
                                        <hr class="mb-0 navbar-vertical-divider">
                                    </div>
                                </div><!-- parent pages-->

                                <!-- parent pages-->

                                <a class="nav-link" href="app/chat.html" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <svg class="svg-inline--fa fa-comments fa-w-18" aria-hidden="true"
                                                    focusable="false" data-prefix="fas" data-icon="comments"
                                                    role="img" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 576 512" data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M416 192c0-88.4-93.1-160-208-160S0 103.6 0 192c0 34.3 14.1 65.9 38 92-13.4 30.2-35.5 54.2-35.8 54.5-2.2 2.3-2.8 5.7-1.5 8.7S4.8 352 8 352c36.6 0 66.9-12.3 88.7-25 32.2 15.7 70.3 25 111.3 25 114.9 0 208-71.6 208-160zm122 220c23.9-26 38-57.7 38-92 0-66.9-53.5-124.2-129.3-148.1.9 6.6 1.3 13.3 1.3 20.1 0 105.9-107.7 192-240 192-10.8 0-21.3-.8-31.7-1.9C207.8 439.6 281.8 480 368 480c41 0 79.1-9.2 111.3-25 21.8 12.7 52.1 25 88.7 25 3.2 0 6.1-1.9 7.3-4.8 1.3-2.9.7-6.3-1.5-8.7-.3-.3-22.4-24.2-35.8-54.5z">
                                                    </path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-text ps-1">Chat</span>
                                    </div>
                                </a><!-- parent pages-->
                                <a class="nav-link dropdown-indicator" href="#email"
                                    role="button" data-bs-toggle="collapse" aria-expanded="false"
                                    aria-controls="email">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                                <svg
                                                    class="svg-inline--fa fa-envelope-open fa-w-16" aria-hidden="true"
                                                    focusable="false" data-prefix="fas" data-icon="envelope-open"
                                                    role="img" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 512 512" data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M512 464c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48V200.724a48 48 0 0 1 18.387-37.776c24.913-19.529 45.501-35.365 164.2-121.511C199.412 29.17 232.797-.347 256 .003c23.198-.354 56.596 29.172 73.413 41.433 118.687 86.137 139.303 101.995 164.2 121.512A48 48 0 0 1 512 200.724V464zm-65.666-196.605c-2.563-3.728-7.7-4.595-11.339-1.907-22.845 16.873-55.462 40.705-105.582 77.079-16.825 12.266-50.21 41.781-73.413 41.43-23.211.344-56.559-29.143-73.413-41.43-50.114-36.37-82.734-60.204-105.582-77.079-3.639-2.688-8.776-1.821-11.339 1.907l-9.072 13.196a7.998 7.998 0 0 0 1.839 10.967c22.887 16.899 55.454 40.69 105.303 76.868 20.274 14.781 56.524 47.813 92.264 47.573 35.724.242 71.961-32.771 92.263-47.573 49.85-36.179 82.418-59.97 105.303-76.868a7.998 7.998 0 0 0 1.839-10.967l-9.071-13.196z">
                                                    </path>
                                                </svg>
                                        </span>
                                        <span class="nav-link-text ps-1">Email</span></div>
                                </a>
                                <ul class="nav collapse" id="email">
                                    <li class="nav-item"><a class="nav-link" href="app/email/inbox.html">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Inbox</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="app/email/email-detail.html">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Email detail</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="app/email/compose.html">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Compose</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                </ul>


                            
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


            
            {{-- =======================================================================================

                                    ------SIDEBAR PANEL ENDS--------

            ======================================================================================= --}}


            <div class="content">

            {{-- =======================================================================================

                                    ------NAVBAR PANEL STARTS--------

            ======================================================================================= --}}

            <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand navbar-glass-shadow">
                <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                    aria-controls="navbarVerticalCollapse" aria-expanded="false"
                    aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                            class="toggle-line"></span></span></button>
                <a class="navbar-brand me-1 me-sm-3" href="index.html">
                    <div class="d-flex align-items-center"><img class="me-2"
                            src="assets/img/icons/spot-illustrations/falcon.png" alt=""
                            width="40"><span class="font-sans-serif">falcon</span></div>
                </a>


                {{-- <ul class="navbar-nav align-items-center d-none d-lg-block">
                    <li class="nav-item">
                        <div class="search-box" data-list="{&quot;valueNames&quot;:[&quot;title&quot;]}">
                            <form class="position-relative" data-bs-toggle="search" data-bs-display="static">
                                <input class="form-control search-input fuzzy-search" type="search"
                                    placeholder="Search..." aria-label="Search">
                                <svg class="svg-inline--fa fa-search fa-w-16 search-box-icon" aria-hidden="true"
                                    focusable="false" data-prefix="fas" data-icon="search" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                                    </path>
                                </svg>
                                <!-- <span class="fas fa-search search-box-icon"></span> Font Awesome fontawesome.com -->
                            </form>
                            <div class="btn-close-falcon-container position-absolute end-0 top-50 translate-middle shadow-none"
                                data-bs-dismiss="search"><button class="btn btn-link btn-close-falcon p-0"
                                    aria-label="Close"></button></div>
                            <div class="dropdown-menu border font-base start-0 mt-2 py-0 overflow-hidden w-100">
                                <div class="scrollbar list py-3" style="max-height: 24rem;">
                                    <h6 class="dropdown-header fw-medium text-uppercase px-x1 fs--2 pt-0 pb-2">
                                        Recently Browsed</h6><a
                                        class="dropdown-item fs--1 px-x1 py-1 hover-primary"
                                        href="app/events/event-detail.html">
                                        <div class="d-flex align-items-center">
                                            <svg class="svg-inline--fa fa-circle fa-w-16 me-2 text-300 fs--2"
                                                aria-hidden="true" focusable="false" data-prefix="fas"
                                                data-icon="circle" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                </path>
                                            </svg>
                                            <!-- <span class="fas fa-circle me-2 text-300 fs--2"></span> Font Awesome fontawesome.com -->
                                            <div class="fw-normal title">Pages <svg
                                                    class="svg-inline--fa fa-chevron-right fa-w-10 mx-1 text-500 fs--2"
                                                    data-fa-transform="shrink-2" aria-hidden="true"
                                                    focusable="false" data-prefix="fas"
                                                    data-icon="chevron-right" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                                    data-fa-i2svg="" style="transform-origin: 0.3125em 0.5em;">
                                                    <g transform="translate(160 256)">
                                                        <g
                                                            transform="translate(0, 0)  scale(0.875, 0.875)  rotate(0 0 0)">
                                                            <path fill="currentColor"
                                                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"
                                                                transform="translate(-160 -256)"></path>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <!-- <span class="fas fa-chevron-right mx-1 text-500 fs--2" data-fa-transform="shrink-2"></span> Font Awesome fontawesome.com -->
                                                Events</div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item fs--1 px-x1 py-1 hover-primary"
                                        href="app/e-commerce/customers.html">
                                        <div class="d-flex align-items-center">
                                            <svg class="svg-inline--fa fa-circle fa-w-16 me-2 text-300 fs--2"
                                                aria-hidden="true" focusable="false" data-prefix="fas"
                                                data-icon="circle" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                data-fa-i2svg="">
                                                <path fill="currentColor"
                                                    d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                </path>
                                            </svg>
                                            <!-- <span class="fas fa-circle me-2 text-300 fs--2"></span> Font Awesome fontawesome.com -->
                                            <div class="fw-normal title">E-commerce <svg
                                                    class="svg-inline--fa fa-chevron-right fa-w-10 mx-1 text-500 fs--2"
                                                    data-fa-transform="shrink-2" aria-hidden="true"
                                                    focusable="false" data-prefix="fas"
                                                    data-icon="chevron-right" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                                                    data-fa-i2svg="" style="transform-origin: 0.3125em 0.5em;">
                                                    <g transform="translate(160 256)">
                                                        <g
                                                            transform="translate(0, 0)  scale(0.875, 0.875)  rotate(0 0 0)">
                                                            <path fill="currentColor"
                                                                d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"
                                                                transform="translate(-160 -256)"></path>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <!-- <span class="fas fa-chevron-right mx-1 text-500 fs--2" data-fa-transform="shrink-2"></span> Font Awesome fontawesome.com -->
                                                Customers</div>
                                        </div>
                                    </a>
                                    <hr class="text-200 dark__text-900">
                                    <h6 class="dropdown-header fw-medium text-uppercase px-x1 fs--2 pt-0 pb-2">
                                        Suggested Filter</h6><a class="dropdown-item px-x1 py-1 fs-0"
                                        href="app/e-commerce/customers.html">
                                        <div class="d-flex align-items-center"><span
                                                class="badge fw-medium text-decoration-none me-2 badge-soft-warning">customers:</span>
                                            <div class="flex-1 fs--1 title">All customers list</div>
                                        </div>
                                    </a><a class="dropdown-item px-x1 py-1 fs-0"
                                        href="app/events/event-detail.html">
                                        <div class="d-flex align-items-center"><span
                                                class="badge fw-medium text-decoration-none me-2 badge-soft-success">events:</span>
                                            <div class="flex-1 fs--1 title">Latest events in current month</div>
                                        </div>
                                    </a><a class="dropdown-item px-x1 py-1 fs-0"
                                        href="app/e-commerce/product/product-grid.html">
                                        <div class="d-flex align-items-center"><span
                                                class="badge fw-medium text-decoration-none me-2 badge-soft-info">products:</span>
                                            <div class="flex-1 fs--1 title">Most popular products</div>
                                        </div>
                                    </a>
                                    <hr class="text-200 dark__text-900">
                                    <h6 class="dropdown-header fw-medium text-uppercase px-x1 fs--2 pt-0 pb-2">
                                        Files</h6><a class="dropdown-item px-x1 py-2" href="#!">
                                        <div class="d-flex align-items-center">
                                            <div class="file-thumbnail me-2"><img
                                                    class="border h-100 w-100 fit-cover rounded-3"
                                                    src="assets/img/products/3-thumb.png" alt=""></div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 title">iPhone</h6>
                                                <p class="fs--2 mb-0 d-flex"><span
                                                        class="fw-semi-bold">Antony</span><span
                                                        class="fw-medium text-600 ms-2">27 Sep at 10:30 AM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a><a class="dropdown-item px-x1 py-2" href="#!">
                                        <div class="d-flex align-items-center">
                                            <div class="file-thumbnail me-2"><img class="img-fluid"
                                                    src="assets/img/icons/zip.png" alt=""></div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 title">Falcon v1.8.2</h6>
                                                <p class="fs--2 mb-0 d-flex"><span
                                                        class="fw-semi-bold">John</span><span
                                                        class="fw-medium text-600 ms-2">30 Sep at 12:30 PM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <hr class="text-200 dark__text-900">
                                    <h6 class="dropdown-header fw-medium text-uppercase px-x1 fs--2 pt-0 pb-2">
                                        Members</h6><a class="dropdown-item px-x1 py-2"
                                        href="pages/user/profile.html">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-l status-online me-2">
                                                <img class="rounded-circle" src="assets/img/team/1.jpg"
                                                    alt="">
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 title">Anna Karinina</h6>
                                                <p class="fs--2 mb-0 d-flex">Technext Limited</p>
                                            </div>
                                        </div>
                                    </a><a class="dropdown-item px-x1 py-2" href="pages/user/profile.html">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-l me-2">
                                                <img class="rounded-circle" src="assets/img/team/2.jpg"
                                                    alt="">
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 title">Antony Hopkins</h6>
                                                <p class="fs--2 mb-0 d-flex">Brain Trust</p>
                                            </div>
                                        </div>
                                    </a><a class="dropdown-item px-x1 py-2" href="pages/user/profile.html">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-l me-2">
                                                <img class="rounded-circle" src="assets/img/team/3.jpg"
                                                    alt="">
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mb-0 title">Emma Watson</h6>
                                                <p class="fs--2 mb-0 d-flex">Google</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="text-center mt-n3">
                                    <p class="fallback fw-bold fs-1 d-none">No Result Found.</p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul> --}}


                <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                    <li class="nav-item">
                        <div class="theme-control-toggle fa-icon-wait px-2">
                            <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                                type="checkbox" data-theme-control="theme" value="dark">
                                <label class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                                for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                aria-label="Switch to light theme"
                                data-bs-original-title="Switch to light theme">
                                    <span class="fas fa-sun fs-0"></span>
                                </label>
                                <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                                for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                aria-label="Switch to dark theme"
                                data-bs-original-title="Switch to dark theme">
                                {{-- <svg
                                    class="svg-inline--fa fa-moon fa-w-16 fs-0" aria-hidden="true"
                                    focusable="false" data-prefix="fas" data-icon="moon" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                    <path fill="currentColor"
                                        d="M283.211 512c78.962 0 151.079-35.925 198.857-94.792 7.068-8.708-.639-21.43-11.562-19.35-124.203 23.654-238.262-71.576-238.262-196.954 0-72.222 38.662-138.635 101.498-174.394 9.686-5.512 7.25-20.197-3.756-22.23A258.156 258.156 0 0 0 283.211 0c-141.309 0-256 114.511-256 256 0 141.309 114.511 256 256 256z">
                                    </path>
                                </svg> --}}
                                <span class="fas fa-moon fs-0"></span></label>
                        </div>
                    </li>


                    <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="avatar avatar-xl">
                                <img class="rounded-circle" src="{{ asset('adminassets/assets/img/team/3-thumb.png') }}" alt="">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                            aria-labelledby="navbarDropdownUser">
                            <div class="bg-white dark__bg-1000 rounded-2 py-2">
                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>


            {{-- =======================================================================================

                                    ------NAVBAR PANEL ENDS--------

            ======================================================================================= --}}

                <script>
                    var navbarPosition = localStorage.getItem('navbarPosition');
                    var navbarVertical = document.querySelector('.navbar-vertical');
                    var navbarTopVertical = document.querySelector('.content .navbar-top');
                    var navbarTop = document.querySelector('[data-layout] .navbar-top:not([data-double-top-nav');
                    var navbarDoubleTop = document.querySelector('[data-double-top-nav]');
                    var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

                    if (localStorage.getItem('navbarPosition') === 'double-top') {
                        document.documentElement.classList.toggle('double-top-nav-layout');
                    }

                    if (navbarPosition === 'top') {
                        navbarTop.removeAttribute('style');
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarVertical.remove(navbarVertical);
                        navbarTopCombo.remove(navbarTopCombo);
                        navbarDoubleTop.remove(navbarDoubleTop);
                    } else if (navbarPosition === 'combo') {
                        navbarVertical.removeAttribute('style');
                        navbarTopCombo.removeAttribute('style');
                        navbarTop.remove(navbarTop);
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarDoubleTop.remove(navbarDoubleTop);
                    } else if (navbarPosition === 'double-top') {
                        navbarDoubleTop.removeAttribute('style');
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarVertical.remove(navbarVertical);
                        navbarTop.remove(navbarTop);
                        navbarTopCombo.remove(navbarTopCombo);
                    } else {
                        navbarVertical.removeAttribute('style');
                        navbarTopVertical.removeAttribute('style');
                        navbarTop.remove(navbarTop);
                        navbarDoubleTop.remove(navbarDoubleTop);
                        navbarTopCombo.remove(navbarTopCombo);
                    }
                </script>

            {{-- =======================================================================================

                                    ------CONTENT STARTS--------

            ======================================================================================= --}}


                <div class="">
                    @yield('content')
                </div>

            {{-- =======================================================================================

                                    ------CONTENT ENDS--------

            ======================================================================================= --}}     
            
            {{-- =======================================================================================

                                    ------FOOTER STARTS--------

            ======================================================================================= --}}

                <footer class="footer">
                    <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">
                                Thank you for creating with AashaTech Pvt Ltd 
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
            {{-- =======================================================================================

                                    ------FOOTER ENDS--------

            ======================================================================================= --}}


        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts from dashboard-->
    <!-- ===============================================-->



    <script src="{{ asset('adminassets/assets/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/datatables.net/js/dataTables.responsive.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/datatables.net/js/dataTables.buttons.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset('adminassets/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset('adminassets/assets/js/theme.js') }}"></script>
    <script src="{{ asset('adminassets/wwwroot/assets/nepali.datepicker.v3.7/js/nepali.datepicker.v3.7.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('adminassets/assets/jquery-mask/dist/jquery.mask.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/scripts/language.js') }}"></script>
    {{-- <script src="{{ asset('adminassets/scripts/common.js') }}"></script> --}}
    <script src="{{ asset('adminassets/assets/js/flatpickr.js') }}"></script>


    <script type="text/javascript">
        InitializeUnicodeNepali();
    </script>

    {{-- <script>
        $(function() {
            var current = location.pathname;
            $('.navbar .nav-item .nav-link ').each(function() {
                var $this = $(this);
                // if the current path is like this link, make it active
                if ($this.attr('href').indexOf(current) !== -1) {
                    $this.closest("nav-link.dropdown-indicator.collapsed").removeClass('collapsed');
                    $this.closest(".nav.false.collapse").addClass('show');
                    $this.addClass('active');
                }
            })
        })
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
        crossorigin="anonymous"></script>


</body>

</html>
