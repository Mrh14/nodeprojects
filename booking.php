<?php
include('includes/config.php');
include('includes/cookie.php');


?>
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VISIO | Communauté d'experts</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="css/responsive.css">


</head>
<body class="hb-home hb-homeone">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!--************************************
        Wrapper Start
*************************************-->
<div id="hb-wrapper" class="hb-wrapper hb-haslayout">
    <!--************************************
            Header V2 Start
    *************************************-->
    <header id="hb-header" class="hb-header v2 hb-haslayout">
        <div class="hb-topbar">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12" >
                        <strong class="hb-logo"><a href="./"><img src="images/logo.png" alt="company logo here"></a></strong>

                        <?php if(found() == '') {?>
                            <a href="login" class="hb-btn hidden-xs">Se connecter</a>
                            <a href="signup" class="hb-btn hidden-xs mr-2">S'inscrire</a>
                        <?php } else {?>
                            <a href="logout" class="hb-btn hidden-xs mr-2 px-3" title="Déconnexion"><span class="fas fa-sign-out-alt"></span></a>
                            <a href="user/events" class="hb-btn hidden-xs mr-2">Dashboard</a>


                        <?php } ?>
                        <div class="hb-info-area hidden-xs" style="overflow:hidden;">
                            <ul class="list-unstyled hb-info"   >
                                <li><i class="ti-location-pin hidden-sm"></i><span>3 Route de Cholet 95050 <em>Paris France</em></span></li>
                                <li><i class="ti-email hidden-sm"></i><span><a href="tel:01 85 23 56">01 85 23 56</a><a href="mailto:info@visio.com">info@visio.com</a></span>
                                </li>
                                <li>

                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hb-navigationarea" style="z-index:-1;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="hb-addnav">


                        </div>
                        <nav id="hb-nav" class="hb-nav">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#hb-navigation" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div id="hb-navigation" class="collapse navbar-collapse hb-navigation">
                                <ul>

                                    <li class="menu-item-has-children">
                                        <a href="./">Accueil</a>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="apropos">A propos</a>
                                    </li>

                                    <li><a href="contact">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--************************************
            Header V2 End
    *************************************-->
    <div class="search-popup">
        <div class="holder">
            <div class="block">
                <a href="#" class="close-btn"><i class="fa fa-times"></i></a>
                <form action="#" class="search-form">
                    <fieldset>
                        <input type="search" class="form-control" placeholder="Search">
                        <button type="submit" class="btn-primary"><i class="fa fa-search"></i></button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
		<!--************************************
				Header V3 End
		*************************************-->
		<div class="search-popup">
			<div class="holder">
				<div class="block">
					<a href="#" class="close-btn"><i class="fa fa-times"></i></a>
					<form action="#" class="search-form">
						<fieldset>
							<input type="search" class="form-control" placeholder="Search">
							<button type="submit" class="btn-primary"><i class="fa fa-search"></i></button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>

		<!--************************************
				Banner End
		*************************************-->
		<!--************************************
				Main Start
		*************************************-->
		<main id="hb-main" class="hb-main hb-haslayout">
			<section id="hb-services" class="hb-services hb-sectionspace hb-haslayout">
				<div class="container">
					<div class="row">
						<div class=" col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
							<div class="hb-sectionhead">
								<div class="hb-sectiontitle">
									<h2><span>Calendrier</span>
										Réservez un rendez vous
									</h2>
								</div>
							</div>
							<table class="booked-calendar">
								<thead>
									<tr>
										<th>
											<span class="month-name">september 2018</span>
											<i class="fa fa-chevron-circle-right"></i>
										</th>
									</tr>
									<tr class="months">
										<th>mon</th>
										<th>tue</th>
										<th>wed</th>
										<th>thu</th>
										<th>fri</th>
										<th>sat</th>
										<th>sun</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><span class="clr">30</span></td>
										<td><span class="clr">31</span></td>
										<td><span>01</span></td>
										<td><span>02</span></td>
										<td class="bg-pink pre-opener"><span>03</span></td>
										<td><span>04</span></td>
										<td><span>05</span></td>
									</tr>
									<tr class="entry-block">
										<td>
											<table>
												<thead>
													<th>AVAILABLE APPOINTMENT</th>
												</thead>
												<tbody>
													<td>
														<div class="txt-block">
															<time datetime="2018-14-09">
																<i class="fa fa-clock-o" aria-hidden="true"></i>8:00 AM - 9:00 AM
															</time>
															<span class="live">0 time slots available</span>
														</div>
														<a href="#" class="btn text-uppercase">unavailable</a>
													</td>
													<td>
														<div class="txt-block">
															<time datetime="2018-14-09">
																<i class="fa fa-clock-o" aria-hidden="true"></i>9:00 AM - 10:00 AM
															</time>
															<span class="live">0 time slots available</span>
														</div>
														<a href="#" class="btn text-uppercase">unavailable</a>
													</td>
													<td>
														<div class="txt-block">
															<time datetime="2018-14-09">
																<i class="fa fa-clock-o" aria-hidden="true"></i>10:00 AM - 11:00 AM
															</time>
															<span>1 time slots available</span>
														</div>
														<a href="#" class="btn avail text-uppercase">book appointment</a>
													</td>
													<td>
														<div class="txt-block">
															<time datetime="2018-14-09">
																<i class="fa fa-clock-o" aria-hidden="true"></i>11:00 AM - 12:00 AM
															</time>
															<span>2 time slots available</span>
														</div>
														<a href="#" class="btn avail text-uppercase">book appointment</a>
													</td>
													<td>
														<div class="txt-block">
															<time datetime="2018-14-09">
																<i class="fa fa-clock-o" aria-hidden="true"></i>13:00 AM - 14:00 AM
															</time>
															<span>3 time slots available</span>
														</div>
														<a href="#" class="btn avail text-uppercase">book appointment</a>
													</td>
													<td>
														<div class="txt-block">
															<time datetime="2018-14-09">
																<i class="fa fa-clock-o" aria-hidden="true"></i>14:00 AM - 15:00 AM
															</time>
															<span>1 time slots available</span>
														</div>
														<a href="#" class="btn avail text-uppercase">book appointment</a>
													</td>
													<td>
														<div class="txt-block">
															<time datetime="2018-14-09">
																<i class="fa fa-clock-o" aria-hidden="true"></i>15:00 AM - 16:00 AM
															</time>
															<span>2 time slots available</span>
														</div>
														<a href="#" class="btn avail text-uppercase">book appointment</a>
													</td>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td><span>06</span></td>
										<td class="bg-pink"><span>07</span></td>
										<td><span>08</span></td>
										<td><span>09</span></td>
										<td><span>10</span></td>
										<td><span>11</span></td>
										<td><span>12</span></td>
									</tr>
									<tr>
										<td><span>12</span></td>
										<td><span>13</span></td>
										<td><span>14</span></td>
										<td><span class="active">15</span></td>
										<td><span>16</span></td>
										<td class="bg-pink"><span>17</span></td>
										<td><span>18</span></td>
									</tr>
									<tr>
										<td><span>19</span></td>
										<td><span>20</span></td>
										<td class="bg-pink"><span>21</span></td>
										<td><span>22</span></td>
										<td><span>23</span></td>
										<td><span>24</span></td>
										<td><span>25</span></td>
									</tr>
									<tr>
										<td class="bg-pink"><span>26</span></td>
										<td><span>27</span></td>
										<td><span class="clr">28</span></td>
										<td><span class="clr">01</span></td>
										<td><span class="clr">02</span></td>
										<td><span class="clr">03</span></td>
										<td><span class="clr">04</span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</section>
		</main>
		<footer id="hb-footer" class="hb-footer hb-haslayout">
			<div class="hb-footer-area">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="hb-col">
								<strong class="hb-logo">
									<a href="javascript:void"><img src="images/logo.png" alt=""></a>
								</strong>
								<span class="hb-timeandday">Open hours: 8.00-18.00 Mon-Fri</span>
								<ul class="list-unstyled hb-socialicons">
									<li><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
									<li class="hb-googleplus"><a href="javascript:void(0);"><i class="fab fa-google-plus-g"></i></a></li>
									<li><a href="javascript:void(0);"><i class="fab fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="hb-col">
								<h3>Contacts</h3>
								<ul class="list-unstyled hb-info">
									<li><span>001-1234-8888<a href="mailto:info.deercreative@gmail.com">info.deercreative@gmail.com</a></span>
									</li>
									<li><span>40 Baria Sreet 133/2<em>NewYork City, US</em></span></li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="hb-col">
								<h3>Our Newsletter</h3>
								<div class="hb-emailarea">
									<form class="hb-formtheme">
										<fieldset>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="E-mail">
												<button type="submit" class="hb-btn">SUBSCRIBE</button>
											</div>
										</fieldset>
									</form>
								</div>
								<div class="hb-description">
									<p>Subscribe to our mailing list to get the updates to your email inbox.</p>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="hb-col hb-widget">
								<ul>
									<li><a href="javascript:void(0);"><img src="https://via.placeholder.com/80x80" alt="image description"></a></li>
									<li><a href="javascript:void(0);"><img src="https://via.placeholder.com/80x80" alt="image description"></a></li>
									<li><a href="javascript:void(0);"><img src="https://via.placeholder.com/80x80" alt="image description"></a></li>
									<li><a href="javascript:void(0);"><img src="https://via.placeholder.com/80x80" alt="image description"></a></li>
									<li><a href="javascript:void(0);"><img src="https://via.placeholder.com/80x80" alt="image description"></a></li>
									<li><a href="javascript:void(0);"><img src="https://via.placeholder.com/80x80" alt="image description"></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="hb-footerbar">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<span class="hb-copyright">Copyright ©2018 DeerCreative.</span>
							<ul class="list-unstyled hb-footernav">
								<li><a href="javascript:void(0);">About </a></li>
								<li><a href="javascript:void(0);">Terms & Conditions</a></li>
								<li><a href="javascript:void(0);">Privacy Policy</a></li>
								<li><a href="javascript:void(0);">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<span id="back-top" class="text-center rounded-circle fa fa-angle-up"></span>
		<div id="loader" class="loader-holder">
			<div class="block">
			    <div class="dot white"></div>
			    <div class="dot"></div>
			    <div class="dot"></div>
			    <div class="dot"></div>
			    <div class="dot"></div>
			</div>
		</div>
	</div>
	<!--************************************
			Wrapper End
	*************************************-->
	<script src="js/vendor/jquery-library.js"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/isotope.pkgd.js"></script>
	<script src="js/isotop.js"></script>
	<script src="js/fancybox.js"></script>
	<script src="js/countTo.js"></script>
	<script src="js/appear.js"></script>
	<script src="js/main.js"></script>
</body>
</html>