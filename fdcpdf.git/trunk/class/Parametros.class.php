<?php

class Parametros {
   
   /**
    * @var array
    */
   public $param = array();
   
   /**
    * @var string
    */
   public $dirweb = '';

   /**
    * @return array
    */
    public function getParametro() {
      if (PHP_SAPI != 'cli') {
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $conteudo = $_POST;
         } elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $conteudo = $_GET;
         } else {
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
            die('{"msg": "Metodo nao encontrado."}');
         }
      
         $prefix = (((!empty($_SERVER['HTTPS']) &&
                  $_SERVER['HTTPS']!=='off') ||
                  $_SERVER['SERVER_PORT']==443) ? 'https://' : 'http://' );
      
         $dirweb  = $prefix.$_SERVER['HTTP_HOST'];
      } else {
         $conteudo = param($GLOBALS['argv']);
         $dirweb   = '';
      }

      return $conteudo;
   }

   /**
    * @param array $par
    * @return array
    */
    private function param($par = array()) {
      $campo = '';
      $valor = '';
      $arr   = array();
      for ($i=0;$i < count($par);$i++) {
         if (substr($par[$i],0,1) == '-') {
            $campo = substr($par[$i],1,1);
         } else {
            $valor = substr($par[$i],0);
            if (!empty($campo)) { $arr[$campo] = $valor; }
         }
      }
      return $arr;
   }
}