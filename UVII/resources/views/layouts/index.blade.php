<!DOCTYPE html>
<!-- 
Template Name: Conquer - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>@yield('title')</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<meta name="MobileOptimized" content="320">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/select2/select2.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css') }}"/>
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="{{asset('assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="{{ asset('assets/css/style-conquer.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/style-responsive.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/pages/tasks.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/css/themes/default.css') }}" rel="stylesheet" type="text/css" id="style_color"/>
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>

<!-- css datatable versi 2 -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">


<!-- Google Analytics: Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9CBNPMEX4N"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-9CBNPMEX4N');
</script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
<!-- BEGIN HEADER -->

<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
            <img src="{{ asset('assets/image/disnaker.jpeg') }}" alt="logo" width="250px"/>
        </div>
		<form class="search-form search-form-header" role="form" action="{{route('search.button')}}">
            <div class="input-icon right">
                <i class="icon-magnifier"></i>
                <input type="text" class="form-control input-sm" name="keyword" placeholder="Search Menu...">
            </div>
        </form>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<i class="fa fa-bars"></i>
		<!-- <img src="{{ asset('assets/img/menu-toggler.png') }}" alt=""/> -->
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN TOP NAVIGATION MENU -->
		<ul class="nav navbar-nav pull-right">
			<!-- BEGIN USER LOGIN DROPDOWN -->
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<img alt="" src="{{ asset('assets/img/avatar.png') }}" width="32px"/>
				<span class="username username-hide-on-mobile">{{Auth::user()->username}} </span>
				<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					@if(Auth::user()->role->nama_role == 'peserta')
					<li>
						<a href="{{route('profile')}}" style='{{ Auth::user()->tanggal_lahir == null ? "pointer-events: none;" : "" }}'><i class="fa fa-user"></i> Profile</a>
					</li>
					@endif
					<div class="divider"></div>
					<li>
						<form action="{{ route('logout') }}" method="POST" class="d-none logout">
							@csrf
							<i class="fa fa-sign-out"></i>
							<input class="btn btn-sm btn-danger" type="submit" value="Logout">
						</form>
						
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>

<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->

<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
			<ul class="page-sidebar-menu">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<div class="clearfix">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<form class="search-form search-form-header" role="form" action="{{route('search.button')}}">
						<div class="input-icon right">
							<i class="icon-magnifier"></i>
							<input type="text" class="form-control input-sm" name="keyword" placeholder="Search Menu...">
						</div>
					</form>
				</li>
				@php
					$arr_icon=[
						'Dashboard'=>'fa fa-home',
						'Daftar Peserta'=>'icon-list',
						'Menu Manajemen'=>'fa fa-group',
						'Role'=>'fa fa-users',
						'Riwayat Tes Peserta'=>'fa fa-file-text',
						'Riwayat Ujian'=>'fa fa-list-alt',
						'Mulai Tes'=>'fa fa-play',
						'Bank Soal'=>'icon-book-open',
						'Klaster'=>'fa fa-plus',
						'Kategori'=> 'fa fa-plus-circle',
						'Bantuan'=>'icon-question'];
				@endphp
				@foreach($menu as $m)
				<li>
					<a href="{{route($m->url)}}" style='{{ (Auth::user()->tanggal_lahir == null && Auth::user()->role->nama_role != "adminuvii" && Auth::user()->role->nama_role != "adminblk") ? "pointer-events: none;" : "" }}'>
					
					<i class='@php echo ($arr_icon[$m->nama] ?? $arr_icon["Role"]) @endphp'></i>
					<span class="title">{{$m->nama}}</span>
					<span class="selected"></span>
					</a>
				</li>
				@endforeach
			{{--	<li>
					<a>
						<i class="icon-user"></i>
						<span class="title">Admin</span>
						<span class="arrow"></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="http://127.0.0.1:8000/menu/peserta" style='{{ Auth::user()->nomor_identitas == null ? "pointer-events: none;" : "" }}'>
							<i class="icon-list"></i>
							Daftar peserta</a>
						</li>
						<li>
							<a href="{{url('soal')}}" style='{{ Auth::user()->nomor_identitas == null ? "pointer-events: none;" : "" }}'>
								<i class="icon-book-open"></i>
								Bank Soal
							</a>
						</li>
						
							
						<!-- belum fix -->
						<li>
							<a href="#" style='{{ Auth::user()->nomor_identitas == null ? "pointer-events: none;" : "" }}'>
							<i class="icon-list"></i>
							Daftar Karyawan</a>
						</li>
						<li >
							<a href="http://127.0.0.1:8000/menu/role" style='{{ Auth::user()->nomor_identitas == null ? "pointer-events: none;" : "" }}'>
							<i class="fa fa-group"></i>
							<span class="title">Role</span>
							</a>
						</li>
						<li >
							<!-- <a href="http://127.0.0.1:8000/menu_manajemen/role" style='{{ Auth::user()->nomor_identitas == null ? "pointer-events: none;" : "" }}'> -->
							<a href="{{route('manajemen.index')}}" style='{{ Auth::user()->nomor_identitas == null ? "pointer-events: none;" : "" }}'>
							<i class="fa fa-group"></i>
							<span class="title">Menu Manajemen</span>
							</a>
						</li>
						<li>
							<a href="{{route('riwayat_tes_global.user')}}" style='{{ Auth::user()->nomor_identitas == null ? "pointer-events: none;" : "" }}'>
								<i class="fa fa-file-text"></i>
								<span class="title">Riwayat Tes Peserta</span>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="{{route('peserta.tes')}}" style='{{ Auth::user()->nomor_identitas == null ? "pointer-events: none;" : "" }}'>
							<i class="fa fa-play"></i>
							<span class="title">Mulai Tes</span>
					</a>
				</li>
				<li>
					<a href="{{route('riwayat_tes.user')}}" style='{{ Auth::user()->nomor_identitas == null ? "pointer-events: none;" : "" }}'>
							<i class="fa fa-file-text"></i>
							<span class="title">Riwayat Ujian</span>
					</a>
				</li>--}}
				
				
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			
			<div class="page-bar">
				@yield('page-bar')
			</div>
			
			@yield('contents')
			
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer">
	<div class="footer-inner">
		 2022 &copy; BLK UVII. Sahabat Mandira
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('assets/plugins/jquery-1.11.0.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-migrate-1.2.1.min.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="{{ asset('assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery.peity.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery.pulsate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-knob/js/jquery.knob.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
<script src="{{ asset('assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>


<script type="text/javascript" src="{{ asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/scripts/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/scripts/index.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/scripts/tasks.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/scripts/table-advanced.js') }}"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- uji coba script datatable versi 2 -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css"> -->
<script>
jQuery(document).ready(function() {    
   App.init(); // initlayout and core plugins
   TableAdvanced.init();
   Index.init();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Index.initPeityElements();
   Index.initKnowElements();
   Index.initDashboardDaterange();
   Tasks.initDashboardWidget();
 
});

	$(document).ready(function() {
        $('#sample_1').DataTable({
			// dom: 'Bfrtip',
        	// buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'
        	// ],
			"columnDefs": [
		            { responsivePriority: 1, targets: 0 },
		            { responsivePriority: 2, targets: 1 },
					{ responsivePriority: 3, targets: -1 },
					{ responsivePriority: 4, targets: -2 },
		        ]
		});
		
		$('#sample_1 tbody').on( 'click', 'button', function (e) {
			if($(this).attr('usrId') != null){
				$('#modalValidate').show(); 
			}	
		} ); 

		$('#sample_1 tbody').on( 'change', 'input', function (e) {
			var width = screen.width;

			if(width < 440 && ($(this).attr('soal_id') != null)){
				// $('input[type=checkbox]').change(); 
				var old_id = $(this).attr('soal_id');
    			var value = '0';

				if(this.checked){
					value ='1';
				}

				$.ajax({
					type:'POST',
					url:'{{ route("update.enable")}}',
					data:{'_token':'<?php echo csrf_token() ?>',
							'id':old_id,
							'value':value
					},
					success: function(data){
						// alert('hi');
						if(value == 1){
							$(this).prop('checked', true);
						}
						else{
							$(this).prop('checked', false);
						}

						document.location.reload();
					}
				});
			}	
		} ); 
    } );
</script>

@yield('javascript')

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>