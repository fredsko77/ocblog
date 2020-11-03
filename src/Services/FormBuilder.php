<?php 

namespace App\Services;

use App\Services\Request;

class FormBuilder
{

     public $data = [];

     /**
      * 
      * @param array $data
      */
     public function __construct(array $data = [])
     {
          $this->data = $data;
     }

     /**
      * Start the form
      *
      * @param string $action
      * @param string $method
      * @param boolean $upload
      * @return string
      */
     public function start(string $action,string $onsubmit = "", bool $upload = false, string $method = "POST"):string
     {
          $enctype = $upload === true ?  "enctype='multipart/form-data'" : '';
          $host = (new Request())->server("HTTP_HOST");
          $action = "http://{$host}{$action}"; 
          if ($onsubmit !== "" ) $onsubmit =  "onsubmit='{$onsubmit}'";
          return "<form action='{$action}' method='{$method}' {$enctype} {$onsubmit}>\n\r
                  <ul class='alert' id='error_msg_form'></ul>";           
     }

     /**
      * Generate input form
      *
      * @param string $name
      * @param array $data
      * @param boolean $bootstrap
      * @return string
      */
     public function input(string $name, array $data = [], bool $bootstrap = false):string
     {
          $class = $bootstrap === true ? 'form-control' : "";
          $value = $this->data[$name] ?? '';
          $type = $data['type'] ?? 'text';
          $label = $data['label'] ?? ucfirst($name);
          $input = "<label for='{$name}'>{$label}</label>
                    <input type='{$type}' name='{$name}' id='{$name}' value='{$value}' class='{$class}'> \n\r";
          if ( $bootstrap === true ) {
               return $this->surround($input, 'form-group');
          }
          return $input;
     }

     /**
      * Surround html element
      *
      * @param string $html
      * @param string $class
      * @param string $tag
      * @return string
      */
     public function surround(string $html, string $class = "", string $tag = "div"):string
     {
          return "<{$tag} class='{$class}'>{$html}</{$tag}>";
     }

     /**
      * Generate CRSF token
      *
      * @return string
      */
     public function csrf():string 
     {
          return "<input type='hidden' id='csrf_token' name='csrf_token' value='" . generate_csrf() . "'>";
     }

     /**
      * Generate select form with options
      *
      * @param string $name
      * @param array $options
      * @param boolean $bootstrap
      * @return string
      */
     public function select(string $name, array $options = [], string $label = "" , bool $bootstrap = false):string
     {
          $class = $bootstrap === true ? 'form-select custom-select' : "";
          $option = "<option value='default'> --- Sélectionnez une option --- </option>";
          $label !== "" ? ucfirst($name) : $label; 
          foreach ($options as $key => $opt){
               $selected = array_key_exists($name, $this->data) && $this->data['name'] === $key ? "selected" : "";
               $option .= "<option value='{$key}' $selected>{$opt}</option>";
          }
          $output = "<label for='{$name}'>{$label}</label><select class='{$class}' name='{$name}' id='{$name}'>{$option}<select>";
          if ( $bootstrap === true ) {
               return $this->surround($output, 'form-group');
          }
          return $output;
     }

     /**
      * Generate submit button
      *
      * @param string $value
      * @param string $classes
      * @param boolean $bootstrap
      * @param string $color
      * @return string
      */
     public function submit(string $value = "Envoyer",  string $classes = "primary", bool $bootstrap = true):string
     {
          if ($bootstrap === true) { 
               $classes = "btn btn-{$classes}";
          } else {
               $classes = "{$classes}";
          }
          return "<button type='submit' class='{$classes}'>{$value}</button>";
     }

     public function end():string
     {
          return "</form>";
     }


}