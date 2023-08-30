<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>

    {{-- BOOTSTRAP --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

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

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}" />
    <!-- Icons -->
    <script data-search-pseudo-elements="" defer=""
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous">
    </script>

    <script src="https://kit.fontawesome.com/3c30e9bd33.js" crossorigin="anonymous"></script>

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
        <div class="container-fluid">
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
                    </div>

                </div>
                <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                    <div class="navbar-vertical-content scrollbar">
                        <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                            <li class="nav-item">
                                <!-- parent pages-->
                                <a class="nav-link dropdown-indicator" href="#dashboard" role="button"
                                    data-bs-toggle="collapse" aria-expanded="true" aria-controls="dashboard">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon">

                                            <!-- <span class="fas fa-chart-pie"></span> Font Awesome fontawesome.com --></span><span
                                            class="nav-link-text ps-1">System</span></div>
                                </a>
                                <ul class="nav collapse show" id="dashboard">
                                    <li class="nav-item"><a class="nav-link active" href="{{ route('dashboard') }}">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-icon">
                                                    <i class="fas fa-clipboard-list"></i>
                                                </span>
                                                <span class="nav-link-text ps-1">All
                                                    Dashboard</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link active" href="{{ route('admin.index') }}">
                                            <div class="d-flex align-items-center">
                                                <span class="nav-link-icon">
                                                    <i class="fas fa-user-cog"></i>
                                                </span>
                                                <span
                                                    class="nav-link-text ps-1">Admin</span>
                                                </div>
                                        </a><!-- more inner pages-->
                                    </li>
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
                                <a class="nav-link" href="{{ route('admin.pos.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-map-pin"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">POS</span>
                                    </div>
                                </a><!-- parent pages-->
                            </li>

                            <li class="nav-item">
                                <!-- label-->
                                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                    <div class="col-auto navbar-vertical-label">Products</div>
                                    <div class="col ps-0">
                                        <hr class="mb-0 navbar-vertical-divider">
                                    </div>
                                </div>
                                <a class="nav-link" href="{{ route('admin.warehouse.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-warehouse"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">Warehouses</span>
                                    </div>
                                </a><!-- parent pages-->

                                <a class="nav-link" href="{{ route('admin.category.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-boxes"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">Categories</span>
                                    </div>
                                </a><!-- parent pages-->

                                <a class="nav-link" href="{{ route('admin.unit.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-sort-amount-up-alt"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">Units</span>
                                    </div>
                                </a>

                                <a class="nav-link" href="{{ route('admin.product.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fab fa-product-hunt"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">Products</span>
                                    </div>
                                </a><!-- parent pages-->




                            </li>
                            <li class="nav-item">
                                <!-- label-->
                                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                    <div class="col-auto navbar-vertical-label">Pages</div>
                                    <div class="col ps-0">
                                        <hr class="mb-0 navbar-vertical-divider">
                                    </div>
                                </div>
                                <a class="nav-link" href="{{ route('admin.supplier.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-user-tie"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">Suppliers</span>
                                    </div>
                                </a><!-- parent pages-->

                                <a class="nav-link" href="{{ route('admin.customer.index') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-user-plus"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">Customers</span>
                                    </div>
                                </a><!-- parent pages-->
                            </li>
                            <li class="nav-item">
                                <!-- label-->
                                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                    <div class="col-auto navbar-vertical-label">Orders</div>
                                    <div class="col ps-0">
                                        <hr class="mb-0 navbar-vertical-divider">
                                    </div>
                                </div>
                                <a class="nav-link" href="{{ route('admin.order.completeOrders') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-hourglass"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">Complete</span>
                                    </div>
                                </a><!-- parent pages-->

                                <a class="nav-link" href="{{ route('admin.order.pendingOrders') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-hourglass-start"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">Pending</span>
                                    </div>
                                </a><!-- parent pages-->

                                <a class="nav-link" href="{{ route('admin.order.dueOrders') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-hourglass-half"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">Due</span>
                                    </div>
                                </a><!-- parent pages-->
                            </li>

                            <li class="nav-item">
                                <!-- label-->
                                <div class="row navbar-vertical-label-wrapper mt-3 mb-2">
                                    <div class="col-auto navbar-vertical-label">Purchases</div>
                                    <div class="col ps-0">
                                        <hr class="mb-0 navbar-vertical-divider">
                                    </div>
                                </div>
                                <a class="nav-link" href="{{ route('admin.purchase.allpurchases') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-reply-all"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">All</span>
                                    </div>
                                </a><!-- parent pages-->

                                <a class="nav-link" href="{{ route('admin.purchase.approvedPurchase') }}" role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-check-square"></i>
                                        </span>
                                        <span class="nav-link-text ps-1">Approval</span>
                                    </div>
                                </a><!-- parent pages-->

                                <a class="nav-link" href="{{ route('admin.purchase.dailyPurchaseReport') }}"
                                    role="button">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-icon">
                                            <i class="fas fa-file-word"></i>

                                        </span>
                                        <span class="nav-link-text ps-1">Daily Purchase Report</span>
                                    </div>
                                </a><!-- parent pages-->
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>




            {{-- =======================================================================================

            ------SIDEBAR PANEL ENDS--------

            ======================================================================================= --}}







            {{-- =======================================================================================

            ------NAVBAR PANEL STARTS--------

            ======================================================================================= --}}

            <div class="container shift-right-navbar">
                <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand navbar-glass-shadow">
                    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                        aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation">
                        <span class="navbar-toggle-icon"><span class="toggle-line"></span></span>
                    </button>
                    <a class="navbar-brand me-1 me-sm-3" href="index.html">
                        <div class="d-flex align-items-center"><img class="me-2" src="" alt="" width="40"><span
                                class="font-sans-serif">falcon</span>
                        </div>

                    </a>

                    <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                        <li class="nav-item">
                            <div class="theme-control-toggle fa-icon-wait px-2">
                                <input class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                                    type="checkbox" data-theme-control="theme" value="dark">
                                <label class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                                    for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                    aria-label="Switch to light theme" data-bs-original-title="Switch to light theme">
                                    <span class="fas fa-sun fs-0"></span>
                                </label>
                                <label class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                                    for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                    aria-label="Switch to dark theme" data-bs-original-title="Switch to dark theme">

                                    <span class="fas fa-moon fs-0"></span></label>
                            </div>
                        </li>

                        <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-xl">
                                    <img class="rounded-circle"
                                        src="{{ asset('adminassets/assets/img/team/3-thumb.png') }}" alt="">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                                aria-labelledby="navbarDropdownUser">
                                <div class="bg-white dark__bg-1000 rounded-2 py-2">

                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
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


                <div class="container">
                    @yield('content')
                </div>

                {{-- =======================================================================================

                ------CONTENT ENDS--------

                ======================================================================================= --}}

                {{-- =======================================================================================

                ------FOOTER STARTS--------

                ======================================================================================= --}}

                {{-- <footer class="footer">
                    <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">
                                Thank you for creating with AashaTech Pvt Ltd
                            </p>
                        </div>
                    </div>
                </footer> --}}

                <footer class="footer fixed-bottom">
                    <div class="row g-0 justify-content-center fs--1 mt-4 mb-3">
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
    <script src="{{ asset('adminassets/assets/jquery-validation/dist/jquery.validate.min.js') }}"
        type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/assets/datatables.net/js/jquery.dataTables.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('adminassets/assets/datatables.net/js/dataTables.responsive.min.js') }}"
        type="text/javascript">
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
    <script src="{{ asset('adminassets/assets/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('adminassets/assets/jquery-mask/dist/jquery.mask.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('adminassets/scripts/language.js') }}"></script>
    <script src="{{ asset('adminassets/scripts/common.js') }}"></script>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.1.1.js"
        integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>

</body>

</html>
