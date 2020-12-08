<h1 class="h2">Ajouter un nouvel utilisateur</h1>

<?php

    _e( $params->form->start( esc_url( generate_url('admin.users.store') ), "handleStoreUser(this,event)", false, [
        'id' => 'form-create-user'
    ]) );

    _e( $params->form->select('gender', ['mr' => 'M', 'mme' => 'Mme'], "Civilité", false, true) );

    _e( $params->form->input('lastname', [
        'label' => 'Nom'
    ], true) );

    _e( $params->form->input('firstname', [
        'label' => 'Prénom'
    ], true) );

    _e( $params->form->input('email', [
        'type' => "email", 
        'label' => 'Adresse e-mail',
    ], true) );

    _e( $params->form->select('role', $params->roles, 'Rôle de l\'utilisateur', false, true) );

    _e( $params->form->submit("Enregistrer", 'outline-primary') );

    _e( $params->form->end() );