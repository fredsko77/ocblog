/**
* Template Name: 
* Template URL: 
* Author: 
* License: 
*/
!(function($) {
     "use strict";

})(jQuery);

const getCookie = cname => {
     var name = cname + "=";
     var decodedCookie = decodeURIComponent(document.cookie);
     var ca = decodedCookie.split(';');
     for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
               c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
               return c.substring(name.length, c.length);
          }
     }
     return "";
}

const getValues = selector => {
     let object = {};
     elements = document.querySelectorAll(selector);
     elements.forEach(element => {
          object[element.name] = element.value;
     });
     return object;
}

const isFilled = data => {
        
     for (const key in data) {
          if (data.hasOwnProperty(key)) {
               if( data[key] === "" ) return false;             
          }
     }
     return true;
}

const flash = (message, type = 'success', close = true) => {
     close = close === true ? `<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>` : '';
     let alert =    `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                         <strong>${message}</strong>
                         ${close}
                    </div>`;
     document.querySelector('.flash').innerHTML = alert;
}

const validateField = fields => {
     for (const name in fields) {
          if (fields.hasOwnProperty(name)) {
               input = document.querySelector(`[name=${name}]`).classList.toggle('is-invalid')         
          }
     }
}

const listErrors = errors => {
     list = '';
     for (const key in errors) {
          if (errors.hasOwnProperty(key)) {
               list += `<li> ${errors[key]} </li>`;               
          }
     }
     return list;
}

const setFormErrors = errors => {
     let element = document.querySelector('#error_msg_form');
     errors = listErrors(errors)
     let alert =   `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         <ul>
                              ${errors}
                         </ul>
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>`
     element.innerHTML = alert;
}

const dropdown = elt => {
     let arrow = elt.querySelector('i');
     let container = elt.parentNode;
     let angle = parseInt( arrow.style.transform.replace(/[^0-9]/g,'') );
     let drop = elt.nextElementSibling;
     angle += 180;
     arrow.style.transform = `rotate(${angle}deg)`;  
     container.classList.toggle('show');
     drop.classList.toggle('hidden');
} 

const loadUploadedImage = (elt, event) => {
     let imageContainer = document.querySelector('#uploaded-img');
     let errorMessage = document.querySelector('#error-upload');
     let acceptedFile = ["gif", "jpg", "jpeg", "png", "svg"];     
     if (elt.files && elt.files[0]) {
          let filename = elt.files[0].name;
          let extension = (filename.split('.')[1]).toLowerCase();
          if (acceptedFile.includes(extension)) {
               imageContainer.classList.remove('hidden');
               imageContainer.src = URL.createObjectURL(event.target.files[0]); 
               imageContainer.srcset = URL.createObjectURL(event.target.files[0]); 
               imageContainer.onload = () => URL.revokeObjectURL(imageContainer.src); // Free memory 
               errorMessage.classList.add('hidden');
               errorMessage.innerHTML = '';
          } else {
               imageContainer.classList.add('hidden');
               errorMessage.classList.remove('hidden');
               errorMessage.innerHTML = `Seuls les fichiers .gif, .jpg, .jpeg, .png ou .svg sont acceptés, votre fichier est fichier <i>.${extension}</i>`
          }
     } else {
          imageContainer.classList.add('hidden');
     }
}   

const loader = () => {
     let container = document.querySelector('#loader-container');
     let loader = document.querySelector('.loader');
     container.classList.toggle('hidden')
     loader.classList.toggle('spin');
}

const displayPanel = elt => {
     let target = elt.dataset.target;
     let panels = document.querySelectorAll('.panel');
     panels.forEach( ({style, dataset}) => style.height = dataset.panel === target ? 'auto': '0' );
}

const displayForm = () => document.querySelector('#form').classList.toggle('hidden');

const closeForm = () => document.querySelector('#form').classList.toggle('hidden');