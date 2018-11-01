<?php
/**
 * @category   Ficha do Carro
 * @package    FDC
 * @copyright  Copyright (c) 2018
 * @author     Jose Augsuto Freire <jose at procyon dot com dot br>
 * @comment    Geracao de Relatorios em PDF
 * @param      idusu Codigo da Empresa
 * @param      email Email da Empresa
 * @param      idipas Codigo da Passagem
 * @param      logo Caminho + imagem.jpg (Obrigatorio)
 * @param      dirpdf Caminho da Geracao do PDF (Obrigatorio)
 * @param      di Data da Passagem Incial
 * @param      df Data da Passagem Final
 * @param      pi Passagem Incial
 * @param      pf Passagem Final
 * @param      q Quantidade de Registros
 * @param      s Formato do Retorno de Saida JSON/XML
 * @param      tipo Tipo de Documento (Padrão OrcPas para Orçamento, branco para Passagem)
 */
/*************************************************************
### Teste Web ###
http://pro03des.procyon.com.br:3125/wss/NFSe/impRPS.php
?codemp=FL
&codfil=2
&rps=190
&logo=/siare/v01/r56/wss/imagens/logoaudi2017.jpg
&dirpdf=/desen/jose
&url=http://pro03des.procyon.com.br:3125
&pl=siareweb.pl
&tipo=IPM

### Teste Prompt ###
php /siare/v01/r56/wss/NFSe/impRPS.php
-codemp FL
-codfil 2 
-rps 190
-logo /siare/v01/r56/wss/imagens/logoaudi2017.jpg
-dirpdf /desen/jose
-url http://pro03des.procyon.com.br:3125
-pl siareweb.pl
-tipo IPM

php /siare/v01/r56/wss/NFSe/impRPS.php -codemp FL -codfil 2 -rps 190 -logo /siare/v01/r56/wss/imagens/logoaudi2017.jpg -dirpdf /desen/jose
*************************************************************/
error_reporting(E_ALL); //(E_ALL)
ini_set('display_errors', 'on'); //1
ini_set("memory_limit","128M");

################################## Includes ##################################
include_once ("./class/Parametros.class.php");
include_once ("./class/Util.class.php");
//include_once ("./class/JSON.class.php");

################################# Variaveis ##################################
$fimlim = (PHP_SAPI == 'cli' ? "\n" : "<br />");
$msg    = '';
$dirins = 'fdcpdf/';
$dirimg = '';
$dirpdf = '';
$urlsia = '';
$nompdf = '';

## URL de consumo do starweb
$url    = 'http://siare08.procyon.com.br:3125/cgi-bin/siarewebtt.pl/wsimporc';

## Caminho local para busca das imagens
$dirloc = realpath(dirname(__FILE__)) . '/';
$dirloc = str_replace($dirins, '', $dirloc);

$pathig = (isset($param['dirimg']) ? $param['dirimg'] : '');

if (!empty($pathig)) {
   $dirimg = $dirloc.$pathig.'/';
}

################################# Parametros #################################
$Para  = new Parametros();
$param = $Para->getParametro();

## Atribui parametros
$idgpas = (isset($param['idgpas']) ? $param['idgpas'] : '');
$idusu  = (isset($param['idusu'])  ? $param['idusu']  : '');
$email  = (isset($param['email'] ) ? $param['email']  : '');
$idipas = (isset($param['idipas']) ? $param['idipas'] : '');
$di     = (isset($param['di'])     ? $param['di']     : '');
$df     = (isset($param['df'])     ? $param['df']     : '');
$pi     = (isset($param['pi'])     ? $param['pi']     : '');
$pf     = (isset($param['pf'])     ? $param['pf']     : '');
$q      = (isset($param['q'])      ? $param['q']      : '');
$tipo   = (isset($param['t'])      ? $param['t']      : 'OrcPas');

$imagem = (isset($param['logo'])   ? $param['logo']   : '');

## Validacao dos Parametros
if ($idgpas == '' && $idusu == '' && $email == '') {
   $msg .= "Deve ser informado o Identificador do Orçamento/Passagem, ID ou o Email da Empresa.".$fimlim;
} 

if ($tipo == 'OrcPas' && $idipas == '' && $idgpas == '') {
   $msg .= "O Número do Orçamento deve ser informado.".$fimlim;
}

if ($msg != "") {
   echo $msg;
   exit;
}

$url .= "?idgpas=".$idgpas
     .  "&idusu=".$idusu
     .  "&email=".$email
     .  "&idipas=".$idipas
     .  "&di=".$di
     .  "&df=".$df
     .  "&pi=".$pi
     .  "&pf=".$pf
     .  "&q=".$q
     .  "&tipo=".$tipo;

## Consulta servico impRPS para bucar os dados do RPS
$Json   = file_get_contents($url) or die("Erro no WebService");
$Json   = json_decode($Json);
$Dados  = $Json->dados;

//echo '<pre><br/>';
//print_r($Dados);
//echo '</pre><br/>';
//exit;

$fc_Ofi = $Dados->ttfcofi[0];
$fc_Pas = $Dados->ttfccpv;


if (!file_exists($imagem)) {
   $logo = $dirloc.'fdcpdf/images/'. strtolower($imagem).'.jpg';
   
   if (!file_exists($logo)) {
      $logo = $dirloc.'fdcpdf/images/'. strtolower($imagem).'.png';
      
      if (!file_exists($logo)) {
         $logo = '';
      }
   }
}

$AutorPDF  = 'Procyon Assessoria e Sistemas Ltda.';
$ChavesPDF = 'Orçamento, Passagem, Procyon';

for ($x=0;$x < count($fc_Pas);$x++) {
   
   $tipo = $fc_Pas[$x]->situac;
   
   //$tipo = $fc_Pas[$x]->idipas =
   
   $cancelada  = '';
   $TipoTitulo = ($tipo != 'PAS' ? htmlentities('Orçamento') : htmlentities('Passagem'));
   $Titulo     = $TipoTitulo . htmlentities(' Nº ') . $fc_Pas[$x]->idipas; 
   $TituloPDF  = $Titulo;
   $arqret     = ($tipo != 'PAS' ?  'ORC_' : 'PAS_')  . $fc_Pas[$x]->idipas . '_' . $fc_Ofi->idusu ;
   $arqpdf     = $arqret.'.pdf';

   ## Marca d'agua
   if($tipo == 'CAN'){
      $cancelada = '<img class="cancelada" src="cancelada.png">';
      //$cancelada = '<body background="image.jpg" bgproperties="fixed">';
   }

   ## Ativa o buffer de saida do PHP
   ob_start(); 

   $layout = './layout-OrcPas.php';
   //$layout = './layout-'.$tipo.'.php';

   if (file_exists($layout)) {
      include @$layout;
   } else {
      echo 'O Arquivo de layout '.$layout. ' não foi encontrado!';
      exit;
   }

   exit;
   ## Geracao do PDF - Obtém os dados do buffer interno
   $buffer = ob_get_contents();

   ## Descarta o buffer;
   ob_clean(); 

   //$buffer = str_replace($cancelada, '', $buffer);

   /******************************************************************************/
   ## Inclusao da API mpdf
   if (file_exists('../api/mpdf60/mpdf.php')) {
      include_once '../api/mpdf60/mpdf.php';

      $mpdf = new mPDF('C','A4','','',10,10,10,10,5,5);

      ## Parametros mPDF 
      //$mpdf->SetDisplayMode('fullpage');
      //$mpdf->allow_charset_conversion = true; // Ativa a conversão de caracteres
      //$mpdf->charset_in = 'UTF-8';            // Codificação do arquivo

      ## Propriedades do documento PDF 
      $mpdf->SetAuthor($AutorPDF);    // Autor
      $mpdf->SetSubject($Titulo);  // Assunto
      $mpdf->SetTitle($Titulo);    // Titulo
      $mpdf->SetKeywords($ChavesPDF); // Palavras chave
      $mpdf->SetCreator($AutorPDF);   // Criador

      //if ($Rps->Status == '2') {
      //   $mpdf->SetWatermarkImage('cancelada.png', 0.15, 'F');
      //   $mpdf->showWatermarkImage = true;
      //}

      $mpdf->WriteHTML($buffer);

      ## Direciona saida do PDF
      if (PHP_SAPI != 'cli') {
         $mpdf->Output($arqpdf,'I'); // Abre no navegador
      } else {
         //$mpdf->Output($arqpdf,'F'); // Salva em disco
      }
   }
}
/******************************************************************************/
## Forca fechamento do programa
exit(0);
?>
