<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>EQ</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('css/dashlite.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('css/theme.css') }}">

</head>

<body class="nk-body npc-invest bg-lighter ">
    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header nk-header-fluid is-theme">
                <div class="container-xl wide-xl">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger mr-sm-2 d-lg-none">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-menu"></em></a>
                        </div>
                        {{-- <div class="nk-header-brand">
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div><!-- .nk-header-brand --> --}}
                        <div class="nk-header-menu" data-content="headerNav">
                            {{-- <div class="nk-header-mobile">
                                <div class="nk-header-brand">
                                    <a href="html/index.html" class="logo-link">
                                        <img class="logo-light logo-img" src="./images/logo.png" srcset="./images/logo2x.png 2x" alt="logo">
                                        <img class="logo-dark logo-img" src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                                    </a>
                                </div>
                                <div class="nk-menu-trigger mr-n2">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="headerNav"><em class="icon ni ni-arrow-left"></em></a>
                                </div>
                            </div> --}}
                            <ul class="nk-menu nk-menu-main">
                                @role('employee')
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="navbar-btn nk-menu-link">
                                        <span class="nk-menu-text">Home</span>
                                    </a>
                                </li><!-- .nk-menu-item -->

                                <li class="nk-menu-item has-sub">
                                    <a href="{{ route('employees.index') }}" class="nk-menu-link ">
                                        <span class="nk-menu-text">My Exams</span>
                                    </a>
                                    <!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                                <li class="nk-menu-item ">
                                    <a href="#" class="nk-menu-link ">
                                        <span class="nk-menu-text">Previous Record</span>
                                    </a>
                                </li><!-- .nk-menu-item -->
                                @endrole

                                @role('admin')
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-text">Create Test</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item has-sub">
                                            <a href="{{ route('exams.index') }}" class="nk-menu-link">
                                                <span class="nk-menu-text">MCQs</span>
                                            </a>
                                        </li><!-- .nk-menu-item -->
                                        <li class="nk-menu-item has-sub">
                                            <a href="#" class="nk-menu-link ">
                                                <span class="nk-menu-text">Subjective Q/A</span>
                                            </a>
                                        </li><!-- .nk-menu-item -->
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="{{ route('admin.subject') }}" class="nk-menu-link ">
                                        <span class="nk-menu-text">Create Subject</span>
                                    </a>
                                </li>
                                {{-- <li class="nk-menu-item has-sub">
                                    <a href="{{ route('exams.index') }}" class="nk-menu-link ">
                                        <span class="nk-menu-text">Exams</span>
                                    </a>
                                </li> --}}
                                <li class="nk-menu-item has-sub">
                                    <a href="{{ route('admin.show') }}" class="nk-menu-link">
                                        <span class="nk-menu-text">Employees</span>
                                    </a>
                                    <!-- .nk-menu-sub -->
                                </li><!-- .nk-menu-item -->
                            @endrole
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-header-menu -->
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                <!-- .dropdown -->

                                <li class="dropdown user-dropdown order-sm-first">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>
                                            <div class="user-info d-none d-xl-block">

                                                <div class="user-status">Administrator</div>
                                                <div class="user-name dropdown-indicator">{{ Auth::user()->name }}</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1 is-light">
                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <span>AB</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{ Auth::user()->name }}</span>
                                                    <span class="sub-text">{{ Auth::user()->email }}</span>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="html/invest/profile.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                <li><a href="html/invest/profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"><em class="icon ni ni-signout"></em><span>Sign out</span></a>
                                                </li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </div>
                                    </div>
                                </li><!-- .dropdown -->
                            </ul><!-- .nk-quick-nav -->
                        </div><!-- .nk-header-tools -->
                    </div><!-- .nk-header-wrap -->
                </div><!-- .container-fliud -->
            </div>
            <!-- main header @e -->
            <div class="container">
                @yield('content')
            </div>
            <!-- footer @s -->
            <div class="nk-footer nk-footer-fluid bg-lighter">
                <div class="container-xl">
                    <div class="nk-footer-wrap">
                        <div class="nk-footer-copyright"> &copy; 2020 - <a href="#">EQ System</a>
                        </div>
                        {{-- <div class="nk-footer-links">
                            <ul class="nav nav-sm">
                                <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('js/bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/charts/gd-invest.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script>
        @if(Session::has('success'))
            toastr.options.showMethod = 'slideDown';
            toastr.options.hideMethod = 'slideUp';
            toastr.options.closeMethod = 'slideUp';
            toastr.options.closeButton = true;
            toastr.success("{{ Session::get('success') }}");
        @endif
    </script>

    @yield('js')


    {{-- @endsection --}}
</body>

</html>
