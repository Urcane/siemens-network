@extends('layouts.app')
@section('content')
<style>
    body {
            font-family: 'Poppins', sans-serif !important;
        }
</style>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-fluid h-100">
        <div class="row h-100">
            <div class="col-xl-12 align-self-center" id="contentGetStarted" >
                <div class="row justify-content-center align-items-center mb-6">
                    <div class="col-xl-4 col-10">
                        <div class="text-center">
                            <img src="{{asset('siemens')}}/media/auth/error page.png" class="mw-100 mh-350px theme-light-show" alt="">
                            <img src="{{asset('siemens')}}/media/auth/error page.png" class="mw-100 mh-350px theme-dark-show" alt="">
                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-11 text-center">
                                <div class="mb-0">
                                    <span class="fs-4x fw-bolder text-dark">@yield('code')</span>
                                </div>
                                <div class="mb-0">
                                    <span class="fs-6 fw-semibold text-muted">@yield('message')</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @include('layouts.footer.footer') --}}
            </div>
        </div>
    </div>
</div>
@endsection