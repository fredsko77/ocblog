const deletePost = (a, e) => {
     e.preventDefault();
     let url = a.href;
     let id = parseInt(a.dataset.id)
     loader()
     document.querySelector(`tr[data-post='${id}']`).remove();
     try {
          axios
          .delete(url)
          .then( ({data}) => {
               let type = data.message.type; 
               let message = data.message.content;                    
               flash(message, type)
               })
               .catch( ({response}) =>{
                    // console.warn(error);
                    let type = response.data.message.type; 
                    let message = response.data.message.content;    
                    if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
                    if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
               })
     } catch ( errors ) {
          console.error(errors)
     }
     loader()
}

const handleCreatePost = (form, e) =>{
     e.preventDefault()
     let url = form.action;
     let formData = new FormData(form);
     let data = form.querySelector('#image').value === "" ? { ...getValues('select, textarea, input') } : formData;
     axios
     .post(url, data)
     .then( ({data}) => {
          if ( data.hasOwnProperty('message') ) {
               let type = data.message.type; 
               let message = data.message.content;
               form.querySelector('#image').value = ''
               flash(message, type, true);                
               let url = data.url;
               let delay = 2000; 
               // Faire une redirection sur la page d'édition de l'article
               setTimeout(() => window.location = url , delay);
          } else if ( data.hasOwnProperty('errors') ) {
               validateField(data.errors);
               setFormErrors(data.errors);
          }
     })
     .catch( ({response}) => {
          let type = response.data.message.type; 
          let message = response.data.message.content;    
          if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
          if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
     }) 
          
}

const handleUpdatePost = (form, e) => {
     e.preventDefault()
     let url = form.action;
     let formData = new FormData(form);
     let data = form.querySelector('#image').value === "" ? { ...getValues('select, textarea, input') } : formData;
     axios
     .post(url, data) 
     .then( ({data}) => {
          if ( data.hasOwnProperty('message') ) {
               let type = data.message.type; 
               let message = data.message.content;
               form.querySelector('#image').value = ''
               flash(message, type, true);
          } else if ( data.hasOwnProperty('errors') ) {
               validateField(data.errors);
               setFormErrors(data.errors);
          }
     })
     .catch( ({response}) => {
          if ( (response.data).hasOwnProperty('message') ) {                         
               let type = response.data.message.type; 
               let message = response.data.message.content;    
               if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
               if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
          }
     }) 
}

const addCategory = ({id, slug, description, category}) => {
     let tBody = document.querySelector('tbody');
     let row = document.createElement('tr');
     let html =     `<th scope="row" data-category="${category}"> ${category} </th>
                    <td data-slug="${slug}"> ${slug} </td>
                    <td data-description="${description}"> ${description} </td>
                    <td>
                         <a 
                              href="/admin/categories/${id}/delete" 
                              title="Supprimer la catégorie"
                              data-id="${id}"
                              onclick="deleteCategory(this, event)"
                         >
                              <i class="icofont-ui-delete"></i>
                         </a>
                         <a 
                              href="#" 
                              title="Modifier la catégorie"
                              onclick="hydrateForm(event, ${id})"
                         >
                              <i class="icofont-edit"></i>
                         </a>
                    </td>`;
     row.setAttribute('data-id', id)
     tBody.appendChild(row)
     row.innerHTML = html;
}

const refreshRow = data => {
     let row = document.querySelector(`tr[data-id='${data.id}']`);
     console.log(row);
     for (const property in data) {
          if (data.hasOwnProperty(property) && property !== "id") {
               let column = row.querySelector(`[data-${property}]`);
               column.setAttribute(`data-${property}`, data[property]);
               column.innerText = data[property];
          }
     }
}

const handleCategory = (form, e) => {
     e.preventDefault();
     const data = { ...getValues('input, textarea')};
     const url = data.id === '' ? "/admin/categories/create" : `/admin/categories/${data.id}/update`;
     console.warn(data);
     try {
          if ( data.id === "" ) {          
               axios
               .post(url, data)
               .then( ({data}) => {
                    let type = data.message.type; 
                    let message = data.message.content;                    
                    flash(message, type);
                    if(data.category) addCategory(data.category);
                    form.reset();
                    closeForm();
               })
               .catch( ({response}) =>{
                    let type = response.data.message.type; 
                    let message = response.data.message.content;    
                    if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
                    if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
               })
          } else {
               axios
               .put(url, data)
               .then( ({data}) => {
                    let type = data.message.type; 
                    let message = data.message.content;                    
                    flash(message, type);
                    if(data.category) refreshRow(data.category);
                    console.warn(data)
                    form.reset();
                    closeForm();
               })
               .catch( ({response}) =>{
                    let type = response.data.message.type; 
                    let message = response.data.message.content;    
                    if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
                    if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
               })
          }     

     } catch ( errors ) {
          console.error(errors);
     }
     
}

const hydrateForm = (e, id) => {
     e.preventDefault()
     let row = document.querySelector(`tr[data-id='${id}']`);
     let category = row.querySelector(`[data-category]`).dataset.category;
     let slug = row.querySelector(`[data-slug]`).dataset.slug;
     let description = row.querySelector(`[data-description]`).dataset.description;
     let data = {id, category, slug, description};
     document.getElementById('cancel-btn').classList.toggle('hidden');
     displayForm();
     for (const property in data) {
          if (data.hasOwnProperty(property)) {
               document.querySelector(`[name=${property}]`).value = data[property];               
          }
     }
}

const cancel = () => {
     document.querySelector('form').reset()
     document.getElementById('cancel-btn').classList.toggle('hidden');
     closeForm();
}

const deleteCategory = (a) => {
     event.preventDefault();
     let url = a.href;
     let id = a.dataset.id;
     loader()
     try {
          axios
          .delete(url)
          .then( ({data}) => {
               let type = data.message.type; 
               let message = data.message.content;                    
               flash(message, type)
               document.querySelector(`tr[data-id='${id}']`).remove();
          })
          .catch( ({response}) =>{
               let type = response.data.message.type; 
               let message = response.data.message.content;    
               if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
               if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
          })
     } catch ( errors ) {
          console.error(errors)
     }
     loader()
}