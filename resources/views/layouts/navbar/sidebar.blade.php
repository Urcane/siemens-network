<div id="kt_app_sidebar" class="app-sidebar flex-column active" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle"
	style="
		background-color: #020e3a;
		background-image: url('{{ asset('siemens/media/auth/bg-11.png') }}');
		background-repeat: no-repeat;
		background-position: bottom center;
		background-size: cover;
	">
	<div class="app-sidebar-logo border-0" id="kt_app_sidebar_logo">
		<a href="#!" class="d-flex flex-column align-items-center justify-content-center w-100 py-4">
			<img
				alt="Logo"
				src="{{ asset('siemens/media/logos/default-dark.png') }}"
				class="app-sidebar-logo-default mb-2"
				style="height: 20px;"
			>
			<span
				class="app-sidebar-logo-minimize fw-bold"
				style="font-size: 1.5rem; color: #009999;"
			>
				S
			</span>
		</a>
		<div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
			<span class="svg-icon svg-icon-2 rotate-180">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
					<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
				</svg>
			</span>
		</div>
	</div>
	<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
		<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
				<div class="menu-item">
					<div class="menu-content">
						<span class="fw-bold text-uppercase fs-7 text-white">Menu</span>
					</div>
				</div>
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
					<span class="menu-link">
						<span class="menu-icon">
							<i class="fa-solid fa-share-nodes"></i>
						</span>
						<span class="menu-title">Modbus Test</span>
						<span class="menu-arrow"></span>
					</span>
					<div class="menu-sub menu-sub-accordion">
						<div class="menu-item">
							<a class="menu-link" href="{{route('dashboard')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Modbus Read</span>
							</a>
						</div>
						<div class="menu-item">
							<a class="menu-link" href="{{route('dashboard-write')}}">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Modbus Write</span>
							</a>
						</div>
					</div>
				</div>

				<div class="menu-item">
					<a class="menu-link" href="{{route('ping.index')}}">
						<span class="menu-icon">
							<i class="fa-solid fa-globe"></i>
						</span>
						<span class="menu-title">Ping Test</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{route('nmap.index')}}">
						<span class="menu-icon">
							<i class="fa-solid fa-ethernet"></i>
						</span>
						<span class="menu-title">Nmap Test</span>
					</a>
				</div>
				<div class="menu-item">
					<a class="menu-link" href="{{route('flood.index')}}">
						<span class="menu-icon">
							<i class="fa-solid fa-network-wired"></i>
						</span>
						<span class="menu-title">Flood Test</span>
					</a>
				</div>
				@role('administrator')
				<div class="menu-item">
					<a class="menu-link" href="{{route('user.management.index')}}">
						<span class="menu-icon">
							<i class="fa-solid fa-users"></i>
						</span>
						<span class="menu-title">User</span>
					</a>
				</div>
				@endrole
			</div>
			
		</div>
		<div id="kt_app_sidebar_footer" class="mt-auto px-6 pb-6 app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
			<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_footer" data-kt-menu="true" data-kt-menu-expand="false">
				<a
					href="{{ route('logout') }}"
					class="menu-link d-flex align-items-center"
					onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
				>
					<span class="menu-icon">
						<i class="fa-solid fa-arrow-left text-white"></i>
					</span>
					<span class="menu-title text-white px-2">Log Out</span>
				</a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
					@csrf
				</form>
			</div>
		</div>
	</div>
</div>