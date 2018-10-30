<?php

class JSON {

   private $enclist = 'UTF-8,ASCII,ISO-8859-1,ISO-8859-2,ISO-8859-3,ISO-8859-4,ISO-8859-5'
                    . 'ISO-8859-6,ISO-8859-7,ISO-8859-8,ISO-8859-9,ISO-8859-10'
                    . 'ISO-8859-13,ISO-8859-14,ISO-8859-15,ISO-8859-16'
                    . 'Windows-1251,Windows-1252,Windows-1254';

   public function convert_utf8($conteudo) {
      $encoding = mb_detect_encoding($conteudo, $this->enclist);
      
      if($encoding != 'UTF-8') {
         $conteudo = mb_convert_encoding($conteudo, 'UTF-8', $encoding);
         $par = json_decode($conteudo);
      } else {
         $par = json_decode(utf8_encode($conteudo));
      }
      
      return $par;
   }

   public function json_validate($string) {
      // decode the JSON data
      $result = json_decode($string);
   
      // switch and check possible JSON errors
      switch (json_last_error()) {
         case JSON_ERROR_NONE:
            $error = ''; // JSON is valid // No error has occurred
            break;
         case JSON_ERROR_DEPTH:
            $error = 'A profundidade máxima da pilha foi excedida.';
            break;
         case JSON_ERROR_STATE_MISMATCH:
            $error = 'JSON inválido ou malformado.';
            break;
         case JSON_ERROR_CTRL_CHAR:
            $error = 'Erro de caractere de controle, possivelmente codificado incorretamente.';
            break;
         case JSON_ERROR_SYNTAX:
            $error = 'Erro de sintaxe, JSON malformado.';
            break;
         // PHP >= 5.3.3
         case JSON_ERROR_UTF8:
            $error = 'Caracteres UTF-8 malformados, possivelmente codificados incorretamente.';
            break;
         // PHP >= 5.5.0
         case JSON_ERROR_RECURSION:
            $error = 'Uma ou mais referências recursivas no valor a ser codificado.';
            break;
         // PHP >= 5.5.0
         case JSON_ERROR_INF_OR_NAN:
            $error = 'Um ou mais valores NAN ou INF no valor a ser codificado.';
            break;
         case JSON_ERROR_UNSUPPORTED_TYPE:
            $error = 'Um valor de um tipo que não pode ser codificado foi fornecido.';
            break;
         default:
            $error = 'Ocorreu um erro JSON desconhecido.';
            break;
      }
   
      if ($error !== '') {
         // throw the Exception or exit // or whatever :)
         return $error;
      }
   
      // everything is OK
      return $result;
   }
   

}