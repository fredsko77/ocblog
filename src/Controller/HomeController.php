<?php 

namespace App\Controller;

use App\Controller\AbstractController;

class HomeController extends AbstractController
{
     public function index()
     {
          $title = "Page d'acceuil";
          return $this->view("home/home", compact('title'));
     }

     public function about()
     {
          $title = "A propos";
          return $this->view("home/about", compact('title'));
     }
     
     public function contact()
     {
          $title = "Nous contacter";
          return $this->view("home/contact", compact('title'));          
     }
}