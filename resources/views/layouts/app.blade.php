<!DOCTYPE html>
<html lang="en">
<head><base href="">
    <title>@yield('title')Project - Demo</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content=""/>
    <meta name="keywords" content="siemens" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Project - Demo" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{asset('siemens')}}/media/logos/asdf.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{asset('siemens')}}/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('siemens')}}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('siemens')}}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('siemens')}}/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="{{asset('siemens')}}/css/leaflet.css" crossorigin="" />
    <script src="{{asset('siemens')}}/js/leaflet.js"  crossorigin=""></script>
</head>
    <body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" @yield('body') class="app-default bg-white">
        
        @auth
        <style>
            .customPopup .leaflet-popup-content-wrapper .leaflet-popup-content {
                text-align: left;
                width: 200px;
            }
            .skeleton {
                animation: skeleton-loading 1s linear infinite alternate;
                /* border-radius: 0.125rem; */
            }
            @keyframes skeleton-loading {
                0% {
                    background-color: hsl(200, 20%, 80%);
                }
                100% {
                    background-color: hsl(200, 20%, 95%);
                }
            }

            #resultBox {
                max-height: 400px;
                overflow-y: auto;
                font-family: monospace;
                border-radius: 0.5rem;
                white-space: pre-wrap;
            }
        </style>

        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
                @yield('navbar')
                <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                    @yield('sidebar')
                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                        <div class="d-flex flex-column flex-column-fluid">
                            @yield('toolbar')
                            <div id="kt_app_content" class="app-content flex-column-fluid">
                                <div id="kt_app_content_container" class="app-container container-fluid h-100">
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                        <div id="kt_app_footer" class="app-footer">
                            <div class="app-container container-fluid flex-center d-flex bg-white py-3">
                                @include('layouts.footer.footer')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @else
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            @yield('content')
        </div>
        @endauth
        
        @stack('js')
        <script class="text/javascript">
            $(document).ready(function(){
                function showTime() {
                    var date = new Date();
                    $('#time').html(date.toLocaleTimeString());
                    $('#downToday').html(date.toLocaleDateString());
                }
                $('.data-template').show();
                $('.skeleton-template').remove();
                setInterval(showTime, 1000); 
            })
        </script> 
        
        <script>var hostUrl = "{{asset('siemens')}}/";</script>
        <script src="{{asset('siemens')}}/plugins/global/plugins.bundle.js"></script>
        <script src="{{asset('siemens')}}/js/scripts.bundle.js"></script>
        <script src="{{asset('siemens')}}/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
        <script src="{{asset('siemens')}}/plugins/custom/datatables/datatables.bundle.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        
    </body>
    </html>