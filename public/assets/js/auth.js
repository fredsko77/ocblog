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