<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" 
    data-layout-mode="{{ isset($settingTheme) ? $settingTheme->data_layout_mode : 'detached' }}" 
    data-topbar-color="{{ isset($settingTheme) ? $settingTheme->data_topbar_color : 'light' }}"
    data-bs-theme="{{ isset($settingTheme) ? $settingTheme->data_bs_theme : 'dark' }}" 
    data-two-column-color="{{ isset($settingTheme) ? $settingTheme->data_two_column_color : 'light' }}" 
    data-layout-width="{{ isset($settingTheme) ? $settingTheme->data_layout_width : 'default' }}" 
    data-menu-color="{{ isset($settingTheme) ? $settingTheme->data_menu_color : 'light' }}" 
    data-menu-icon="{{ isset($settingTheme) ? $settingTheme->data_menu_icon : 'default' }}" 
    data-sidenav-size="{{ isset($settingTheme) ? $settingTheme->data_sidenav_size : 'condensed' }}" 
    data-sidenav-user="true">
  
    <head>
        <meta charset="utf-8" />
        <title>{{env('APP_NAME')}} - Painel Gerenciador</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="author" content="WHI - Web de Alta Inspiração">
        <meta name="description" content="Painel gerenciador de conteúdo {{env('APP_NAME')}}">
        <meta name="copyright" content="© 2024 WHI - Web de Alta Inspiração." />
        <meta name="robots" content="none">
        <meta name="googlebot" content="noarchive">
        
        <link href="{{ asset('build/admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.body.classList.add('loaded');
            });
        </script>

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('build/admin/images/whi.png') }}">

        <!-- Load da pagina -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('build/admin/js/load.js') }}"></script>

        <!-- plugin css -->
        <link rel="stylesheet" href="{{ asset('build/admin/js/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">

        <!-- Bootstrap css -->
        <link href="{{ asset('build/admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

        <!-- App css -->
        <link href="{{ asset('build/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('build/admin/js/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('build/admin/js/libs/dropify/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Icons css -->
        <link href="{{ asset('build/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('build/admin/js/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
        <!-- Theme Config Js -->
        <script src="{{ asset('build/admin/js/head.js') }}"></script>

        <script>
            $url = "{{url('')}}";
        </script>
    </head>

    <body class="loading">

        <!-- Begin page -->
        <div id="wrapper">

            
            <!-- ========== Menu ========== -->
            <div class="app-menu">  

                <!-- Brand Logo -->
                <div class="logo-box">
                    <!-- Brand Logo Light -->
                    <a href="{{route('admin.dashboard')}}" class="logo-light">
                        <img src="{{asset('build/admin/images/whi.png')}}" alt="logo" class="logo-lg">
                        <img src="{{asset('build/admin/images/whi.png')}}" alt="small logo" class="logo-sm">
                    </a>

                    <!-- Brand Logo Dark -->
                    <a href="{{route('admin.dashboard')}}" class="logo-dark">
                        <img src="{{asset('build/admin/images/whi.png')}}" alt="dark logo" class="logo-lg">
                        <img src="{{asset('build/admin/images/whi.png')}}" alt="small logo" class="logo-sm">
                    </a>
                </div>

                <!-- menu-left -->
                <div class="scrollbar">

                    <!--- Menu -->
                    <ul class="menu">

                        <li class="menu-title">Listagem</li>
                        @if (Auth::user()->hasPermissionTo('categorias dos produtos.visualizar') ||
                        Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                        Auth::user()->hasRole('Super'))
                            <li class="menu-item">
                                <a href="{{route('admin.dashboard.productCategory.index')}}" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-format-list-bulleted-square"></i></span>
                                    <span class="menu-text"> Categorias</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->hasPermissionTo('slides.visualizar') ||
                        Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                        Auth::user()->hasRole('Super'))
                            <li class="menu-item">
                                <a href="{{route('admin.dashboard.slide.index')}}" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-image-size-select-actual"></i></span>
                                    <span class="menu-text"> Slides </span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->hasPermissionTo('auditoria.visualizar') ||
                        Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                        Auth::user()->hasRole('Super'))
                            <li class="menu-item">
                                <a href="{{route('admin.dashboard.audit.index')}}" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-clipboard-text"></i></span>
                                    <span class="menu-text"> {{__('dashboard.audit')}} </span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->hasPermissionTo('email.visualizar') ||
                        Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                        Auth::user()->hasRole('Super'))
                            <li class="menu-item">
                                <a href="{{route('admin.dashboard.settingEmail.index')}}" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-email"></i></span>
                                    <span class="menu-text"> {{__('dashboard.setting_smtp')}} </span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->hasPermissionTo('grupo.visualizar') ||
                        Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                        Auth::user()->hasRole('Super'))
                            <li class="menu-item">
                                <a href="{{route('admin.dashboard.group.index')}}" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-account-group"></i></span>
                                    <span class="menu-text"> {{__('dashboard.group_and_permission')}}</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->hasPermissionTo('usuario.visualizar') ||
                        Auth::user()->hasPermissionTo('usuario.tornar usuario master') || 
                        Auth::user()->hasRole('Super'))
                            <li class="menu-item">
                                <a href="{{route('admin.dashboard.user.index')}}" class="menu-link">
                                    <span class="menu-icon"><i class="mdi mdi-account-multiple"></i></span>
                                    <span class="menu-text"> {{__('dashboard.users')}} </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <!--- End Menu -->
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- ========== Left menu End ========== -->

            

            

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

                <!-- ========== Topbar Start ========== -->
                <div class="navbar-custom">
                    <div class="topbar">
                        <div class="topbar-menu d-flex align-items-center gap-1">

                            <!-- Topbar Brand Logo -->
                            <div class="logo-box">
                                <!-- Brand Logo Light -->
                                <a href="{{route('admin.dashboard')}}" class="logo-light">
                                    <img src="{{asset('build/admin/images/whi.png')}}" alt="logo" class="logo-lg">
                                    <img src="{{asset('build/admin/images/whi.png')}}" alt="small logo" class="logo-sm">
                                </a>

                                <!-- Brand Logo Dark -->
                                <a href="{{route('admin.dashboard')}}" class="logo-dark">
                                    <img src="{{asset('build/admin/images/whi.png')}}" alt="dark logo" class="logo-lg">
                                    <img src="{{asset('build/admin/images/whi.png')}}" alt="small logo" class="logo-sm">
                                </a>
                            </div>

                            <!-- Sidebar Menu Toggle Button -->
                            <button class="button-toggle-menu">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </div>

                        <ul class="topbar-menu d-flex align-items-center">
                            <!-- Topbar Search Form -->
                            <li class="app-search dropdown me-3 d-none d-lg-block">
                                <form>
                                    <input type="search" class="form-control rounded-pill" placeholder="Search..." id="top-search">
                                    <span class="fe-search search-icon font-16"></span>
                                </form>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h5 class="text-overflow mb-2">Found 22 results</h5>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-home me-1"></i>
                                        <span>Analytics Report</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-aperture me-1"></i>
                                        <span>How can I help you?</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="fe-settings me-1"></i>
                                        <span>User profile settings</span>
                                    </a>

                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                                    </div>

                                    <div class="notification-list">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex align-items-start">
                                                <img class="d-flex me-2 rounded-circle" src="{{asset('build/admin/images/users/user-2.jpg')}}" alt="Generic placeholder image" height="32">
                                                <div class="w-100">
                                                    <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                                    <span class="font-12 mb-0">UI Designer</span>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="d-flex align-items-start">
                                                <img class="d-flex me-2 rounded-circle" src="{{asset('build/admin/images/users/user-5.jpg')}}" alt="Generic placeholder image" height="32">
                                                <div class="w-100">
                                                    <h5 class="m-0 font-14">Jacob Deo</h5>
                                                    <span class="font-12 mb-0">Developer</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <!-- Fullscreen Button -->
                            <li class="d-none d-md-inline-block">
                                <a class="nav-link waves-effect waves-light" href="" data-toggle="fullscreen">
                                    <i class="fe-maximize font-22"></i>
                                </a>
                            </li>

                            <!-- Search Dropdown (for Mobile/Tablet) -->
                            <li class="dropdown d-lg-none">
                                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="ri-search-line font-22"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                                    <form class="p-3">
                                        <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                    </form>
                                </div>
                            </li>
                            <!-- Language flag dropdown  -->
                            <li class="dropdown d-none d-md-inline-block">
                                <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    @php
                                        $locales = [
                                            'pt' => 'br.jpg',
                                            'en' => 'us.jpg',
                                            'es' => 'spain.jpg'
                                        ];
                                        $locale = session()->get('locale');
                                    @endphp

                                    @if (array_key_exists($locale, $locales))
                                        <img src="{{ asset('build/admin/images/flags/' . $locales[$locale]) }}" alt="user-image" class="me-0 me-sm-1" height="18">
                                        @else
                                        <img src="{{ asset('build/admin/images/flags/br.jpg') }}" alt="user-image" class="me-0 me-sm-1" height="18">
                                    @endif
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                    <!-- item-->
                                    <a href="{{ route('change.language', 'pt') }}" class="dropdown-item">
                                        <img src="{{asset('build/admin/images/flags/br.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-midle">BR</span>
                                    </a>

                                    <!-- item-->
                                    <a href="{{ route('change.language', 'en') }}" class="dropdown-item">
                                        <img src="{{asset('build/admin/images/flags/us.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-midle">EN</span>
                                    </a>

                                    <!-- item-->
                                    <a href="{{ route('change.language', 'es') }}" class="dropdown-item">
                                        <img src="{{asset('build/admin/images/flags/spain.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-midle">ES</span>
                                    </a>
                                </div>
                            </li>
                            @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('notificacao.visualizar'))
                                <!-- Notofication dropdown -->
                                <li class="dropdown notification-list">
                                    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                        <i class="fe-bell font-22"></i>
                                        @if (Auth::user()->hasRole('Super') || 
                                            Auth::user()->can('usuario.tornar usuario master') || 
                                            Auth::user()->can('notificacao.visualizar') &&  Auth::user()->can('notificacao.notificacao de auditoria'))
                                            <span class="badge bg-danger rounded-circle noti-icon-badge">{{ isset($auditCount) ? $auditCount : "0" }}</span>
                                        @endif
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                                        <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-0 font-16 fw-semibold"> {{__('dashboard.notification')}}</h6>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="javascript: void(0);" class="text-dark text-decoration-underline" id="clear-all-notifications">
                                                        <small>{{__('dashboard.all_clear')}}</small>
                                                    </a>
                                                </div>                                                                                       
                                            </div>
                                        </div>

                                        <div class="px-1" style="max-height: 300px;" data-simplebar>
                                            @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can('notificacao.notificacao de auditoria'))
                                                @if (isset($auditorias) && $auditorias->count() > 0)
                                                    <h5 class="text-muted font-13 fw-normal mt-2">{{__('dashboard.day_notification')}}</h5>
                                                    <!-- item-->
                                                    @foreach ($auditorias as $auditoria)
                                                        <div id="notificacao-{{ $auditoria->id }}" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                                            <div class="card-body" title="{{ __('dashboard.notification_message_one') . ' ' . ($modelName = \App\Models\AuditActivity::getModelName($auditoria->subject_type)). ' ' . __('dashboard.notification_message_thwo') . ' ' . ($auditoria->causer->name ?? __('dashboard.notification_message_three')) }}">
                                                                <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close" onclick="marcarComoLida({{ $auditoria->id }})"></i></span>
                                                                <a href="{{route('admin.dashboard.audit.show', $auditoria->id)}}">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0">
                                                                            <div class="notify-icon bg-primary">
                                                                                <i class="mdi mdi-comment-account-outline"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 text-truncate ms-2">
                                                                            <h5 class="noti-item-title fw-semibold font-14">{{ isset($auditoria->causer->name)?$auditoria->causer->name:'Não encontrado' }} <small class="fw-normal text-muted ms-1">{{$auditoria->created_at->format("F j, Y, H:i:s")}}</small></h5>
                                                                            <small class="noti-item-subtitle text-muted">
                                                                                {{ 'Modificações foram realizadas em ' . ($modelName = \App\Models\AuditActivity::getModelName($auditoria->subject_type)) . ' pelo usuário ' . ($auditoria->causer->name ?? 'Não encontrado') }}
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @else
                                                    <h5 class="m-0 p-2 ps-1 font-11 fw-semibold">Nenhuma notificação disponível no momento.</h5>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endif

                            <!-- Light/Dark Mode Toggle Button -->
                            <li class="d-none d-sm-inline-block">
                                <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                                    <form action="{{ route('admin.dashboard.settingThemeUpdate') }}" method="POST">
                                        @csrf
                                        <i class="ri-moon-line font-22"></i>
                                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="data-bs-theme" value="{{ isset($settingTheme) ? $settingTheme->data_bs_theme : 'light' }}">
                                        <input type="hidden" name="data-layout-width" value="{{ isset($settingTheme) ? $settingTheme->data_layout_width : 'default' }}">
                                        <input type="hidden" name="data-layout-mode" value="{{ isset($settingTheme) ? $settingTheme->data_layout_mode : 'detached' }}">
                                        <input type="hidden" name="data-topbar-color" value="{{ isset($settingTheme) ? $settingTheme->data_topbar_color : 'light' }}">
                                        <input type="hidden" name="data-menu-color" value="{{ isset($settingTheme) ? $settingTheme->data_menu_color : 'light' }}">
                                        <input type="hidden" name="data-two-column-color" value="{{ isset($settingTheme) ? $settingTheme->data_two_column_color : 'light' }}">
                                        <input type="hidden" name="data-menu-icon" value="{{ isset($settingTheme) ? $settingTheme->data_menu_icon : 'default' }}">
                                        <input type="hidden" name="data-sidenav-size" value="{{ isset($settingTheme) ? $settingTheme->data_sidenav_size : 'condensed' }}">
                                    </form>
                                </div>
                            </li>

                            <!-- User Dropdown -->
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    @if (Auth::user()->path_image)
                                        <img src="{{asset('storage/'.Auth::user()->path_image)}}" alt="user-image" class="rounded-circle">
                                        @else
                                        <img src="{{asset('build/admin/images/users/user-3.jpg')}}" alt="user-image" class="rounded-circle">
                                    @endif
                                    <span class="ms-1 d-none d-md-inline-block">
                                        {{$names = collect(explode(' ', Auth::user()->name))->slice(0, 2)->implode(' ')}} <i class="mdi mdi-chevron-down"></i>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">{{__('dashboard.welcome')}}!</h6>
                                    </div>                            
                                    
                                    @if (Auth::user()->hasRole('Super') || Auth::user()->can('usuario.tornar usuario master') || Auth::user()->can(['usuario.visualizar', 'usuario.editar']))
                                        <!-- item-->
                                        <a href="{{route('admin.dashboard.user.edit', ['user' => $user->id])}}" class="dropdown-item notify-item">
                                            <i class="fe-user"></i>
                                            <span>{{__('dashboard.profile')}}</span>
                                        </a>                                    
                                    @endif

                                    <!-- item-->
                                    <a href="#theme-settings-offcanvas" class="dropdown-item notify-item"  data-bs-toggle="offcanvas" >
                                        <i class="fe-settings"></i>
                                        <span>{{__('dashboard.setting')}}</span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <!-- item-->
                                    <a href="{{route('admin.dashboard.user.logout')}}" class="dropdown-item notify-item">
                                        <i class="fe-log-out"></i>
                                        <span>{{__('dashboard.logout')}}</span>
                                    </a>

                                </div>
                            </li>

                            <!-- Right Bar offcanvas button (Theme Customization Panel) -->
                            <li>
                                <a class="nav-link waves-effect waves-light" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                                    <i class="fe-settings font-22"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ========== Topbar End ========== -->

                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        @yield('content')                        

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div><script>document.write(new Date().getFullYear())</script> © Ubold - <a href="https://coderthemes.com/" target="_blank">Coderthemes.com</a></div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-none d-md-flex gap-4 align-item-center justify-content-md-end footer-links">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Support</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Theme Settings -->
        <div class="offcanvas offcanvas-end right-bar" tabindex="-1" id="theme-settings-offcanvas">
            <div class="d-flex align-items-center w-100 p-0 offcanvas-header">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-bordered nav-justified w-100" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link py-2 active" data-bs-toggle="tab" href="#settingTheme" role="tab">
                            <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="offcanvas-body p-3 h-100" data-simplebar>
                <!-- Tab panes -->
                <div class="tab-content pt-0">
                    <div class="tab-pane active" id="settingTheme" role="tabpanel">
                        <form action="{{route('admin.dashboard.settingTheme')}}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

                            <div class="mt-n3">
                                <h6 class="fw-medium py-2 px-3 font-13 text-uppercase bg-light mx-n3 mt-n3 mb-3">
                                    <span class="d-block py-1">{{__('dashboard.setting_theme')}}</span>
                                </h6>
                            </div>

                            <div class="alert alert-warning" role="alert">
                               <strong>{{__('dashboard.text_title_description_theme')}}</strong> {{__('dashboard.text_description_theme')}}
                            </div>

                            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">{{__('dashboard.color_scheme')}}</h5>

                            <div class="colorscheme-cardradio">
                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-bs-theme" 
                                            {{ isset($settingTheme) && $settingTheme->data_bs_theme == 'light' ? 'checked' : '' }}
                                            id="layout-color-light" value="light">
                                        <label class="form-check-label" for="layout-color-light">{{__('dashboard.color_light')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-bs-theme" 
                                            {{ isset($settingTheme) && $settingTheme->data_bs_theme == 'dark' ? 'checked' : '' }}
                                            id="layout-color-dark" value="dark">
                                        <label class="form-check-label" for="layout-color-dark">{{__('dashboard.color_dark')}}</label>
                                    </div>
                                </div>
                            </div>

                            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">{{__('dashboard.content_width')}}</h5>
                            <div class="d-flex flex-column gap-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="radio" name="data-layout-width" {{isset($settingTheme) && $settingTheme->data_layout_width=='default'?'checked':''}} id="layout-width-default" value="default">
                                    <label class="form-check-label" for="layout-width-default">{{__('dashboard.content_width_default')}}</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="radio" name="data-layout-width" {{isset($settingTheme) && $settingTheme->data_layout_width=='boxed'?'checked':''}} id="layout-width-boxed" value="boxed">
                                    <label class="form-check-label" for="layout-width-boxed">{{__('dashboard.content_width_boxed')}}</label>
                                </div>
                            </div>

                            <div id="layout-mode">
                                <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">{{__('dashboard.layout_mode')}}</h5>

                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-layout-mode" {{isset($settingTheme) && $settingTheme->data_layout_mode=='default'?'checked':''}} id="layout-mode-default" value="default">
                                        <label class="form-check-label" for="layout-mode-default">{{__('dashboard.layout_mode_default')}}</label>
                                    </div>


                                    <div id="layout-detached">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="radio" name="data-layout-mode" {{isset($settingTheme) && $settingTheme->data_layout_mode=='detached'?'checked':''}} id="layout-mode-detached" value="detached">
                                            <label class="form-check-label" for="layout-mode-detached">{{__('dashboard.layout_mode_detached')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">{{__('dashboard.topbar_color')}}</h5>

                            <div class="d-flex flex-column gap-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="radio" name="data-topbar-color" {{isset($settingTheme) && $settingTheme->data_topbar_color=='light'?'checked':''}} id="topbar-color-light" value="light">
                                    <label class="form-check-label" for="topbar-color-light">{{__('dashboard.topbar_color_light')}}</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="radio" name="data-topbar-color" {{isset($settingTheme) && $settingTheme->data_topbar_color=='dark'?'checked':''}} id="topbar-color-dark" value="dark">
                                    <label class="form-check-label" for="topbar-color-dark">{{__('dashboard.topbar_color_dark')}}</label>
                                </div>

                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="radio" name="data-topbar-color" {{isset($settingTheme) && $settingTheme->data_topbar_color=='brand'?'checked':''}} id="topbar-color-brand" value="brand">
                                    <label class="form-check-label" for="topbar-color-brand">{{__('dashboard.topbar_color_brand')}}</label>
                                </div>
                            </div>

                            <div>
                                <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">{{__('dashboard.menu_color')}}</h5>

                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-menu-color" {{isset($settingTheme) && $settingTheme->data_menu_color=='light'?'checked':''}} id="leftbar-color-light" value="light">
                                        <label class="form-check-label" for="leftbar-color-light">{{__('dashboard.menu_color_light')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-menu-color" {{isset($settingTheme) && $settingTheme->data_menu_color=='dark'?'checked':''}} id="leftbar-color-dark" value="dark">
                                        <label class="form-check-label" for="leftbar-color-dark">{{__('dashboard.menu_color_dark')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-menu-color" {{isset($settingTheme) && $settingTheme->data_menu_color=='brand'?'checked':''}} id="leftbar-color-brand" value="brand">
                                        <label class="form-check-label" for="leftbar-color-brand">{{__('dashboard.menu_color_brand')}}</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-menu-color" {{isset($settingTheme) && $settingTheme->data_menu_color=='gradient'?'checked':''}} id="leftbar-color-gradient" value="gradient">
                                        <label class="form-check-label" for="leftbar-color-gradient">{{__('dashboard.menu_color_gradient')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div id="menu-icon-color">
                                <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">Cor do ícone do menu</h5>

                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-two-column-color" {{isset($settingTheme) && $settingTheme->data_two_column_color=='light'?'checked':''}} id="twocolumn-menu-color-light" value="light">
                                        <label class="form-check-label" for="twocolumn-menu-color-light">Claro</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-two-column-color" {{isset($settingTheme) && $settingTheme->data_two_column_color=='dark'?'checked':''}} id="twocolumn-menu-color-dark" value="dark">
                                        <label class="form-check-label" for="twocolumn-menu-color-dark">Escuro</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-two-column-color" {{isset($settingTheme) && $settingTheme->data_two_column_color=='brand'?'checked':''}} id="twocolumn-menu-color-brand" value="brand">
                                        <label class="form-check-label" for="twocolumn-menu-color-brand">Brand</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-two-column-color" {{isset($settingTheme) && $settingTheme->data_two_column_color=='gradient'?'checked':''}} id="twocolumn-menu-color-gradient" value="gradient">
                                        <label class="form-check-label" for="twocolumn-menu-color-gradient">Gradiente</label>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">{{__('dashboard.menu_icon_tone')}}</h5>

                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-menu-icon" {{isset($settingTheme) && $settingTheme->data_menu_icon=='default'?'checked':''}} id="menu-icon-default" value="default">
                                        <label class="form-check-label" for="menu-icon-default">{{__('dashboard.menu_icon_default')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-menu-icon" {{isset($settingTheme) && $settingTheme->data_menu_icon=='twotones'?'checked':''}} id="menu-icon-twotone" value="twotones">
                                        <label class="form-check-label" for="menu-icon-twotone">{{__('dashboard.menu_icon_twotone')}}</label>
                                    </div>
                                </div>
                            </div>

                            <div id="sidebar-size">
                                <h5 class="fw-medium font-14 mt-4 mb-2 pb-1">{{__('dashboard.sidebar_size')}}</h5>

                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-sidenav-size" {{isset($settingTheme) && $settingTheme->data_sidenav_size=='default'?'checked':''}} id="leftbar-size-default" value="default">
                                        <label class="form-check-label" for="leftbar-size-default">{{__('dashboard.sidebar_size_default')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-sidenav-size" {{isset($settingTheme) && $settingTheme->data_sidenav_size=='compact'?'checked':''}} id="leftbar-size-compact" value="compact">
                                        <label class="form-check-label" for="leftbar-size-compact">{{__('dashboard.sidebar_size_compact')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-sidenav-size" {{isset($settingTheme) && $settingTheme->data_sidenav_size=='condensed'?'checked':''}} id="leftbar-size-small" value="condensed">
                                        <label class="form-check-label" for="leftbar-size-small">{{__('dashboard.sidebar_size_condensed')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-sidenav-size" {{isset($settingTheme) && $settingTheme->data_sidenav_size=='full'?'checked':''}} id="leftbar-size-full" value="full">
                                        <label class="form-check-label" for="leftbar-size-full">{{__('dashboard.sidebar_size_full_layout')}}</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="radio" name="data-sidenav-size" {{isset($settingTheme) && $settingTheme->data_sidenav_size=='fullscreen'?'checked':''}} id="leftbar-size-fullscreen" value="fullscreen">
                                        <label class="form-check-label" for="leftbar-size-fullscreen">{{__('dashboard.sidebar_size_full_screen')}}</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vendor js -->
        <script src="{{ asset('build/admin/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('build/admin/js/app.min.js') }}"></script>

        <script>
            // Passa a tradução para uma variável JavaScript
            const responseDeleted = @json(__('dashboard.deleted'));
            const responseAreYouSure = @json(__('dashboard.are_you_sure'));
            const responseTextSweetAlert = @json(__('dashboard.text_sweet_alert'));
            const responseConfirmAction = @json(__('dashboard.confirm_action'));
            const responseCancelAction = @json(__('dashboard.cancel_action'));
            const responseSuccessName = @json(__('dashboard.success_name'));
            const responseItemErrorName = @json(__('dashboard.error_name'));
            const responseItemThemeSuccess = @json(__('dashboard.theme_success'));
            const responseItemThemeError = @json(__('dashboard.theme_erro'));
            const responseItemCreate = @json(__('dashboard.response_item_create'));
            const responseItemUpdate = @json(__('dashboard.response_item_update'));
            const responseItemDelete = @json(__('dashboard.response_item_delete'));
            const responseItemOrderSuccess = @json(__('dashboard.response_order_item'));
            const responseItemOrderError = @json(__('dashboard.response_item_error'));
        </script>

        <!-- Plugins js-->
        <script src="{{ asset('build/admin/js/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
        <script src="{{ asset('build/admin/js/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ asset('build/admin/js/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('build/admin/js/libs/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('build/admin/js/libs/jquery.sortable.min.js') }}"></script>
        <script src="{{ asset('build/admin/js/libs/dropzone/min/dropzone.min.js') }}"></script>
        <script src="{{ asset('build/admin/js/libs/dropify/js/dropify.min.js') }}"></script>
        <script src="{{ asset('build/admin/js/pages/form-fileuploads.init.js') }}"></script>
        <script src="{{ asset('build/admin/js/main.js') }}"></script>

        <!-- Dashboard 2 init -->
        <script src="{{ asset('build/admin/js/pages/dashboard-2.init.js') }}"></script>       

        {{-- Modais alert --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let successMessage = '{{ session('success') }}';
                if (successMessage) {
                    setTimeout(function() {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: responseSuccessName,
                                text: successMessage,
                                icon: 'success',
                                confirmButtonText: 'OK',
                                timer: 1800, // O alerta desaparecerá automaticamente após 1,5 segundos
                                showConfirmButton: false // Oculta o botão para fechar automaticamente
                            });
                        }
                    }, 1300); // Exibe o alert 1,3 segundos após a página carregar
                }
            });
        </script>
        

        @if(Session::has('error'))
            <div id="errorMessage" class="alert alert-warning notification-message" >
                <span class="mdi mdi-alert-circle"></span>
                {{ Session::get('error') }}
            </div>
        @endif

        @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let errors = '';
                    @foreach ($errors->all() as $error)
                        errors += '{{ $error }}\n'; 
                    @endforeach
            
                    setTimeout(function() {
                        Swal.fire({
                            title: responseItemErrorName,
                            text: errors,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }, 1300);
                });
            </script>        
        @endif

        <script>
            var userThemeSettings = {
                data_bs_theme: "{{ isset($settingTheme)?$settingTheme->data_bs_theme: 'dark' }}",
                data_layout_width: "{{ isset($settingTheme)?$settingTheme->data_layout_width: 'default' }}",
                data_layout_mode: "{{ isset($settingTheme)?$settingTheme->data_layout_mode: 'detached' }}",
                data_topbar_color: "{{ isset($settingTheme)?$settingTheme->data_topbar_color: 'light' }}",
                data_menu_color: "{{ isset($settingTheme)?$settingTheme->data_menu_color: 'light' }}",
                data_two_column_color: "{{ isset($settingTheme)?$settingTheme->data_two_column_color: 'light' }}",
                data_menu_icon: "{{ isset($settingTheme)?$settingTheme->data_menu_icon: 'default' }}",
                data_sidenav_size: "{{ isset($settingTheme)?$settingTheme->data_sidenav_size: 'condensed' }}"
            };
        </script>
    </body>
</html>