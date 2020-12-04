<h1 class="h2">Ajouter un nouvel utilisateur</h1>

<?php

    echo $params->form->start(generate_url('admin.users.store'), "handleStoreUser(this,event)", false, [
        'id' => 'form-create-user'
    ]);

    echo $params->form->select('gender', ['mr' => 'M', 'mme' => 'Mme'], "Civilité", false, true);

    echo $params->form->input('lastname', [
        'label' => 'Nom'
    ], true);

    echo $params->form->input('firstname', [
        'label' => 'Prénom'
    ], true);

    echo $params->form->input('email', [
        'type' => "email", 
        'label' => 'Adresse e-mail',
    ], true);

    echo $params->form->select('role', $params->roles, 'Rôle de l\'utilisateur', false, true);

    echo $params->form->submit("Enregistrer", 'outline-primary');

    echo $params->form->end();