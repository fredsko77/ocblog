var apiBaseUrl = "http://blog";
var apiToken = getCookie("apiToken");

/**
 * @param {*} elt
 * @param {*} e
 */
const handleRegister = (form, e) => {
     e.preventDefault();
     let inputs = document.querySelectorAll('.form-control');
     let invalid = "is-invalid";
     let url = form.action;
     let data = getValues('input');
     inputs.forEach(input => input.classList.remove(invalid))
     try {
          axios
               .post(url, data)
               .then( ({data}) => {
                    if ( data.hasOwnProperty('message') ) {
                         let type = data.message.type; 
                         let message = data.message.content;
                         flash(message, type, true);
                    } else if ( data.hasOwnProperty('errors') ) {
                         validateField(data.errors);
                         setFormErrors(data.errors);
                    }
               })
               .catch( ({response}) => {
                    console.log( response.data )
                    if ( (response.data).hasOwnProperty('message') ) {                         
                         let type = response.data.message.type; 
                         let message = response.data.message.content;    
                         if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
                         if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
                    }
               }) 
     } catch({response}) {
          console.warn(response);   
     }
     return;
}

const authenticateUsers = (form,e) => {
     e.preventDefault();
     let url = form.action;
     let data = getValues('input');
     try {
          axios
               .post(url, data)
               .then( ({data}) => {
                    let type = data.message.type; 
                    let message = data.message.content;
                    flash(message, type, true);                    
                    let url = data.url;
                    let delay = 2000; 
                    // Faire une redirection sur le blog
                    setTimeout(() => window.location = url , delay);
               })
               .catch( ({response}) => {
                    let type = response.data.message.type; 
                    let message = response.data.message.content;    
                    if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
                    if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
               }) 
     } catch({response}) {
          console.warn(response);   
     }
}
     
const forgetPassword = (form,e) => {
     e.preventDefault();
     let url = form.action;
     let data = getValues('input');
     try {
          axios
          .post(url, data)
          .then( ({data}) => {
               // console.log(data.message.type);
               let type = data.message.type; 
               let message = data.message.content;
               flash(message, type, true);
               setTimeout(() => window.location = url , delay); 
          })
          .catch( ({response}) => {
               // console.error(response.data.message.content);
               let type = response.data.message.type; 
               let message = response.data.message.content;    
               if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
               if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
          }) 
     } catch({response}) {
          console.warn(response);   
     }
}

const resetPassword = (form,e) => {
     e.preventDefault();
     let url = form.action;
     let inputs = document.querySelectorAll('.form-control');
     let invalid = "is-invalid";
     token = localStorage.getItem('token');
     let data = {...getValues('input'), token}
     inputs.forEach(input => input.classList.remove(invalid))
     try {
          axios
               .post(url, data)
               .then( ({data}) => {
                    let type = data.message.type; 
                    let message = data.message.content;                    
                    let url = data.url;
                    let delay = 2000; 
                    if (data.hasOwnProperty('errors')) {
                         document.querySelector(`[name=${data.errors}]`).classList.toggle(invalid);
                    } else {
                         flash(message, type, true);
                         // Faire une redirection sur la page de connexion
                         setTimeout(() => window.location = url , delay);
                    }
               })
               .catch( ({response}) => {
                    let type = response.data.message.type; 
                    let message = response.data.message.content;    
                    if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
                    if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
               }) 
     } catch({response}) {
          console.warn(response);   
     }
}