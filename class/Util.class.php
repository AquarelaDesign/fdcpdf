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
      $ret = strtr($str, $pairs);
      return htmlentities($ret);
   }
    
   public static function formataNumero($strNum) {
      $num = explode(",", $strNum);
      $int = $num[0];

      $achou = strripos($int, ".");

      echo $achou . ' ' . $int . '<br/>';

      if ($achou === false) {
         $dec = $num[1];
         $retNum = $int . "." . $dec;
         echo htmlentities('Não achou ').'<br/>';
      } else {
         $int = str_replace(".",",",$num[0]);
         $retNum = $num[0];
         echo 'Achou em '. $num[0] .'<br/>';
      }

      return number_format(floatval($retNum), 2, ",", ".");
   }

}