<h1 class="h3">
    Liste des utlisateurs 
    (<o id="count-contact"><?= $params->users !== NULL ? count($params->users) : 0 ?></o>)
    <a 
        href="<?= generate_url("admin.users.create") ?>" 
        class="btn btn-outline-primary"
    >
        Ajouter
    </a>
</h1>

<table class="table table-hover table-bordered table-striped">
    <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Pseudo</th>
            <th scope="row">Rôle</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($params->users as $k => $user): ?>
            <tr data-user="<?= $user->getId() ?>">
                <th scope="row"><?= $user->getId() ?></th>
                <td><?= "{$user->getFirstname()}&nbsp;{$user->getLastname()}" ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getPseudo() ?></td>
                <td data-role="<?= $user->getRole() ?>">
                    <?= $params->roles[ $user->getRole() ] ?>
                </td>
                <td>
                    <a 
                        href="<?= generate_url("admin.users.edit.role", [
                            'id' => $user->getId()
                        ]) ?>" 
                        title="Modifier l'utilisateur"
                        data-id="<?= $user->getId() ?>"
                        onclick="openEditUserForm(this, event)"
                    >
                        <i class="icofont-edit"></i>
                    </a>
                    <a 
                        href="<?= generate_url("admin.users.delete", [
                            'id' => $user->getId()
                        ]) ?>" 
                        title="Supprimer l'utilisateur"
                        data-id="<?= $user->getId() ?>"
                        onclick="deleteUser(this, event)"
                    >
                        <i class="icofont-ui-delete"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
    echo $params->form->start("", "handleEditRole(this, event)", false, [
        'id' => 'form-edit-role',
        'class' => 'hidden',
    ]);
?>
<div class="mb-1" id="close">
    <i 
        class="icofont-close float-right" 
        title="Fermer le formulaire" 
        onclick="closeUserForm()" id="close-form"
        style="margin-right: 0 !important; margin-bottom: 5px"
    ></i>
</div>  
<?php echo $params->form->select('role', $params->roles, false, false, true); ?>
<div class="d-flex flex-row mb-1">
    <?php echo $params->form->submit("Enregistrer"); ?>
    <button 
        class="btn btn-link" 
        id="cancel-btn" 
        onclick="closeUserForm(); event.preventDefault()"
    >
        Annuler
    </button>
</div>
<?php echo $params->form->end(); ?>