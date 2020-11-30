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
     public function start(string $action = "",string $onsubmit = "", bool $upload = false,array $attr = [], string $method = "POST") :string
     {
          $enctype = $upload === true ?  "enctype='multipart/form-data'" : '';
          if ($onsubmit !== "" ) $onsubmit =  "onsubmit='{$onsubmit}'";
          return "<form action='{$action}' method='{$method}' {$enctype} {$this->attr($attr)} {$onsubmit}>";           
     }

     /**
      * Generate textarea
      *
      * @param string $name
      * @param array $data
      * @param boolean $bootstrap
      * @return string
      */
     public function textarea(string $name, array $data = [], bool $bootstrap = false):string
     {
          $class = $bootstrap === true ? 'form-control' : "";
          $value = $this->data[$name] ?? '';
          $label = $data['label'] !== null ? "<label for='{$name}'>{$data['label']}</label>" : "";
          $attr = array_key_exists('attr', $data) ? $this->attr($data['attr']) : '';
          $value = array_key_exists('attr', $data) && array_key_exists('value', $data['attr']) ? $data['attr']['value'] : '';
          $textarea =    "{$label}
                         <textarea name='{$name}' class='{$class}' id='{$name}' $attr>{$value}</textarea>";
          if ( $bootstrap === true ) {
               return $this->surround($textarea, 'form-group');
          }
          return $textarea;
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
          $input = '';
          $class = $bootstrap === true ? 'form-control' : "";
          $value = $this->data[$name] ?? '';
          $type = $data['type'] ?? 'text';
          $label = $data['label'];
          $attr = array_key_exists('attr', $data) ? $this->attr($data['attr']) : '';
          $value = array_key_exists('attr', $data) && array_key_exists('value', $data['attr']) ? $data['attr']['value'] : '';
          if ( $label !== null ) $input = "<label for=\"{$name}\">{$label}</label> \n\r";
          $input .= "<input type=\"{$type}\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" class=\"{$class}\" {$attr}> \n\r";
          if ( $bootstrap === true ) {
               return $this->surround($input, 'form-group');
          }
          return $input;
     }

     /**
      * Generate input type file
      *
      * @param string $name
      * @param string $label
      * @param boolean $required
      * @param boolean $multiple
      * @return string
      */
     public function file(string $name, string $label, array $attr = [] ,bool $required = false, bool $multiple = false):string 
     {
          $required = $required ? 'required' : '';
          $multiple = $multiple ? 'multiple' : '';
          $attr = count($attr) > 0 ? $this->attr($attr) : '';
          return    "<div class=\"mb-3 mt-2 custom-file\">
                         <input type=\"file\" class=\"custom-file-input\" name=\"{$name}\" id=\"{$name}\" {$attr} {$required} {$multiple}>
                         <label class=\"custom-file-label\" for=\"{$name}\">{$label}...</label>
                         <div class=\"invalid-feedback\">Example invalid custom file feedback</div>
                    </div>";
     }

     /**
      * Generate attributes to inputs
      *
      * @param array $data
      * @return string
      */
     public function attr(array $data = []):string
     {
          $str = '';
          foreach ( $data as $key => $value ) {
               $value = str_replace("'", "&#39;", $value);
               $str .= "{$key}=\"{$value}\" ";
          }
          return $str;
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
          return "<{$tag} class=\"{$class}\">\r\n{$html}\r\n</{$tag}>";
     }

     /**
      * Generate CRSF token
      *
      * @return string
      */
     public function csrf():string 
     {
          return "<input type=\"hidden\" id=\"csrf_token\" name=\"csrf_token\" value=\"" . generate_csrf() . "\">";
     }

     /**
      * Generate select form with options
      *
      * @param string $name
      * @param array $options
      * @param boolean $bootstrap
      * @return string
      */
     public function select(string $name, array $options = [], $label = "" , bool $default = true, bool $bootstrap = false):string
     {
          $class = $bootstrap === true ? 'form-select custom-select' : "";
          $option = $default === true ? "<option value=\"default\"> --- Sélectionnez une option --- </option> \r\n" : "" ;
          $label = $label !== null ? "<label for=\"{$name}\">{$label}</label>" : "";
          foreach ($options as $key => $opt){
               $selected = array_key_exists($name, $this->data) && $this->data[$name] === (string) $key ? "selected" : "";
               $option .= "<option value=\"{$key}\" $selected>{$opt}</option>\r\n";
          }
          $output = "{$label}\r\n <select class=\"{$class}\" name=\"{$name}\" id=\"{$name}\"> \r\n {$option} <select>";
          if ( $bootstrap === true ) {
               return $this->surround($output, 'form-group');
          }
          return $output;
     }
     
     /**
      * Undocumented function
      * Unfinished function
      * @param string $name
      * @param array $data
      * @param string $class
      * @return void
      */
     public function choice(string $name, array $data = [], string $class = '')
     {
          $type = $data['type'] ?? 'radio';
          $label = $data['label'] ?? '';
          $value = $data['value'] ?? '';
          $checked = array_key_exists($value, $this->data) ? 'checked' : '';
          return "<div class='form-check {$class}'>
                    <input name='{$name}' type='{$type}' class='form-check-input' id='{$name}{$value}' {$checked} value='{$value}'>
                    <label class='form-check-label' for='{$name}{$value}'>{$label}</label>
               </div>";
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
          return "<button type=\"submit\" class=\"{$classes}\">{$value}</button>";
     }

     /**
      * End of form
      *
      * @return string
      */
     public function end():string
     {
          return "</form>";
     }


}