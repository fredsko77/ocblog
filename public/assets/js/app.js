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

if ( document.querySelector('textarea#content') !== null ) {
     tinymce.init({
          selector: 'textarea#content',
          menu: {
               file: { title: 'File', items: 'newdocument restoredraft | preview | print ' },
               edit: { title: 'Edit', items: 'undo redo | cut copy paste | selectall | searchreplace' },
               view: { title: 'View', items: 'code | visualaid visualchars visualblocks | spellchecker | preview fullscreen' },
               insert: { title: 'Insert', items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime' },
               format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align lineheight | forecolor backcolor | removeformat' },
               tools: { title: 'Tools', items: 'spellchecker spellcheckerlanguage | code wordcount' },
               table: { title: 'Table', items: 'inserttable | cell row column | tableprops deletetable' },
               help: { title: 'Help', items: 'help' }
          },
     });
}

const urlParamsAll = () => window.location.search; 

const urlParam = key => {
     let params = new URLSearchParams(urlParamsAll())
     return params.get(key);
} 

const showUserMenu = e => {
     e.preventDefault();
     let voiture = {
          marque: "Renault",
          modèle: "Talisman",
          couleurs: "noire",
          chevaux: "120ch",
          immatriculation: "AA-000-AA",
     }
     delete voiture.immatriculation;
     console.warn(voiture);
     let menu = document.querySelector('#menu-user');
     if ( menu.classList.contains('show') || menu.classList.contains('hide') ) {
          menu.classList.toggle('show');
          menu.classList.toggle('hide');
          return;
     }
     return menu.classList.add('show');
}

const switchTabs = (a, e) => {
     e.preventDefault();
     let tabs = document.querySelectorAll("[data-tabs]");
     let targets = document.querySelectorAll("[data-target]");
     let target = a.dataset.target;
     targets.forEach(targs => {
          targs.dataset.target === target ?  targs.classList.add('active') : targs.classList.remove('active');
     })
     tabs.forEach(tab => {
          tab.dataset.tabs === target ?  tab.classList.remove('hidden') : tab.classList.add('hidden');
     })
}