<?php

class Valida {
   
   ## Verifica modulos instalados
   public function validaExt() {
      $msg = '';
      $modulos = array('gd','soap','mbstring','mcrypt','xml','zip');
      for ($i=0;$i < count($modulos);$i++) {
         $msg .= (extension_loaded($modulos[$i]) ? '' : $modulos[$i].', ');
         //echo $modulos[$i].': ', extension_loaded($modulos[$i]) ? 'ok' : 'missing', $fimlim;
      }

      if (!empty($msg)) {
         return 'Erro ao validar extenção do PHP: '. $msg;
      } else {
         return $msg;
      }
   }
}