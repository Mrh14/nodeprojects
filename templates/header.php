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
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/icofont.css">
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

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
                                              <a href="<?php echo $_COOKIE['usertype'] == 'client' ? 'user/events' : 'user/reserver' ; ?>" class="hb-btn hidden-xs mr-2"><?php echo $_COOKIE['usertype'] == 'client' ? 'ESPACE CLIENT' : 'ADMINISTRATION' ; ?></a>

									
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
							
								<!--<div class="hb-cartarea">-->
									<!--<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">-->
									<!--<span class="icon_bag_alt"></span>-->
									<!--</a>-->
									<!--<ul class="list-unstyled dropdown-menu hb-cart right">-->
										<!--<li>-->
											<!--<figure><img src="images/cart-img01.jpg" alt="image description"></figure>-->
											<!--<h3><span>$130.00 x 1</span>OIL MASSAGES</h3>-->
											<!--<button><i class="ti-close"></i></button>-->
										<!--</li>-->
										<!--<li>-->
											<!--<figure><img src="images/cart-img02.jpg" alt="image description"></figure>-->
											<!--<h3><span>$130.00 x 1</span>OIL MASSAGES</h3>-->
											<!--<button><i class="ti-close"></i></button>-->
										<!--</li>-->
										<!--<li>-->
											<!--<span class="hb-total">total:<em>$460.00</em></span>-->
										<!--</li>-->
										<!--<li>-->
											<!--<a href="javascript:void(0);" class="hb-btn hb-btn-lg  changehover">VIEW CARD</a>-->
											<!--<a href="javascript:void(0);" class="hb-btn hb-btn-lg">CHECK OUT</a>-->
										<!--</li>-->
									<!--</ul>-->
								<!--</div>-->
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
                                    <ul id="respmenu" >

                                        <?php if(found() == '') {?>
                                            <li class="menu-item-has-children"><a href="login">Se connecter</a></li>
                                            <li class="menu-item-has-children"><a href="signup">S'inscrire</a></li>
                                        <?php } else {?>

                                        <li><a href="<?php echo $_COOKIE['usertype'] == 'client' ? 'user/reserver' : 'user/events' ; ?>" class="menu-item-has-children"><?php echo $_COOKIE['usertype'] == 'client' ? 'ESPACE CLIENT' : 'ADMINISTRATION' ; ?></a></li>
                                        <li><a href="logout" class="menu-item-has-children" title="Déconnexion">Déconnexion</a></li>

                                        <?php } ?>

                                    </ul>
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