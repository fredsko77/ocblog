<?php 

echo $params->form->start("", "handleCategory(this, event)"); 

echo $params->form->input('id', [
     'type' => 'hidden',
     'label' => null
], false);

echo $params->form->input('category', ['label' => 'Catégorie'], true);

echo $params->form->input('slug', ['label' => 'Slug'], true);

echo $params->form->textarea('description', [
     'label' => 'Description',
     'attr' => [
          'rows' => 5
     ],
], true);

echo $params->form->csrf();

?>

<div class="d-flex flex-row">
     <?php echo $params->form->submit("Enregistrer"); ?>
     <button class="btn btn-link hidden" id="cancel-btn" onclick="cancel()">Annuler</button>
</div>


<?php echo $params->form->end(); ?>
