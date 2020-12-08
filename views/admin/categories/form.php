<?php 

_e( $params->form->start("", "handleCategory(this, event)") ); 

_e( $params->form->input('id', [
     'type' => 'hidden',
     'label' => null
], false) );

_e( $params->form->input('category', ['label' => 'Catégorie'], true) );

_e( $params->form->input('slug', ['label' => 'Slug'], true) );

_e( $params->form->textarea('description', [
     'label' => 'Description',
     'attr' => [
          'rows' => 5
     ],
], true) );

_e( $params->form->csrf() );

?>

<div class="d-flex flex-row">
     <?php _e( $params->form->submit("Enregistrer") ); ?>
     <button class="btn btn-link hidden" id="cancel-btn" onclick="cancel()">Annuler</button>
</div>


<?php _e( $params->form->end() ); ?>
