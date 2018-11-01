<?php

class Util {

   public static function mask($val, $mask){
      $maskared = '';
      $k = 0;
      for ($i = 0; $i<=strlen($mask)-1; $i++) {
         if ($mask[$i] == '#') {
            if (isset($val[$k]))
               $maskared .= $val[$k++];
         } else {
            if (isset($mask[$i])) {
               $maskared .= $mask[$i];
            }
         }
      }
      return $maskared;
   }

   public static function subhex($str) {
      $pairs = array(
            "\xC2" => "",
            "\x8D" => "",
            "\x8C" => "",
            "\x86" => "",
      );
      return strtr($str, $pairs);
   }
    
}