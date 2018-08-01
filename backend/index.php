<?php

error_reporting(E_ALL ^ E_NOTICE);

// Modelos
require_once 'models/LinksModel.php';
require_once 'models/SignUpModel.php';
require_once 'models/SlideModel.php';
require_once 'models/ArticlesModel.php';
require_once 'models/GalleryModel.php';
require_once 'models/VideosModel.php';
require_once 'models/SuscribersModel.php';
require_once 'models/ProfilesModel.php';

// Controladores
require_once 'controllers/TemplateController.php';
require_once 'controllers/LinksController.php';
require_once 'controllers/SignUpController.php';
require_once 'controllers/SlideController.php';
require_once 'controllers/ArticlesController.php';
require_once 'controllers/GalleryController.php';
require_once 'controllers/VideosController.php';
require_once 'controllers/SuscribersController.php';
require_once 'controllers/ProfilesController.php';



$backendTemplate = new TemplateController();
$backendTemplate->template(); 