<?php
/******************************************************************************
 * Codigo do Programa..: TEMPLATE.CLASS.php                                   *
 * Titulo..............: Gerenciamento de templates                           *
 * Autor...............: Jose Augusto Freire                                  *
 * Data de Criacao.....: 15/10/2015                                           *
 ******************************************************************************/
class Template {
   protected $file;
   
   protected $values = array();
   
   public $dados;
   
   public function __construct($file="") {
      $this->file = $file;
   }
   
   public function setd($key, $value) {
      $this->dados[$key] = $value;
   }
   
   public function set($key, $value) {
      $this->values[$key] = $value;
   }
   
   public function output() {
      if (!file_exists($this->file)) {
         return "Erro ao carregar o arquivo modelo ($this->file).<br />";
      }
      
      $output = file_get_contents($this->file);

      foreach ($this->values as $key => $value) {
//echo $key . " => " . $value . "\n";
         $tagToReplace = "[@$key]";
         $output = str_replace($tagToReplace, $value, $output);
      }
      return $output;
   }
   
   static public function merge($templates, $separator = "\n") {
      $output = "";

      foreach ($templates as $template) {
         $content = (get_class($template) !== "Template")
         ? "Erro, tipo incorreto - modelo esperado."
         : $template->output();
         $output .= $content . $separator;
      }
      return $output;
   }
   
}

?>
