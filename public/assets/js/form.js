const setErrorMessages = (type, messages) => {
     element = document.querySelector('#error_msg_form');
     element.classList.remove("alert-danger", "alert-success", "alert-warning", "alert-primary");
     element.classList.add(`alert-${type}`);
     element.innerHTML = messages;
     return;
}

const handleComment = (form, event) => {
     event.preventDefault();
     let url = form.action;
     let data = { ...getValues('input, textarea') };
     console.warn(data);
     if ( ! isFilled(data) ) {
          return flash('Le champs commentaire doit être rempli', 'warning', true)
     }
     axios
     .post(url, data)
     .then( ({data}) => {
          let type = data.message.type; 
          let message = data.message.content;
          flash(message, type, true); 
          document.querySelector('textarea#content').value = '';
     })
     .catch( ({response}) => {
          let type = response.data.message.type; 
          let message = response.data.message.content;    
          if ((response.status).toString().indexOf('4') === 0) flash(message, type, true);
          if ((response.status).toString().indexOf('5') === 0) flash(message, type, true);
     }) 
}