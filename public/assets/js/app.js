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
     console.log(list)
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

// function readURL(input) {
//      if (input.files && input.files[0]) {
//          var reader = new FileReader();
         
//          reader.onload = function(e) {
//          $('#img-uploaded').attr('src', e.target.result);
//          }
         
//          reader.readAsDataURL(input.files[0]);
//      }
//      }
     
//  $("#upload_form_imageFile").change(function() {
//      $('#img-uploaded').removeClass('hidden')
//      readURL(this);
//  });