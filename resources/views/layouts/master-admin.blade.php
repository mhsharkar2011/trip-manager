<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('customAdmin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Page level plugin CSS-->
    <link href="{{ asset('customAdmin/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    <!-- Custom styles for this template-->
    {{-- <link href="{{ asset('customAdmin/css/sb-admin.css') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('customAdmin/css/custom.css') }}"> --}}
 
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/dataTables.bootstrap4.min.css') }}">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
	<!-- Chart CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/plugins/morris/morris.css') }}">
	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">

	{{-- message toastr --}}
	<link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
	<script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>

    @yield('singlePageStyle')

</head>

<body class="bg-dark">
    <style>    
		.invalid-feedback{
			font-size: 14px;
		}
	</style>
	<!-- Main Wrapper -->
	<div class="main-wrapper">
		<!-- Header -->
		<div class="header">
			<!-- Logo -->
			<div class="header-left mt-2 text-center text-white">
				<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
					<span class="user-img">
						@if ($auth->profile_photo_path)
						<img height="48" src="{{ URL::to('/assets/images/'. $auth->profile_photo_path) }}" alt="Avatar">
						@else
						<img height="38" src="{{ asset('/img/avatar.png') }}" alt="Avatar">
						@endif
					<span class="status online"></span></span>
				</a>

			</div>
			<!-- /Logo -->
			<a id="toggle_btn" href="javascript:void(0);">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</a>
			<!-- Header Title -->
			<div class="page-title-box">
				<h3>Hi, {{ $auth->full_name }}</h3>
			</div>
			<!-- /Header Title -->
			<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
			<!-- Header Menu -->
			<ul class="nav user-menu">
				<!-- Search -->
				<li class="nav-item">
					<div class="top-nav-search">
						<a href="javascript:void(0);" class="responsive-search"> <i class="fa fa-search"></i> </a>
						<form action="#">
							<input class="form-control" type="text" placeholder="Search here">
							<button class="btn" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</form>
					</div>
				</li>
				<!-- /Search -->

				<!-- Flag -->
				<li class="nav-item dropdown has-arrow flag-nav">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
						<img src="{{ URL::to('assets/img/flags/us.png') }}" alt="" height="20"> <span>English</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="javascript:void(0);" class="dropdown-item">
						<img src="{{ URL::to('assets/img/flags/us.png') }}" alt="" height="16"> English </a>
						<a href="javascript:void(0);" class="dropdown-item">
						<img src="{{ URL::to('assets/img/flags/bd.png') }}" alt="" height="16"> Bangla </a>
					</div>
				</li>
				<!-- /Flag -->

				<!-- Notifications -->
				<li class="nav-item dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<i class="fa fa-bell-o"></i>
						<span class="badge badge-pill">{{ $notification ?? '0' }}</span> 
					</a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header">
							<span class="notification-title">Notifications</span> 
							<a href="javascript:void(0)" class="clear-noti"> Clear All </a> 
						</div>
						<div class="noti-content">
							<ul class="notification-list">
							@foreach ($trips as $key => $trip)
								<li class="notification-message">
									<a href="activities.html" class="text-decoration-none">
										<div class="media">
											<span class="avatar">
												{{-- <img alt="" src="{{ URL::to('/assets/images/') }}"> --}}
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">{{ $trip->customer->full_name }}</span> added booking <span class="noti-title">time:{{ $bookingTime[$key] }}</span></p>												
													@if($trip->status != 'Completed')
													<div class="text-warning">
														{{ $trip->status }}
													</div>
													@elseif ($trip->status = 'Completed')
													<div class="text-success">
														{{ $trip->status }}
													</div>
													@else
													<div class="text-danger">
														No Data Found
													</div>
													
													@endif
												</span>
												
											</div>
										</div>
									</a>
								</li>
							@endforeach
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="activities.html">View all Notifications</a> </div>
					</div>
				</li>
				<!-- /Notifications -->
				
				<!-- Message Notifications -->
				<li class="nav-item dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<i class="fa fa-comment-o"></i> <span class="badge badge-pill">0</span>
					</a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header">
							<span class="notification-title">Messages</span> 
							<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
						 </div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="#">
										<div class="list-item">
											<div class="list-left">
												<span class="avatar">
													<img alt="" src="#">
												</span>
											</div>
											<div class="list-body">
												<span class="message-author">{{ $auth->full_name }}</span> 
												<span class="message-time">12:28 AM</span>
												<div class="clearfix"></div>
												<span class="message-content">No Data Found</span> 
											</div>
										</div>
									</a>
								</li>
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="chat.html">View all Messages</a> </div>
					</div>
				</li>
				<!-- /Message Notifications -->
				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img">
							@if ($auth->profile_photo_path)
							<img src="{{ URL::to('/assets/images/'. $auth->profile_photo_path) }}" alt="Avatar">
							@else
							<img src="{{ asset('/img/avatar.png') }}" alt="Avatar">
							@endif
						<span class="status online"></span></span>
						<span>{{ $auth->full_name }}</span>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#">My Profile</a>
						<a class="dropdown-item" href="#">Settings</a>
						<a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
					</div>
				</li>
			</ul>
			<!-- /Header Menu -->

			<!-- Mobile Menu -->
			<div class="dropdown mobile-user-menu">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-ellipsis-v"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="#">My Profile</a>
					<a class="dropdown-item" href="#">Settings</a>
					<a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
				</div>
			</div>
			<!-- /Mobile Menu -->

		</div>
		<!-- /Header -->
		<!-- Sidebar -->
		@include('admin.inc.menu')
		<!-- /Sidebar -->
		<!-- Page Wrapper -->
		@yield('content')
		<!-- /Page Wrapper -->
		<!-- Toastr -->
		{!! Toastr::message() !!}
		<!-- /Toastr -->

	</div>

    <!-- /Main Wrapper -->
	<!-- jQuery -->
	<script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
	<!-- Bootstrap Core JS -->
	<script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
	<!-- Chart JS -->
	{{-- <script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script> --}}
	{{-- <script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script> --}}
	{{-- <script src="{{ URL::to('assets/js/chart.js') }}"></script> --}}
	<script src="{{ URL::to('assets/js/Chart.min.js') }}"></script>
	{{-- <script src="{{ URL::to('assets/js/line-chart.js') }}"></script>	 --}}
	<!-- Slimscroll JS -->
	<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
	<!-- Select2 JS -->
	<script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
	<!-- Datetimepicker JS -->
	<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
	<!-- Datatable JS -->
	<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/dataTables.bootstrap4.min.js') }}"></script>
	<!-- Multiselect JS -->
	<script src="{{ URL::to('assets/js/multiselect.min.js') }}"></script>		
	<!-- Custom JS -->
	<script src="{{ URL::to('assets/js/app.js') }}"></script>
	@yield('script')

    @yield('singlePageScript')

	

</body>

</html>
