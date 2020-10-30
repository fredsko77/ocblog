/**
* Template Name: 
* Template URL: 
* Author: 
* License: 
*/
!(function($) {
     "use strict";

})(jQuery);

const switchTabs = (elt, e) => {
     e.preventDefault();
     let active = 'active';
     let hidden = 'hidden';
     let current = document.querySelector('li.active');
     let sections = document.querySelectorAll('[data-target]');
     let target = elt.dataset.goto;
     let parentNode = elt.parentNode.tagName === "DIV" ? document.querySelector("li a[data-goto=" + target + "]").parentNode : elt.parentNode;
     sections.forEach(element => {
          let section = element.dataset.target;
          if ( section === target ) {
               element.classList.contains(hidden) ? element.classList.remove(hidden) : null;
          } else {
               element.classList.contains(hidden) ? null : element.classList.add(hidden) ;
          }
     });
     current.classList.remove(active);
     parentNode.classList.add(active);
}

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

const setHTMLTitle = title => {
     console.warn(title);
     document.title = title ;
     //=== "" || title === null ? title : "Mon super blog";
}