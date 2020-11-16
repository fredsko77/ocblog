<div id="page-category" class="position-relative">
     <div class="list">
          <h1 class="h3">
               Toutes les catégories 
               <button class="btn btn-outline-primary" onclick="displayForm()">Ajouter</button>
          </h1>

          <div class="table-responsive-md">         
               
          
               <table class="table table-hover table-bordered table-striped">
                    <thead class="thead-light">
                         <tr>
                              <th scope="col">Catégorie</th>
                              <th scope="col">Slug</th>
                              <th scope="col">Description</th>
                              <th scope="col">Actions</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php foreach($params->categories as $category): ?>
                              <tr data-id="<?= $category->getId() ?>">
                                   <th scope="row" data-category="<?= $category->getCategory() ?>">
                                        <?= $category->getCategory() ?>
                                   </th>
                                   <td data-slug="<?= $category->getSlug() ?>">
                                        <?= $category->getSlug() ?>
                                   </td>
                                   <td data-description="<?= $category->getDescription() ?>">
                                        <?= $category->getDescription() ?>
                                   </td>
                                   <td>
                                        <a 
                                             href="/admin/categories/<?= $category->getId() ?>/delete" 
                                             title="Supprimer la catégorie"
                                             onclick="deleteCategory(this)"
                                             data-id="<?= $category->getId() ?>"
                                             >
                                             <i class="icofont-ui-delete"></i>
                                        </a>
                                        <a 
                                             href="#" 
                                             title="Modifier la catégorie"
                                             onclick="hydrateForm(event, <?= $category->getId() ?>)"
                                        >
                                             <i class="icofont-edit"></i>
                                        </a>
                                   </td>
                              </tr>
                         <?php endforeach; ?>
                    </tbody>
               </table>
          
          </div>
     </div>
     <div id="form" class="form position-absolute hidden"> 
          <div class="mb-5" id="close">
               <i 
                    class="icofont-close float-right" 
                    title="Fermer le formulaire" 
                    onclick="closeForm()"
                    id="close-form"
               ></i>
          </div>         
          <div id="category-form" class="mb-3" style="height: 20vh;">     
               <h2 id="form-title">Ajouter la catégorie</h2>     
               <?php
                    require get_template('admin/categories/form');                    
               ?>
          </div>
     </div>
</div>