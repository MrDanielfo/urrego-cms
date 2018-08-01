<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BackEnd</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="views/images/icono.jpg">

	<link rel="stylesheet" href="views/css/bootstrap.min.css">
	<link rel="stylesheet" href="views/css/font-awesome.min.css">
	<link rel="stylesheet" href="views/css/style.css">
	<link rel="stylesheet" href="views/css/fonts.css">
    <link rel="stylesheet" href="views/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="views/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" href="views/css/jquery-ui.min.css">
	<link rel="stylesheet" href="views/css/sweetalert.css">
	<link rel="stylesheet" href="views/css/cssFancybox/jquery.fancybox.css">
	<link rel="stylesheet" href="views/css/jquery-ui.min.css">

	<!-- Javascript -->
	<script src="views/js/jquery-2.2.0.min.js"></script>
	<script src="views/js/bootstrap.min.js"></script>
	<script src="views/js/jquery.fancybox.js"></script>
	<script src="views/js/jquery.dataTables.min.js"></script>
	<script src="views/js/dataTables.bootstrap.min.js"></script>
	<script src="views/js/dataTables.responsive.min.js"></script>
	<script src="views/js/responsive.bootstrap.min.js"></script>
	<script src="views/js/jquery-ui.min.js"></script>
	<script src="views/js/sweetalert.min.js"></script>

</head>

<body>

	<div class="container-fluid">

		<section class="row">

		<?php
			$page = new LinksController();
			$page->links();

		?>

		<!--=====================================
		COLUMNA BOTONERA           
        ======================================-->
        
       

			
		<!--====  FIn de COLUMNA BOTONERA  ====-->

		<!--=====================================
		COLUMNA CONTENIDO        
		======================================-->
		
			<!--=====================================
			 CABEZOTE             
            ======================================-->
			<!--====  Fin de CABEZOTE  ====-->

		

			

		<!--====  Fin de COLUMNA CONTENIDO  ====-->

		</section>
	
    </div>
    
    
	<script src="views/js/script.js"></script>
	<script src="views/js/validaciones.js"></script>
	<script src="views/js/gestorSlide.js"></script>
	<script src="views/js/gestorArticle.js"></script>
	<script src="views/js/gestorGallery.js"></script>
	<script src="views/js/gestorVideos.js"></script>
	<script src="views/js/gestorSuscribers.js"></script>
	<script src="views/js/gestorProfiles.js"></script>
	
</body>

</html>