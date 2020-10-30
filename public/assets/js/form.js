const getValues = selector => {
     let object = {};
     elements = document.querySelectorAll(selector);
     elements.forEach(element => {
          object[element.name] = element.value;
     });
     return object;
}

const setErrorMessages = (type, messages) => {
     element = document.querySelector('#error_msg_form');
     element.classList.remove("alert-danger", "alert-success", "alert-warning", "alert-primary");
     element.classList.add(`alert-${type}`);
     element.innerHTML = messages;
     return;
}