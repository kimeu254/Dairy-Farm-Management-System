<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>DFMS - Dairy Farm Management System</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('assets/img/icon.ico')}}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/atlantis.min.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="{{route('dashboard')}}" class="logo">
					<div class="navbar-brand text-white fw-bold h1">DFMS</div>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->
			@php
				$cattle = \App\Models\Cattle::where('status','Active')->count();
            	$calves = \App\Models\Calf::where('status','Active')->count();
            	$cow_total = $calves+$cattle;
				$stall_total = \App\Models\Stall::where('status','Active')->count();
				$breed_total = \App\Models\Breed::where('status','Active')->count();
			@endphp
			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						@role('owner|manager')
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fas fa-layer-group"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Quick Actions</span>
									<span class="subtitle op-8">Shortcuts</span>
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<a class="col-6 col-md-4 p-0" href="{{route('sale.milk.new')}}">
												<div class="quick-actions-item">
													<i class="mdi mdi-cash-100"></i>
													<span class="text">Create New Milk-Sale</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="{{route('inventory.new')}}">
												<div class="quick-actions-item">
													<i class="flaticon-pen"></i>
													<span class="text">Create New Inventory</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="{{route('medication.new')}}">
												<div class="quick-actions-item">
													<i class="mdi mdi-pill"></i>
													<span class="text">Create New Medication</span>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</li>
						@endrole
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{('assets/img/1.png')}}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{('assets/img/1.png')}}" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{Auth::user()->fname}} {{Auth::user()->lname}}</h4>
												<p class="text-muted">{{Auth::user()->email}}</p><a href="{{route('user-profile')}}" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="{{route('user-profile')}}">My Profile</a>
										<div class="dropdown-divider"></div>
										@role('owner|manager')
										<a class="dropdown-item" href="{{route('all.users')}}">Settings</a>
										<div class="dropdown-divider"></div>
										@endrole
										<a class="dropdown-item" href="{{ route('signout') }}">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{('assets/img/1.png')}}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{Auth::user()->fname}} {{Auth::user()->lname}}
									<span class="user-level">{{Auth::user()->roles->first()->display_name}}</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="{{route('user-profile')}}">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a href="{{route('dashboard')}}" class="" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						@role('owner|manager')
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Cattle</h4>
						</li>
						<li class="nav-item">
							<a href="{{route('stalls')}}" class="">
								<i class="fas fa-layer-group"></i>
								<p>Stalls</p>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('breeds')}}" class="">
								<i class="mdi mdi-shape-outline"></i>
								<p>Breeds</p>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('cattle')}}" class="">
								<i class="mdi mdi-cow"></i>
								<p>Cattle</p>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('calf')}}" class="">
								<i class="mdi mdi-piggy-bank"></i>
								<p>Calf</p>
							</a>
						</li>
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Milk</h4>
						</li>
						<li class="nav-item">
							<a class="" href="{{route('milks')}}">
								<i class="mdi mdi-flask-empty-outline"></i>
								<p>Milk Production</p>
							</a>
						</li>
                        <li class="nav-item">
							<a class="" href="{{route('milk-sales')}}">
								<i class="mdi mdi-cash-multiple"></i>
								<p>Milk Sales</p>
							</a>
						</li>
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Health & Routine</h4>
						</li>
                        <li class="nav-item">
							<a href="{{route('routines')}}">
								<i class="mdi mdi-routes-clock"></i>
								<p>Cow Routine</p>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('health-status')}}">
								<i class="mdi mdi-bottle-tonic-plus-outline"></i>
								<p>Health Status</p>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('medications')}}">
								<i class="mdi mdi-needle"></i>
								<p>Medication & Vaccine</p>
							</a>
						</li>
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Inventory Management</h4>
						</li>
						<li class="nav-item">
							<a href="{{route('inventories')}}">
								<i class="mdi mdi-clipboard-list-outline"></i>
								<p>Inventories</p>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('stocks')}}">
								<i class="mdi mdi-format-line-style"></i>
								<p>Stocks</p>
							</a>
						</li>
                        <li class="nav-item">
							<a href="{{route('usages')}}">
								<i class="mdi mdi-chart-donut"></i>
								<p>Usage</p>
							</a>
						</li>
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">HR</h4>
						</li>
						<li class="nav-item">
							<a  class="" href="{{route('employees')}}">
								<i class="mdi mdi-account-group-outline"></i>
								<p>Employees</p>
							</a>
						</li>
						<li class="nav-item">
							<a class="" href="{{route('leaves')}}">
								<i class="mdi mdi-car"></i>
								<p>Leaves</p>
							</a>
						</li>
                        <li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Accounts</h4>
						</li>
						<li class="nav-item">
							<a href="{{route('ledgers')}}">
								<i class="fas fa-book"></i>
								<p>Ledger</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('tags')}}">
								<i class="mdi mdi-tag-multiple-outline"></i>
								<p>Tags</p>
							</a>
						</li>
						@endrole
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				@yield('content')
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="#">
									Support
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						&#169;2023 <i class="fa fa-heart heart text-danger"></i>
					</div>				
				</div>
			</footer>
		</div>
	</div>
	<!--   Core JS Files   -->
	<script src="{{asset('assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
	<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>

	<!-- jQuery UI -->
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="{{asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>


	<!-- Chart JS -->
	<script src="{{asset('assets/js/plugin/chart.js/chart.min.js')}}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

	<!-- Chart Circle -->
	<script src="{{asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

	<!-- Datatables -->
	<script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

	<!-- jQuery Vector Maps -->
	<script src="assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="{{asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

	<!-- Sweet Alert -->
	<script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

	<!-- Atlantis JS -->
	<script src="{{asset('assets/js/atlantis.min.js')}}"></script>

	<!-- Atlantis DEMO methods, don't include it in your project! -->
	<script src="{{asset('assets/js/setting-demo.js')}}"></script>
	<script src="{{asset('assets/js/demo.js')}}"></script>
	<script>
		let cow_total = JSON.parse('<?php echo json_encode($cow_total)?>')
		let stall_total = JSON.parse('<?php echo json_encode($stall_total)?>')
		let breed_total = JSON.parse('<?php echo json_encode($breed_total)?>')
		Circles.create({
			id:'circles-1',
			radius:45,
			value: 100,
			maxValue:100,
			width:7,
			text: cow_total,
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value:100,
			maxValue:100,
			width:7,
			text: stall_total,
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:100,
			maxValue:100,
			width:7,
			text: breed_total,
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets : [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>
</body>
</html>