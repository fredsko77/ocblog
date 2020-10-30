fields = document.querySelectorAll('.contact-form .form-control');

const handleSubmitContact = (form,event) => {
     event.preventDefault();
     alert('Le formulaire a été soumis ! ');
}

fields.forEach(field => { 
     let id = field.id;
     let placeholder = field.placeholder;
     let label = document.querySelector(`label[for=${id}]`);
     field.addEventListener('focus', () => {
          field.addEventListener('keyup', () => {
               label.innerHTML = placeholder;
          }, false);
     }, false);    
     field.addEventListener('focusout', () => {
          let value = field.value; 
          if ( value.length > 0 ) { 
               label.innerHTML = placeholder;
          } else { 
               label.innerHTML = "";
          } 
     }, false); 
});