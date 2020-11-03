<!DOCTYPE html>
<html lang="fr">
<head>
     <base href="<?php echo 'http://' . $params->request->server('HTTP_HOST') ?>/public/">

     <title><?= $params->title ?? "Blog" ?> - Frédérick AGATHE</title>

     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Google Fonts -->
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

     <!-- Favicons -->
     <link href="<?php echo get_image('portfolio/portfolio-3.jpg') ?>" rel="icon">
     <link href="<?php echo get_image('portfolio/portfolio-3.jpg') ?>" rel="apple-touch-icon"> 

     <!-- Vendor CSS Files -->
     <link href="<?php echo get_vendor("bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">
     <link href="<?php echo get_vendor("icofont/icofont.min.css") ?>" rel="stylesheet">
     <link href="<?php echo get_vendor("owl.carousel/assets/owl.carousel.min.css") ?>" rel="stylesheet">
     <link href="<?php echo get_vendor("boxicons/css/boxicons.min.css") ?>" rel="stylesheet">
     <link href="<?php echo get_vendor("venobox/venobox.css") ?>" rel="stylesheet">
     <link href="<?php echo get_vendor("aos/aos.css") ?>" rel="stylesheet">
     
     <!-- Template Main CSS File -->
     <?php echo get_stylesheet("app"); ?>
     <?php echo get_stylesheet("style"); ?>
     <?php // echo get_stylesheet("admin"); ?>
     <?php // echo get_stylesheet("auth"); ?>
      
     <!-- =======================================================
     * Template Name: Kelly - v2.0.0
     * Template URL: https://bootstrapmade.com/kelly-free-bootstrap-cv-resume-html-template/
     * Author: BootstrapMade.com
     * License: https://bootstrapmade.com/license/
     * Child Template name: Mon Super Blog
     * Child Template URL: https://github.com/...
     ======================================================== -->
</head>
<body>
