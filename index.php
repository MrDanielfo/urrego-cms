<?php

// Modelos
require_once 'models/SlideFrontModel.php';
require_once 'models/ArticlesFrontModel.php';
require_once 'models/GalleryFrontModel.php';
require_once 'models/VideosFrontModel.php';
require_once 'models/SuscribersFrontModel.php';

// Controladores
require_once 'controllers/TemplateController.php';
require_once 'controllers/SlideFrontController.php';
require_once 'controllers/ArticlesFrontController.php';
require_once 'controllers/GalleryFrontController.php';
require_once 'controllers/VideosFrontController.php';
require_once 'controllers/SuscribersFrontController.php';

$frontTemplate = new TemplateController();
$frontTemplate->template();