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
     try {
          axios
          .post(url, data)
          .then( response => {
               console.log(response);
               let messages = response.data.messages;
               let li = "";
               let type = response.data.type; 
               for (const property in messages) {
                    if (messages.hasOwnProperty(property)) {    
                         li += `<li>${property} : ${messages[property]}</li>`;                       
                    }
               }
               if (response.data.type === 'danger') { 
                    setErrorMessages(type, li);
               } else if (response.data.type === 'success') { 
                    setErrorMessages(type, li);
                    // window.location.href = "/";
               }
          })
     } catch(error) {
          console.error(error.response.status);     
     }
     
     // delete axios.defaults.headers["Authorization"];
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
                    let delay = 1000; 
                    if (data.hasOwnProperty('errors')) {
                         document.querySelector(`[name=${data.errors}]`).classList.toggle(invalid);
                    } else {
                         flash(message, type, true);
                         // Faire une redirection sur le blog
                         // setTimeout(() => window.location = url , delay);
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