const addMessage = ({message, message_holder, visibility}) => {
     message_holder.style.visibility = visibility;
     message_holder.innerText = message;
}

const hideMessage = ({message_holder, visibility}) => {
     message_holder.style.visibility = visibility;
     message_holder.innerText = "";
}

const erraseMessage = selector => {
     elements = document.querySelectorAll(selector);
     elements.forEach(element => {
          element.style.visibility = "hidden";
          element.innerText = "";
     });
}

const contact = (form,e) => {
     e.preventDefault();
     let url = form.action;
     let data = {...getValues('select'), ...getValues('input'), ...getValues('textarea') };
     if ( isFilled(data) === false ) {
          for (const property in data) {
               if ( data.hasOwnProperty(property) && property !== 'csrf_token' ) {  
                    let message = document.querySelector(`[name=${property}]`).hasAttribute('data-msg') ? document.querySelector(`[name=${property}]`).dataset.msg : 'Message d\'erreur';
                    let message_holder = document.querySelector(`[name=${property}] + .validate`);
                    data[property] === '' ? setTimeout(addMessage, 600, {message, message_holder, visibility: "visible"}) : setTimeout(addMessage, 600, {message_holder, visibility: "hidden"}) ;      
               }
          }
     } else {
          erraseMessage(`.form-control + .validate`);
          try {
               axios
               .post(url, data)
               .then( ({data}) => {
                    // console.log(response);
                    let type = data.message.type; 
                    let message = data.message.content;
                    flash(message, type, true);
               })
               .catch( ({response}) => {
                    console.error(response.status);
                    let type = response.data.message.type; 
                    let message = response.data.message.content;    
                    if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
                    if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
               }) 
          } catch({response}) {
               console.warn(response);   
          }
     }
}

