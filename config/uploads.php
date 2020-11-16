<?php 

return (object) [
     'file_accepted' => [ 
          'image' =>  ['jpg', 'jpeg', 'svg', 'gif', 'png'],
          'pdf' => 'pdf'
     ],
     'max_size_accepted' => '10', // en MB
     'directory' => '../public/uploads'
];