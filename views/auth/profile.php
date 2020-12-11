<main class="profile" id="main">
     <div class="banner">
          <div class="container head">
               <h1 class="h3 mt-3">Mon profil</h1>
               <ul class="tabs">
                    <li class="nav-item">
                         <a class="nav-link active" href="#" data-target="profile" onclick="switchTabs(this, event)">Profil</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link" href="#" data-target="params" onclick="switchTabs(this, event)">Paramètres</a>
                    </li>
                    <?php if ($params->auth->getRole() === "admin") : ?>
                         <li class="nav-item">
                              <a class="nav-link" href="#" data-target="posts" onclick="switchTabs(this, event)">Articles</a>
                         </li>
                    <?php endif; ?>
               </ul>
          </div>
     </div>
     <div class="container tabs-container">
          <?php 
               require get_template('auth/tabs/profile'); 
               require get_template('auth/tabs/params'); 
               if ($params->auth->getRole() === "admin") {
                    require get_template('auth/tabs/posts'); 
               }               
          ?>
          
          
     </div>
</main>