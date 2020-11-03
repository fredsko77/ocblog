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

const setFormMessages = (type, messages) => {
     element = document.querySelector('#error_msg_form');
     element.classList.remove("alert-danger", "alert-success", "alert-warning", "alert-primary");
     element.classList.add(`alert-${type}`);
     element.innerHTML = messages;
     return;
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