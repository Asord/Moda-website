<?php
    
    function getHeader($title) 
	{ 
		return '
			<!DOCTYPE html>
			<html>
				<head>
					<meta charset="utf-8" />
					<meta name="viewport" content="width=device-width" />
					<title>'.$title.'</title>
					<!-- CSS -->
					<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
					<link rel="stylesheet" href="./css/bootstrap.css" />
					<link rel="stylesheet" href="./css/style.css" />
					<!-- Javasripts -->
					<script src="https://code.jquery.com/jquery-2.2.4.min.js"
						integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
						crossorigin="anonymous"></script>
					<script src="./js/bootstrap.js"></script>
				</head>
				
				<body>
				<!--start of header-->
					<header>
						<nav class="navbar navbar-default navbar-fixed-top">
						  <div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
							  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							  </button>
							  <a class="navbar-brand" href="#">LOGO</a>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							  <ul class="nav navbar-nav navbar-right">
								<li><a href="#">Demande d\'aide</a></li>
								<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Galerie <span class="caret"></span></a>
								  <ul class="dropdown-menu">
									<li><a href="#">Toutes les catégories</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#">Graphisme</a></li>
									<li><a href="#">Photographie</a></li>
									<li><a href="#">Game Design</a></li>
									<li><a href="#">Conception de site Web</a></li>
									<li><a href="#">Modélisation 3D</a></li>
									<li><a href="#">Animation</a></li>
									<li><a href="#">Character Design</a></li>
									<li><a href="#">FabLab</a></li>
								  </ul>
								</li>
							  </ul>
							</div><!-- /.navbar-collapse -->
						  </div><!-- /.container-fluid -->
						</nav>
						<div class="h1">
							<div class="text-center">Module d\'Aide</div>
						</div>
						<div class="h2">
							<div class="text-center">Informatique Graphique</div>
						</div>
						
					</header>
					<!--end of header-->';
	}
    function getAdminHeader($title, $additionalScript = "") 
	{ 
		return '
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8" />
				<meta name="viewport" content="width=device-width" />
				<title>'.$title.'</title>
				<!-- CSS -->
				<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
				<link rel="stylesheet" href="./css/bootstrap.css" />
				<link rel="stylesheet" href="./css/style.css" />
				<link rel="stylesheet" href="./css/style_admin.css?v=1.0" />
				<!-- Javasripts -->
				<script src="https://code.jquery.com/jquery-2.2.4.min.js"
					integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
					crossorigin="anonymous"></script>
				<script src="./js/bootstrap.js"></script>
				'.$additionalScript.'
			</head>
			
			<body>
			<!--start of header-->
				<header>
					<nav class="navbar navbar-default navbar-fixed-top">
					  <div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						  <a class="navbar-brand" href="#">LOGO</a>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						  <ul class="nav navbar-nav navbar-right">
							<li><a href="admin.php">Administration</a></li>
							<li><a href="imageUploader.php">Gestion d\'images</a></li>
						  </ul>
						</div>
					  </div>
					</nav>
					<div class="h1">
						<div class="text-center">Module d\'Aide</div>
					</div>
					<div class="h2">
						<div class="text-center">Informatique Graphique</div>
					</div>
				</header>
				<!--end of header-->';
	}
    //function getFooter() { return file_get_contents("template_footer.html"); }
    
?>
