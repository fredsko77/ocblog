<h1 class="h3">
     Tous les articles 
     <a 
          href="<?= esc_url( generate_url("admin.posts.create") ); ?>" 
          class="btn btn-outline-primary"
     >
          Ajouter
     </a>
</h1>
<div class="form-check">
     <input 
          type="checkbox" 
          name="filter" 
          id="filter" 
          value="draft" 
          onclick="filterPosts(this)"
     >
     <label for="filter">Voir le broillon</label>
</div>
<div class="table-responsive-md">

     <table class="table table-hover table-bordered table-striped">
          <thead class="thead-light">
               <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
               </tr>
          </thead>
          <tbody>
               <?php foreach($params->posts as $k => $p): ?>
                    <tr data-post="<?= $p->getId() ?>">
                         <th scope="row">
                              <a href="<?= esc_url( generate_url("admin.posts.edit", ['id' => $p->getId()]) ); ?>">
                                   <?= $p->getTitle() ?>
                              </a>                         
                         </th>
                         <td>
                              <?= $p->getWriter() ? "{$p->getWriter()->getFirstname()} {$p->getWriter()->getLastname()}" : '' ?>
                         </td>
                         <td data-status="<?= $p->getStatus() ?>">
                              <?= $params->status[ $p->getStatus() ] ?>
                         </td>
                         <td>
                              <?= $params->status[ $p->getStatus() ] . ( $p->getStatus() === "draft" ? " - Dernière modification " : "" ) . " le" ?>
                              <br/>
                              <?= fr_date( $p->getUpdatedAt() ) ?>
                         </td>
                         <td>
                              <a 
                                   href="<?= esc_url( generate_url("admin.posts.delete", ['id' => $p->getId()]) ); ?>" 
                                   title="Supprimer l'article"
                                   data-id="<?= $p->getId() ?>"
                                   onclick="deletePost(this, event)"
                              >
                                   <i class="icofont-ui-delete"></i>
                              </a>
                              <a 
                                   href="<?= esc_url( generate_url("admin.posts.edit", ['id' => $p->getId()]) ); ?>" 
                                   title="Modifier l'article"
                              >
                                   <i class="icofont-edit"></i>
                              </a>
                         </td>
                    </tr>
               <?php endforeach; ?>
          </tbody>
     </table>
</div>