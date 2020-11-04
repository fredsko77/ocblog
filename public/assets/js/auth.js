var apiBaseUrl = "http://blog";
var apiToken = getCookie("apiToken");

/**
 * @param {*} elt
 * @param {*} e
 */
const handleRegister = (elt, e) => {
     e.preventDefault();
     let url = elt.action;
     let data = getValues('form input, form select');
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

const authenticateUsers = (form,event) => {
     event.preventDefault();
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