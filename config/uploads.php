<?php 

return (object) [
     // Type de fichier accepté 
     'file_accepted' => [ 
          'image' =>  ['jpg', 'jpeg', 'svg', 'gif', 'png'],
          'pdf' => 'pdf'
     ],
     'max_size_accepted' => '10', // en MB
     'directory' => '../public/uploads' // répertoire d'upload de fichiers
];