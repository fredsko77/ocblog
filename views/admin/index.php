<div class="col-12">
     <h1 class="h3 mb-3">Tableau de bord</h1>
     <div class="row">          
          <div class="col-12 col-md-6 d-flex flex-column justify-content-start">
               <div class="col-xs-12 mb-4">
                    <div class="drop-down">
                         <div class="drop-btn">D'un coup d'oeil</div>
                         <div class="drop position-relative dash-panel">
                              <a href="<?= generate_url('admin.contacts') ?>">
                                   <h5>
                                        <i class="icofont-contacts"></i>
                                        <?= count($params->contacts) ?>
                                        &nbsp;
                                        Message(s) non lu(s)
                                   </h5>
                              </a>
                              <a href="<?= generate_url('admin.posts') ?>">
                                   <h5>                                   
                                        <i class="icofont-papers"></i>
                                        <?= count($params->posts) ?>
                                        &nbsp;
                                        Article(s) en brouillon
                                   </h5>
                              </a>
                              <a href="<?= generate_url('admin.comments') ?>">
                                   <h5>                                   
                                        <i class="icofont-speech-comments"></i>
                                        <?= count($params->comments) ?>
                                        &nbsp;
                                        Commentaire(s) à vérifier
                                   </h5>
                              </a>
                         </div>
                    </div>
               </div>   
               <div class="col-xs-12 mb-4">
                    <div class="drop-down">
                         <div class="drop-btn">Activité</div>
                         <div class="drop position-relative dash-panel">             
                              <h5>Terminer l'article</h5>
                              <p>
                                   <?= diff($params->lastUploadedPost->getUpdatedAt()) ?>
                                   &nbsp;
                                   <a 
                                        href="<?= generate_url('admin.posts.edit', [
                                             'id' => $params->lastUploadedPost->getId(),
                                        ]) ?>"
                                   >
                                        <?= $params->lastUploadedPost->getTitle() ?>
                                   </a>
                              </p>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-12 col-md-6 d-flex flex-column justify-content-start">  
               <div class="col-xs-12 mb-4">
                    <div class="drop-down">
                         <div class="drop-btn">Articles les plus populaires</div>
                         <div class="drop position-relative dash-panel">
                              <?php foreach($params->latest as $k => $p): ?>
                                   <a href="<?= generate_url('blog.show', [
                                        'id' => $p->getId(),
                                        'slug' => $p->getSlug(),
                                   ]) ?>">
                                        <h5>
                                             <?= $p->getTitle() ?> 
                                             <span class="float-right">                                                  
                                                  <?= count($p->getComments()) ?>
                                                  <i class="icofont-speech-comments"></i>
                                             </span>
                                        </h5>
                                   </a>
                              <?php endforeach ?>
                         </div>
                    </div>
               </div>
               <!-- <div class="col-xs-12 mb-4">
                    <div class="drop-down">
                         <div class="drop-btn">Articles les plus populaires</div>
                         <div class="drop position-relative dash-panel">
                              
                         </div>
                    </div>
               </div> -->
          </div> 
     </div>
</div>