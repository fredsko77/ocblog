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
                         src="<?= $params->user->getImage()->path ?? "uploads/profile-default.jpg" ?>" 
                         alt="photo de profil" 
                         srcset="<?= $params->user->getImage()->path ?? "uploads/profile-default.jpg" ?>" 
                         id="image-profile"
                    >
               </div>
               <div class="col-9 d-flex flex-column  justify-content-center">
                    <h4><?= $params->user->getFirstname() ?>&nbsp;<?= strtoupper($params->user->getLastname()) ?></h4>
                    <h4> <?php if ( $params->user->getRole() === 'admin' ) echo $params->user->getPosition(); ?> </h4>
               </div>
          </div>
     </div>
     <h5 class="mt-4 font-weight-bold">A propos de moi</h5>
     <p><?= $params->user->getChapo() ?></p>
     <h5 class="mt-4 font-weight-bold">Informations sur le compte</h5>
     <p class="mb-0">Date d'inscription : <?= fr_date($params->user->getCreatedAt()) ?></p>
     <p class="mb-0">Dernière connexion : <?= fr_date($params->user->getLastConnection()) ?></p>
     <?php require_once get_template('auth/tabs/form') ?>
</div>

