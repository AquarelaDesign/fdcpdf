<?php
/**
 * @category   Ficha do Carro
 * @package    FDC
 * @copyright  Copyright (c) 2018
 * @author     Jose Augsuto Freire <jose at procyon dot com dot br>
 * @comment    Geração de documentos em PDF baseados na Ficha do Carro (http://www.fichadocarro.com.br / https://github.com/AquarelaDesign/fdcpdf)
 * @param      idgpas Código Identificador da Passagem (Obrigatório quando não for informado idusu ou email da empresa)
 * @param      idusu Código Identificador da Empresa (Obrigatório quando não for informado idgpas ou email da empresa)
 * @param      email Email da Empresa (Obrigatório quando não for informado idgpas ou idusu da empresa)
 * @param      idipas Código da Passagem (Opcional quando informado parametros de filtro)
 * @param      logo Imagem da Logomarca Previamente enviada (Informado se a imagem já se encontrar no servidor)
 * @param      di Data da Passagem Incial (Data Inicial para Filtro de Pesquisa)
 * @param      df Data da Passagem Final (Data Final para Filtro de Pesquisa)
 * @param      pi Passagem Incial (Passagem/Orçamento Inicial para Filtro de Pesquisa)
 * @param      pf Passagem Final (Passagem/Orçamento Final para Filtro de Pesquisa)
 * @param      q Quantidade de Registros (Quantidade de Registros que será retornado quando aplicado filtro)
 * @param      v view Formato que será apresentado PDF/HTML (Padrão PDF)
 * @param      m modo de visualizacao do PDF - [W] fullwidth, [F] fullpage (Padrão 'fullpage')
 * @param      e Envia Email [S] Sim (Mostra e Envia) / [E] Envia / '' Somente Mostra (Padrão Somente Mostra)
 * @param      tipo Tipo de Documento [OrcPas] Orçamento / Passagem (Padrão 'OrcPas')
 * @param      dev Modo desenvolvimento ['D'] Desenvolvimento / [''] Produção (Padrão [''])
 */

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL);
ini_set('display_errors', 'on');
ini_set("memory_limit","128M");
date_default_timezone_set('America/Sao_Paulo');

################################## Includes ##################################
include_once ("./class/Parametros.class.php");
include_once ("./class/Util.class.php");
//include_once ("./class/JSON.class.php");

################################# Variaveis ##################################
$fimlim = (PHP_SAPI == 'cli' ? "\n" : "<br />");
$msg    = '';
$dirins = 'fdcpdf/';
$dirimg = '';
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
$view   = (isset($param['v'])      ? $param['v']      : '');
$q      = (isset($param['q'])      ? $param['q']      : '');
$modo   = (isset($param['m'])      ? $param['m']      : '');
$tipo   = (isset($param['t'])      ? $param['t']      : 'OrcPas');

$enviarEmail = (isset($param['e']) ? $param['e']      : '');

$imagem = (isset($param['logo'])   ? $param['logo']   : '');

$DevProd = (isset($param['dev'])   ? $param['dev']    : '');
//$DevProd = 'D';

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

## Consulta servico para buscar os dados
$Json   = file_get_contents($url) or die("Erro no WebService");
$Json   = json_decode($Json);
$Dados  = $Json->dados;

//echo '<pre><br/>';
//print_r($Dados);
//echo '</pre><br/>';
//exit;

if (property_exists($Dados, 'ttfcofi')) {
   $fc_Ofi = $Dados->ttfcofi[0];
} else {
   $fc_Ofi = NULL;
}
	
if (property_exists($Dados, 'ttfccpv')) {
   $fc_Pas = $Dados->ttfccpv;
} else {
   $fc_Pas = NULL;
}

if ($fc_Ofi == NULL || $fc_Pas == NULL) {
	echo '<b>DADOS INSUFICIENTES PARA GERAÇÃO DO PDF</b>';
}

if (!file_exists($imagem)) {
   //$logo = $dirloc.'fdcpdf/images/'. strtolower($imagem).'.jpg';
   $logo = '';
}

$QRCode = "Ficha do Carro\nhttp://l.ead.me/baz67L";

$AutorPDF  = 'Procyon Assessoria e Sistemas Ltda.';
$ChavesPDF = 'Orçamento, Passagem, Procyon, Ficha, Carro';

for ($x=0;$x < count($fc_Pas);$x++) {
   
   if (property_exists($fc_Pas[$x], 'ttfcspv')) {
      $fc_Ser = $fc_Pas[$x]->ttfcspv;
   } else {
      $fc_Ser = NULL;
   }

   if (property_exists($fc_Pas[$x], 'ttfcppv')) {
      $fc_Pec = $fc_Pas[$x]->ttfcppv;
   } else {
      $fc_Pec = NULL;
   }

   if (property_exists($fc_Pas[$x], 'ttfcusu')) {
      $fc_Usu = $fc_Pas[$x]->ttfcusu[0];
   } else {
      $fc_Usu = NULL;
   }

   if (property_exists($fc_Pas[$x], 'ttfcvei')) {
      $fc_Vei = $fc_Pas[$x]->ttfcvei[0];
   } else {
      $fc_Vei = NULL;
   }

   if (property_exists($fc_Pas[$x], 'Totais')) {
      $Totais = $fc_Pas[$x]->Totais[0];
   } else {
      $Totais = NULL;
   }

   $tipo = $fc_Pas[$x]->situac;
   
   $cancelada  = '';
   $TipoTitulo = ($tipo !== 'PAS' ? 'Orçamento' : 'Passagem');
   $Titulo     = $TipoTitulo . ' ' . $fc_Pas[$x]->idipas; 
   $TituloPDF  = $Titulo . ' (' . strtolower($fc_Ofi->e_mail) . ')';
   $arqret     = ($tipo != 'PAS' ?  'ORC_' : 'PAS_')  . $fc_Pas[$x]->idipas . '_' . $fc_Ofi->idusu ;
   $arqpdf     = str_replace('/', '_', $arqret).'.pdf';

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
   
   if ($DevProd == 'D') {
      $Email_Empresa = 'fdc@fdc.procyon.com.br';
      $Nome_Empresa  = 'Ficha do Carro';
      $Email_Cliente = 'jose@procyon.com.br';
      $Nome_Cliente  = 'Jose Augusto Freire'; 
   } else {
      $Email_Empresa = strtolower($fc_Ofi->e_mail);
      $Nome_Empresa  = strtoupper($fc_Ofi->nome);
      $Email_Cliente = strtolower($fc_Usu->e_mail);
      $Nome_Cliente  = Util::subhex($fc_Usu->nome); 
   }
   
   $TextoHTML   = 'Caro Sr(a) ' . $Nome_Cliente . ', <br/><br/>     Segue em anexo '
                . ($tipo != 'PAS' ? 'o orcamento ' : 'a passagem ')
                . '<b>' . $fc_Pas[$x]->idipas . '</b><br/><br/>'
                . 'Atenciosamente<br/><br/>' . $Nome_Empresa;
   
   
   $TextoTXT    = 'Caro Sr(a) ' . $Nome_Cliente . ', \n\n     Segue em anexo '
                . ($tipo != 'PAS' ? 'o orcamento ' : 'a passagem ')
                . $fc_Pas[$x]->idipas . '\n\n'
                . 'Atenciosamente\n\n' . $Nome_Empresa;
   
   if ($view !== 'B') {
      ## Geracao do PDF - Obtém os dados do buffer interno
      $buffer = ob_get_contents();

      ## Descarta o buffer;
      ob_clean(); 

      //$buffer = str_replace($cancelada, '', $buffer);

      /******************************************************************************/
      if (file_exists(__DIR__.'/vendor/autoload.php')) {
         require __DIR__.'/vendor/autoload.php';

         try {
            $html2pdf = new Html2Pdf('P','A4','fr');
            $html2pdf->setDefaultFont('Arial');
            
            if ($modo == 'F') {
               $html2pdf->pdf->SetDisplayMode('fullpage');
            } elseif ($modo == 'W') {
               $html2pdf->pdf->SetDisplayMode('fullwidth');
            } else {
               $html2pdf->pdf->SetDisplayMode('real');
            }
            
            ## Propriedades do documento PDF 
            $html2pdf->pdf->SetAuthor($AutorPDF);    // Autor
            $html2pdf->pdf->SetSubject($TituloPDF);  // Assunto
            $html2pdf->pdf->SetTitle($TituloPDF);    // Titulo
            $html2pdf->pdf->SetKeywords($ChavesPDF); // Palavras chave
            
            $html2pdf->writeHTML($buffer);
            
            ## Enviar como anexo por email
            
            if ($enviarEmail != '') {
               if ($enviarEmail == 'S') {
                  $html2pdf->output(__DIR__.'/pdftmp/'.$arqpdf,'FI');
               } else {
                  $html2pdf->output(__DIR__.'/pdftmp/'.$arqpdf,'F');
               }

               $mail = new PHPMailer(true);                             // Passing `true` enables exceptions
               try {
                  //Server settings
                  $mail->SMTPDebug = 0;                                 // Enable verbose debug output (2) Debug
                  $mail->isSMTP();                                      // Set mailer to use SMTP
                  $mail->Host = 'mx1.hostinger.com.br';                 // Specify main and backup SMTP servers
                  $mail->SMTPAuth = true;                               // Enable SMTP authentication
                  $mail->Username = 'fdc@fdc.procyon.com.br';           // SMTP username
                  $mail->Password = 'Pr0c10n';                          // SMTP password
                  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                  $mail->Port = 587;                                    // TCP port to connect to

                  //Recipients
                  $mail->setFrom($Email_Empresa, $Nome_Empresa);        // Empresa Emisora
                  $mail->addAddress($Email_Cliente, $Nome_Cliente);     // Destinatario
                  //$mail->addAddress('ellen@example.com');             // Name is optional
                  $mail->addReplyTo($Email_Empresa, $Nome_Empresa);     // Empresa Emisora
                  $mail->addBCC('tanabe@procyon.com.br');
                  $mail->addBCC('sandrop@procyon.com.br');
                  $mail->addBCC('jose@procyon.com.br');
                  //$mail->addBCC('bcc@example.com');

                  //Attachments
                  if (file_exists(__DIR__.'/pdftmp/'.$arqpdf)) {
                     $mail->addAttachment(__DIR__.'/pdftmp/'.$arqpdf);  // Add attachments
                  }
                  //$mail->addAttachment('/var/tmp/file.tar.gz');       // Add attachments
                  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');  // Optional name

                  //Content
                  $mail->isHTML(true);                                  // Set email format to HTML
                  $mail->Subject = $TituloPDF;
                  
                  //$mail->Body    = 'Caro Fulano, segue em anexo o orçamento <b>xxxxx</b> solicitado.';
                  //$mail->AltBody = 'Caro Fulano, segue em anexo o orçamento xxxxx solicitado.';
                  
                  $mail->Body    = $TextoHTML;
                  //$mail->AltBody = $TextoTXT;
                  
                  ## Confirmacao de recebimento (Teste)
                  //$mail->AddCustomHeader( 'X-pmrqc: 1' );
                  //$mail->AddCustomHeader( "X-Confirm-Reading-To: " . $Email_Empresa );
                  //$mail->AddCustomHeader( "Return-receipt-to: " . $Email_Empresa );
                  //$mail->AddCustomHeader( "Disposition-Notification-To:<" . $Email_Empresa . ">");
                  //$mail->ConfirmReadingTo = $Email_Empresa;

                  $mail->send();
                  //echo 'Message has been sent';
               } catch (Exception $e) {
                  echo 'O Email não pode ser enviado. Erro: ', $mail->ErrorInfo;
               }
               if (file_exists(__DIR__.'/pdftmp/'.$arqpdf)) {
                  unlink(__DIR__.'/pdftmp/'.$arqpdf);
               }
               
            } else {
               $html2pdf->output($arqpdf,'I');
            }
            
         } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
         }
      }
   }
}

/******************************************************************************/
## Forca fechamento do programa
exit(0);
?>
 