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
                    console.info(url);
                    setTimeout(() => {
                         url === null ? window.history.go(-1) : window.location = url; 
                    }, delay);
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
               setTimeout(() => window.location = url , 500); 
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

const deleteAuth = (a, e) => {
     e.preventDefault();
     let choice = confirm("Êtes-vous sur de vouloir supprimer votre compte ? ");
     let url = a.href
     if ( choice === true ) {
          axios
          .delete(url)
          .then( ({data}) => {
               let type = data.message.type; 
               let message = data.message.content;
               flash(message, type, true);     
               setTimeout(() => window.location = url , 500);           
          })
          .catch( ({response}) => {
               // console.error(response.data.message.content);
               let type = response.data.message.type; 
               let message = response.data.message.content;    
               if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
               if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
          });
     }
     return;
}

const openProfileForm = () => document.querySelector('#form-profile').classList.toggle('hidden');

const closeProfileform = () => document.querySelector('#form-profile').classList.toggle('hidden');

const handleEditProfile = (form, e) => {
     e.preventDefault();
     let url = form.action;
     let data = form.querySelector('#image').value === "" ? { ...getValues('#form-profile select,#form-profile textarea,#form-profile input') } : new FormData(form);
     delete data.mail;
     delete data.password;
     delete data.password_confirm;
     axios
     .post(url, data) 
     .then( ({data}) => {
          if ( data.hasOwnProperty('message') ) {
               let type = data.message.type; 
               let message = data.message.content;
               form.querySelector('#image').value = ''
               flash(message, type, true);
               let imageProfile = document.querySelector('#image-profile')
               if (data.hasOwnProperty('image') && data.image !== "") {
                    imageProfile.src = data.image;
                    imageProfile.srcset = data.image;
               }
               closeProfileform()
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

const handleProfileResetPassword = (form, e) => {
     e.preventDefault();
     let url = form.action;
     let data = {...getValues('#password-form input')}
     console.log({url, data});
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

const handleEmailReset = (form, e) => {
     e.preventDefault();
     let url = form.action;
     let data = {...getValues('#email-form input')};
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
     });
}