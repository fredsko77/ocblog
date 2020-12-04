<div id="page-message">

     <h1 class="h3">
          Tous les messages (<o id="count-contact"><?= $params->contacts !== NULL ? count($params->contacts) : 0 ?></o>)
     </h1>

     <div class="table-responsive-md">
     
          <table class="table table-hover table-bordered table-striped">
               <thead class="thead-light">
                    <tr>
                         <th scope="col">Nom</th>
                         <th scope="col">Objet</th>
                         <th scope="col">Email</th>
                         <th scope="col" class="hidden">Message</th>
                         <th scope="col">Actions</th>
                    </tr>
               </thead>
               <tbody>
                    <?php foreach($params->contacts as $k => $contact): ?>
                         <tr data-contact="<?= $contact->getId() ?>">
                              <th scope="row" data-name="<?= $contact->getName() ?>">
                                   <a href="<?= generate_url("admin.contacts.edit", ['id' => $contact->getId()]) ?>">
                                        <?= ucwords($contact->getName()); ?>
                                   </a>                         
                              </th>
                              <td data-subject="<?= $contact->getSubject() ?>">
                                   <?= $contact->getSubject() ?>
                              </td>
                              <td data-email="<?= $contact->getEmail() ?>">
                                   <?= $contact->getEmail() ?>
                              </td>
                              <td class="hidden" data-message="<?= $contact->getMessage() ?>">
                                   <?= $contact->getMessage(); ?>
                              </td>
                              <td>
                                   <a 
                                        href="<?= generate_url("admin.contacts.edit", ['id' => $contact->getId()]) ?>" 
                                        title="Voir le message l'article"
                                        data-id="<?= $contact->getId() ?>"
                                        onclick="displayMessage(this, event)"
                                   >
                                        <i class="icofont-eye"></i>
                                   </a>
                              </td>
                         </tr>
                    <?php endforeach; ?>
               </tbody>
          </table>
          <p 
               class="font-weight-bold <?php if ( count($params->contacts) > 0 ): ?>hidden<?php endif; ?>" 
               id="contact-none" 
          >
               Aucun message à afficher. 
          </p>
     
     </div>
     
     <div class="message hidden" id="form">
          <div class="mb-5" id="close">
               <i 
                    class="icofont-close float-right" 
                    title="Fermer le formulaire" 
                    onclick="closeMessage()" id="close-form"
               ></i>
          </div>
          
          <?php 
               echo $params->form->start('', "readContact(this, event)");
               echo $params->form->input('name', [
                    'label' => 'Nom',
                    'attr' => [
                         'value' => '',
                         'disabled' => 'disabled'
                    ],
               ], true);
               echo $params->form->input('email', [
                    'label' => 'E-mail',
                    'type' => 'email',
                    'attr' => [
                         'value' => '',
                         'disabled' => 'disabled'
                    ],
               ], true);
               echo $params->form->input('subject', [
                    'label' => 'Sujet',
                    'attr' => [
                         'value' => '',
                         'disabled' => 'disabled'
                    ],
               ], true);
               echo $params->form->textarea('message', [
                    'label' => 'Message',
                    'attr' => [
                         'row' => 20,
                         'value' => '',
                         'disabled' =>'disabled',
                    ],
               ], true);
               echo $params->form->input('id', ['label' => null, 'type' => 'hidden']);
          ?>
               <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="status" value="read">
                    <label class="form-check-label" for="status"><?= $params->status['read'] ?></label>
               </div>               
               <div class="d-flex flex-row">
                    <?php echo $params->form->submit("Enregistrer"); ?>
                    <button class="btn btn-link" id="cancel-btn" onclick="closeMessage()">Annuler</button>
               </div>
          <?= $params->form->end(); ?>
     
     </div>

</div>