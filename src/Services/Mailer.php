<?php 

namespace App\Services;

use App\Entity\Users;

class Mailer 
{

     public $mailer;
     public $transport;

     public function __construct()
     {
          $this->mailer = require "../config/mail.php";
          $this->request = new Request();
     }

     public function getTransport():\Swift_SmtpTransport
     {
          // Create the Transport
          return (new \Swift_SmtpTransport($this->mailer->smtp, $this->mailer->port, $this->mailer->encryption))
               ->setUsername($this->mailer->credentials->username)
               ->setPassword($this->mailer->credentials->password);
     }

     public function sendConfirmEmail(Users $user) 
     {
          try {
               $mailer = new \Swift_Mailer($this->getTransport());
               $link = 'http://' . $this->request->server("HTTP_HOST") . generate_url('user.confirm', ['s' => $user->getToken()]);
               // Create a message
               $body ="<p>Bienvenu sur <u>Mon Super Blog</u>, <a href='{$link}'>cliquer ici</a> pour confirmer votre compte.</p>";
               $message = $this->setMessage($body, [$user->getEmail()] );
               // Send the message
               $mailer->send($message);
          } catch(\Exception $e) {
               dump($e->getMessage());
          }
          
     }

     public function sendConfirmContact(object $data) 
     {
          // dd($data);
          try {
               $mailer = new \Swift_Mailer($this->getTransport());
               $link = 'http://' . $this->request->server("HTTP_HOST") . generate_url('blog');
               // Create a message
               $body ="
                    <p>
                         Bonjour {$data->name}, 
                         <br/> 
                         <br/> 
                         Nous avons bien reçu votre demande de contact. 
                         <br/> 
                         Notre équipe vous contactera dans les meilleurs délais.
                         <br/> 
                         Vous pouvez toujours vous tenir au courant de nos dernières actualités sur notre <a href='{$link}'> blog </a/>.
                         <br/> 
                         <br/>                          
                         Voici un récapitulatif de votre demande: <br/> 
                         - nom : {$data->name} <br/> 
                         - email : {$data->email} <br/> 
                         - object : {$data->subject} <br/> 
                         - message : {$data->message}.  <br/>                         
                         <br/> 
                         <br/> 
                         Cordialement, 
                         <br/> 
                         <br/> 
                         L'équipe Mon Super Blog
                    </p>
               ";
               $message = $this->setMessage($body, [$data->email] );
               // Send the message
               $mailer->send($message);
               return true;
          } catch(\Exception $e) {
               dump($e->getMessage());
          }
     }

     public function setMessage(string $body, array $to, array $cc = [], array $bcc = []):\Swift_Message 
     {
          $message =  (new \Swift_Message('Inscription sur Mon Super Blog'))
          ->setFrom(['testwamp08@gmail.com' => "Mon Super Blog"])
          ->setTo($to);
          if ( count($cc) > 0 ) $message->setCc($cc);
          if ( count($bcc) > 0 ) $message->setBCc($bcc);
          $message->setBody($body);
          $message->setContentType('text/html');
          return $message;
     }

}