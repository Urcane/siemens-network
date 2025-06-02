@php
$firstLetter =  mb_substr(auth()->user()->name, 0, 1);
$today = Carbon\Carbon::now();
@endphp
<div id="kt_app_header" class="app-header">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">

        <div class="d-flex align-items-center d-lg-none ms-n3 me-3" title="Show header menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_sidebar_mobile_toggle">
                <span class="svg-icon svg-icon-2 svg-icon-md-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                    </svg>
                </span>
            </div>
        </div>

        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
            {{-- <a href="{{route('dashboard')}}">
                <img alt="Logo" src="{{asset('siemens')}}/media/logos/default-dark.png" class="h-20px h-lg-30px app-sidebar-logo-default theme-light-show">
                <img alt="Logo" src="{{asset('siemens')}}/media/logos/default-dark.png" class="h-20px h-lg-30px app-sidebar-logo-default theme-dark-show">
            </a> --}}
            <div class="page-title d-flex flex-column justify-content-center flex-wrap">
                <h1 class="page-heading d-flex text-dark fw-bolder fs-3 flex-column justify-content-center my-0" id="page_name">{{$homepage}}</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0" id="bc_active">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('dashboard')}}" class="text-muted text-hover-primary"><i class="fa-solid fa-home"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}" style="">
                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch  fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                    {{-- @role('administrator')
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class="menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                        <span class="menu-link">
                            <span class="menu-title text-dark fw-bold text-hover-primary">Master Data</span>
                            <span class="menu-arrow d-xl-none"></span>
                        </span>
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('site.index')}}">
                                    <span class="menu-icon"><i class="fa-solid fa-location-dot"></i></span>
                                    <span class="menu-title">Lokasi Site</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{route('user.management.index')}}">
                                    <span class="menu-icon"><i class="fa-solid fa-users"></i></span>
                                    <span class="menu-title">User</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="menu-item">
                        <a class="menu-link" href="{{route('site.index')}}">
                            <span class="menu-title text-dark fw-bold text-hover-primary">Lokasi Site</span>
                        </a>
                    </div>
                    @endrole --}}
                </div>
            </div>
            <div class="app-navbar flex-shrink-0">
                <div class="app-navbar-item ms-3">
                    <div class="d-flex align-items-center gap-2" id="contentSite">
			
                    </div>
                </div>
                <div class="d-flex align-items-center ms-4">
                    <div class="align-items-center py-2 px-0" >
                        <button
                            id="stopAllBtn"
                            class="btn btn-sm btn-danger mx-5"
                            style="width: 100px;"
                            title="Stop"
                        >
                            <span><i class="fa-solid fa-stop"></i> Stop All</span>
                        </button>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-4" id="kt_header_user_menu_toggle">
                    <div
                        class="btn btn-flex align-items-center py-2 px-0"
                        data-kt-menu-trigger="click"
                        data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end"
                        >
                        <div class="symbol symbol-30px symbol-md-40px">
                            <!--
                                1) Removed fs-1
                                2) Added d-flex align-items-center justify-content-center
                                3) Kept text-white on both <div> and <i>
                                -->
                                <div
                                    class="symbol-label d-flex align-items-center justify-content-center text-white"
                                    style="background-color: darkorange;"
                                >
                                &nbsp;<i class="fa-solid fa-bell text-white fs-4"></i>
                            </div>
                        </div>
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <div class="scroll-y mh-500px px-3">
                            <div class="px-3 py-3">
                                <h4 class="text-dark m-0">Notifications</h4>
                            </div>

                            <a href="#" class="d-flex align-items-center px-3 py-3 rounded bg-hover-light process-item" id="modbus-item">
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label bg-secondary text-white" id="modbus-icon-wrapper">
                                        <i class="fa-solid fa-network-wired" id="modbus-static-icon"></i>
                                        <i class="fa-solid fa-spinner fa-spin text-white d-none" id="modbus-spinner-icon"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 text-gray-800">Modbus Read Process</span>
                                    <span class="fs-7 text-muted" id="modbus-process-status">Available</span>
                                </div>
                            </a>

                            <a href="#" class="d-flex align-items-center px-3 py-3 rounded bg-hover-light process-item" id="ping-item">
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label bg-primary text-white" id="ping-icon-wrapper">
                                        <!-- static icon (always white) -->
                                        <i class="fa-solid fa-circle-exclamation text-white" id="ping-static-icon"></i>
                                        <!-- spinner icon (always white, but hidden by default) -->
                                        <i class="fa-solid fa-spinner fa-spin text-white d-none" id="ping-spinner-icon"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 text-gray-800">Ping Process</span>
                                    <span class="fs-7 text-muted" id="ping-process-status">Available</span>
                                </div>
                            </a>
                            
                            <!-- Nmap Process -->
                            <a href="#" class="d-flex align-items-center px-3 py-3 rounded bg-hover-light process-item" id="nmap-item">
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label bg-success text-white" id="nmap-icon-wrapper">
                                        <i class="fa-solid fa-ethernet text-white" id="nmap-static-icon"></i>
                                        <i class="fa-solid fa-spinner fa-spin text-white d-none" id="nmap-spinner-icon"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 text-gray-800">Nmap Process</span>
                                    <span class="fs-7 text-muted" id="nmap-process-status">Available</span>
                                </div>
                            </a>
                            
                            <!-- Flood Process -->
                            <a href="#" class="d-flex align-items-center px-3 py-3 rounded bg-hover-light process-item" id="flood-item">
                                <div class="symbol symbol-40px me-4">
                                    <div class="symbol-label bg-warning text-white" id="flood-icon-wrapper">
                                        <i class="fa-solid fa-house-flood-water-circle-arrow-right text-white" id="flood-static-icon"></i>
                                        <i class="fa-solid fa-spinner fa-spin text-white d-none" id="flood-spinner-icon"></i>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fs-6 text-gray-800">Flood Process</span>
                                    <span class="fs-7 text-muted" id="flood-process-status">Available</span>
                                </div>
                            </a>
                            
                            <!-- Add more items here -->
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-4" id="kt_header_user_menu_toggle">
                    
                    <div class="btn btn-flex align-items-center py-2 px-0" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        {{-- <div class="d-none d-md-flex flex-column align-items-end justify-content-center me-2 me-md-4">
                            <span class="text-dark fw-bolder fs-7 lh-1 mb-1 data-template" style="display:none">{{Carbon\Carbon::parse($today)->dayName}}</span>
                            <span id="time" class="text-dark fw-semibold fs-7 lh-1 data-template" style="display:none"></span>
                            <div class="skeleton h-10px w-70px skeleton-template mb-2"></div>
                            <div class="skeleton h-10px w-150px skeleton-template"></div>
                        </div> --}}
                        <div class="symbol symbol-30px symbol-md-40px">
                            <div class="symbol-label fs-1 bg-light-primary text-primary">{{$firstLetter}}</div>
                        </div>
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <div class="symbol-label fs-1 bg-light-primary text-primary">{{$firstLetter}}</div>
                                </div>
                                <div class="d-flex flex-column" style="overflow-wrap:break-word;inline-size:170px">
                                    <span class="fw-bold align-items-center fs-6">{{substr(auth()->user()->name,0,10)}} ...</span>
                                    <span class="fw-semibold text-muted fs-8">{{substr(auth()->user()->email,0,15)}} ...</span>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link px-5">
                                <span class="menu-title position-relative text-danger">Logout
                                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">
                                        <i class="fas fa-arrow-right text-danger"></i>
                                    </span>
                                </span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="/js/app.js"></script>
<script>
    const processes = [
        { name: 'ping', bgIdle: 'bg-primary' },
        { name: 'nmap', bgIdle: 'bg-success' },
        { name: 'flood', bgIdle: 'bg-warning' },
        { name: 'modbus', bgIdle: 'bg-secondary' },
    ];
        
    processes.forEach(proc => {
        const channelName       = `${proc.name}-process-status`;
        const statusSelector    = `#${proc.name}-process-status`;
        const wrapperSelector   = `#${proc.name}-icon-wrapper`;
        const staticIconSel     = `#${proc.name}-static-icon`;
        const spinnerIconSel    = `#${proc.name}-spinner-icon`;
        
        window.Echo
        .channel(channelName)
        .listen('.output', e => {
            // console.log(e.payload);
            
            const $statusText   = $(statusSelector);
            const $iconWrapper  = $(wrapperSelector);
            const $staticIcon   = $(staticIconSel);
            const $spinnerIcon  = $(spinnerIconSel);
            
            let isRunning = false;
            let extraInfo = '';
            
            // If payload is a string "running"
            if (typeof e.payload === 'string' && e.payload === 'running') {
                isRunning = true;
            }
            // If payload is an object { status: "running", info: "..."}
            else if (typeof e.payload === 'object' && e.payload !== null) {
                if (e.payload.status === 'running') {
                    isRunning = true;
                    extraInfo = e.payload.info || '';
                }
            }
            
            if (isRunning) {
                // 1) Show spinner, hide static icon
                $staticIcon.addClass('d-none');
                $spinnerIcon.removeClass('d-none');
                
                // 2) Change circle background to red (bg-danger)
                $iconWrapper
                .removeClass(proc.bgIdle + ' bg-danger')
                .addClass('bg-danger');
                
                // 3) Status text becomes dark, append extra info if any
                let displayText = 'Running...';
                if (extraInfo.length) {
                    displayText += ` ${extraInfo}`;
                }
                $statusText
                .text(displayText)
                .removeClass('text-muted text-white')
                .addClass('text-gray-800');

                $(`#btnSubmit-${proc.name}`).attr('disabled', 'disabled');
            }
            else {
                // 1) Hide spinner, show static icon
                $spinnerIcon.addClass('d-none');
                $staticIcon.removeClass('d-none');
                
                // 2) Restore original background (e.g. bg-primary)
                $iconWrapper
                .removeClass('bg-danger')
                .addClass(proc.bgIdle);
                
                // 3) Reset status text to "Available" (muted gray)
                $statusText
                .text('Available')
                .removeClass('text-gray-800 text-white')
                .addClass('text-muted');

                $(`#btnSubmit-${proc.name}`).removeAttr('disabled');
            }
        });
    });
</script>

