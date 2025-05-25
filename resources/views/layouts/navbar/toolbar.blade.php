<div id="kt_app_toolbar" class="app-toolbar bg-white py-xl-12 py-4 border-0">
	<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
		<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
			<h1 class="page-heading d-flex text-dark fw-bolder fs-3 flex-column justify-content-center my-0" id="page_name">{{$homepage}}</h1>
			<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1" id="bc_active">
				<li class="breadcrumb-item text-muted">
					<a href="{{route('dashboard')}}" class="text-muted text-hover-primary"><i class="fa-solid fa-home"></i></a>
				</li>
				<li class="breadcrumb-item">
					<span class="bullet bg-muted w-5px h-1px"></span>
				</li>
				<li class="breadcrumb-item text-muted">
					<a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Map View</a>
				</li>
			</ul>
		</div>
		<div class="d-flex align-items-center gap-2" id="contentSite">
			
		</div>
	</div>
</div>
 