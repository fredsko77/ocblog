<?php require get_template('elements/head'); ?>

<nav class="navbar navbar-admin">
     <a href="#" class="hamburger-menu" onclick="displayMenu(this,event)" title="Afficher le menu">
          <i class="icofont-navigation-menu"></i>
     </a>
     <a href="#"><img class="img_profile_circle" src="https://via.placeholder.com/150" alt="photo de profil" srcset="https://via.placeholder.com/150"></a>
</nav>
<div id="wrapper">
     <aside class="mobi-nav">
          <div class="menu-lateral">
               <div class="accordion"> 
                    <a href="<?= generate_url('admin') ?>">
                         <i class="icofont-home"></i> Tableau de bord 
                    </a>
                    <i class="icofont-rounded-down float-right dropdown" data-target="website" onclick="displayPanel(this)"></i>               
               </div>
               <div class="panel" data-panel="website">
                    <a href="<?= generate_url("home") ?>" target="_blank" class="panel-link">Aller sur le site web</a>
               </div>
               <div class="accordion"> 
                    <a href="<?= generate_url('admin.posts') ?>">
                         <i class="icofont-papers"></i> Articles 
                    </a>
                    <i class="icofont-rounded-down float-right dropdown" data-target="posts" onclick="displayPanel(this)"></i>               
               </div>
               <div class="panel" data-panel="posts">
                    <ul class="panel-menu">
                         <li class="panel-item">
                              <a href="<?= generate_url('admin.posts') ?>" class="panel-link">Tous les articles</a>
                         </li>
                         <li class="panel-item">
                              <a href="#" class="panel-link">Ajouter un article</a>
                         </li>
                         <li class="panel-item">
                              <a href="<?= generate_url('admin.categories') ?>" class="panel-link">Categories</a>
                         </li>
                    </ul>
               </div>
               <div class="accordion"> 
                    <a href="<?= generate_url('admin.posts') ?>">
                         <i class="icofont-users"></i> Utilisteurs 
                    </a>
                    <i class="icofont-rounded-down float-right dropdown" data-target="users" onclick="displayPanel(this)" ></i>
               </div>
               <div class="panel" data-panel="users" >
                    <ul class="panel-menu">
                         <li class="panel-item">
                              <a href="#" class="panel-link">Tous les utilisateurs</a>
                         </li>
                         <li class="panel-item">
                              <a href="#" class="panel-link">Ajouter</a>
                         </li>
                         <li class="panel-item">
                              <a href="#" class="panel-link">Mon profil</a>
                         </li>
                    </ul>
               </div>
               <div class="accordion"> <i class="icofont-comment"></i> Commentaires </div>
               <div class="accordion"> <i class="icofont-multimedia"></i> Médias </div>
               <div class="accordion"> <i class="icofont-contacts"></i> Contacts </div>
          </div>
          <!--<nav class="menu-aside-admin">
               <ul class="nav-vertical">
                    <li class="nav-vertical-item">
                         <a href="<?= generate_url('admin.posts') ?>" class="nav-vertical-link">Articles</a> 
                    </li>
                    <li class="nav-vertical-item">
                         <a href="#" class="nav-vertical-link active">Médias</a> 
                    </li>
                    <li class="nav-vertical-item">
                         <a href="#" class="nav-vertical-link">Utilisateurs</a> 
                    </li>
                    <li class="nav-vertical-item">
                         <a href="#" class="nav-vertical-link">Contacts</a> 
                    </li>
                    <li class="nav-vertical-item">
                         <a href="#" class="nav-vertical-link">Commentaires</a> 
                    </li>
                    <li class="nav-vertical-item">
                         <a href="<?= generate_url('blog') ?>" class="nav-vertical-link">Revenir sur le blog</a> 
                    </li>
               </ul>
          </nav>-->
     </aside>
     <main id="main">