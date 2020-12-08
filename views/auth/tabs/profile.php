<div data-tabs="profile" class=""> 
     <p class="d-flex flex-row-reverse">
          <button 
               type="button" 
               onclick="openProfileForm()" 
               class="btn btn-profile btn-green"
          >
               Modifier
          </button>
     </p>
     <div class="col-12">
          <div class="row">
               <div class="col-3 no-padding">                         
                    <img 
                         class="img-profile " 
                         src="<?= $params->auth->getImage()->path ?? "uploads/profile-default.jpg" ?>" 
                         alt="photo de profil" 
                         srcset="<?= $params->auth->getImage()->path ?? "uploads/profile-default.jpg" ?>" 
                         id="image-profile"
                    >
               </div>
               <div class="col-9 d-flex flex-column  justify-content-center">
                    <h4><?= $params->auth->getFirstname() ?>&nbsp;<?= strtoupper($params->auth->getLastname()) ?></h4>
                    <?php if ( $params->auth->getRole() === 'admin' ): ?>
                         <h4><?= $params->auth->getPosition(); ?></h4>
                    <?php endif; ?>
               </div>
          </div>
     </div>
     <h5 class="mt-4 font-weight-bold">A propos de moi</h5>
     <p><?= $params->auth->getChapo() ?></p>
     <h5 class="mt-4 font-weight-bold">Informations sur le compte</h5>
     <p class="mb-0">Date d'inscription : <?= fr_date($params->auth->getCreatedAt()) ?></p>
     <p class="mb-0">Dernière connexion : <?= fr_date($params->auth->getLastConnection()) ?></p>
     <?php require_once get_template('auth/tabs/form') ?>
</div>

