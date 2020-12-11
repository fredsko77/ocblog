<?php require get_template('elements/head'); ?>

<nav class="navbar navbar-admin">
     <a 
          href="#" 
          id="hamburger-menu" 
          onclick="displayNav();event.preventDefault()" 
          title="Afficher le menu"
     >
          <i class="icofont-navigation-menu"></i>
     </a>
     <a href="#" onclick="showUserMenu(event)">
          <img 
               class="img_profile_circle" 
               src="<?= $params->auth->getImage()->path ?? "uploads/profile-default.jpg" ?>" 
               alt="photo de profil" 
               srcset="<?= $params->auth->getImage()->path ?? "uploads/profile-default.jpg" ?>"
          >
     </a>
     
</nav>
<div class="position-absolute" id="menu-user">
     <ul class="nav-drop">
          <li>
               <a href="<?= esc_url( generate_url('auth.profile') ); ?>"> 
                    <i class="icofont-user-alt-3"></i> &nbsp; Mon profil
               </a>
          </li>
          <li>
               <a href="<?= esc_url( generate_url('home') ); ?>"> 
                    <i class="icofont-web"></i> &nbsp; Revenir au site web
               </a>
          </li>
          <li>
               <a href="<?= esc_url( generate_url('auth.logout') ); ?>"> 
                    <i class="icofont-power"></i> &nbsp; Se déconnecter
               </a>
          </li>
     </ul>
</div>
<div id="wrapper">
     <aside id="mobi-nav">
          <div class="menu-lateral">
               <div class="accordion"> 
                    <a href="<?= esc_url( generate_url('admin') ); ?>">
                         <i class="icofont-home"></i> Tableau de bord 
                    </a>
                    <i 
                         class="icofont-rounded-down float-right dropdown" 
                         data-target="website" 
                         onclick="displayPanel(this)"
                    ></i>               
               </div>
               <div class="panel" data-panel="website">
                    <a 
                         href="<?= esc_url( generate_url("home") ); ?>" 
                         target="_blank" 
                         class="panel-link"
                    >
                         Aller sur le site web
                    </a>
               </div>
               <div class="accordion"> 
                    <a href="<?= esc_url( generate_url('admin.posts') ); ?>">
                         <i class="icofont-papers"></i> Articles 
                    </a>
                    <i 
                         class="icofont-rounded-down float-right dropdown" 
                         data-target="posts" 
                         onclick="displayPanel(this)"
                    ></i>               
               </div>
               <div class="panel" data-panel="posts">
                    <ul class="panel-menu">
                         <li class="panel-item">
                              <a 
                                   href="<?= esc_url( generate_url('admin.posts') ); ?>" 
                                   class="panel-link"
                              >
                                   Tous les articles
                              </a>
                         </li>
                         <li class="panel-item">
                              <a 
                                   href="<?= esc_url( generate_url('admin.posts.create') ); ?>" 
                                   class="panel-link"
                              >
                                   Ajouter un article
                              </a>
                         </li>
                         <li class="panel-item">
                              <a 
                                   href="<?= esc_url( generate_url('admin.categories') ); ?>" 
                                   class="panel-link"
                              >
                                   Categories
                              </a>
                         </li>
                    </ul>
               </div>
               <div class="accordion"> 
                    <a href="<?= esc_url( generate_url('admin.users') ); ?>">
                         <i class="icofont-users"></i> Utilisteurs 
                    </a>
                    <i 
                         class="icofont-rounded-down float-right dropdown" 
                         data-target="users" 
                         onclick="displayPanel(this)"
                    ></i>
               </div>
               <div class="panel" data-panel="users" >
                    <ul class="panel-menu">
                         <li class="panel-item">
                              <a 
                                   href="<?= esc_url( generate_url('admin.users') ); ?>" 
                                   class="panel-link"
                              >
                                   Tous les utilisateurs
                              </a>
                         </li>
                         <li class="panel-item">
                              <a 
                                   href="<?= esc_url( generate_url('admin.users.create') ); ?>" 
                                   class="panel-link"
                              >
                                   Ajouter
                              </a>
                         </li>
                    </ul>
               </div>
               <div class="accordion"> 
                    <a href="<?= esc_url( generate_url('admin.comments') ); ?>"> 
                         <i class="icofont-comment"></i> Commentaires 
                    </a>
               </div>
               <div class="accordion"> 
                    <a href="<?= esc_url( generate_url('admin.contacts') ); ?>"> 
                         <i class="icofont-contacts"></i> Contacts 
                    </a>
               </div>
          </div>
     </aside>
     <main id="main">