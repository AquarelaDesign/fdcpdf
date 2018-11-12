<?PHP

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

//echo '<pre><br/>';
//print_r($fc_Vei);
//echo '</pre><br/>';
//exit;


$Titulo_01 = htmlentities(strtoupper($fc_Ofi->nome));
$Titulo_02 = Util::mask(strval($fc_Ofi->cgccpf),"##.###.###/####-##");
$Titulo_03 = htmlentities(strtolower($fc_Ofi->fone));
$Titulo_04 = htmlentities(strtolower($fc_Ofi->e_mail));

function formataNumero($strNum) {
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

?>
<!-- Inicio do HTML -->

<!-- Inclui pagina de estilos -->
<link href="css/OrcPas.css" rel="stylesheet" type="text/css"/>

<!-- Tabela Principal -->
<table border="0" cellpadding="0" cellspacing="0" align="center" width="900" height="1200">
   <tr>
      <td valign="top" align="center">

         <!-- Inicio Cabecalho -->
         <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
               <td width="9%" valign="middle" align="center" style="height:40; width:180; padding:4px; border: #000000 1px solid;">
                  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                        <td width="9%" valign="middle" align="center" style="height:110; width:150; padding:4px;">
                           <div style="padding: 2px; background-color:white">
                              <img src="<?php echo (!empty($logo) ? $logo : 'images/siare-logo.png') ?>" height="100" border="0">
                           </div>
                        </td>
                        <td align="center" style="height:140; width:300; padding:4px;">
                           <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                 <td colspan="2" height="25" align="center">
                                    <span style="font-family:Verdana; font-size:18">
                                       <b><?php echo $Titulo_01 ?></b>
                                    </span>
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="2" height="25" align="center">
                                    <span style="font-family:Verdana; font-size:14">
                                       <b><?php echo $Titulo_02 ?></b>
                                    </span>
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="2" height="25" align="center">
                                    <span style="font-family:Verdana; font-size:14">
                                       <b><?php echo $Titulo_03 ?></b>
                                    </span>
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="2" height="25" align="center">
                                    <span style="font-family:Verdana; font-size:10">
                                       <?php echo $Titulo_04 ?>
                                    </span>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
               </td>
               <td valign="top" style="height:140; width:180; border-top: #000000 1px solid; border-right: #000000 1px solid; border-bottom: #000000 1px solid;">

                  <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                     <tr>
                        <td colspan="2" height="25" align="center" class="titulo" bgcolor="#FFFFEA">
                           <?php echo 'DADOS ' . ($tipo == 'OrcPas' ? 'DO '.htmlentities('ORÇAMENTO')  : 'DA PASSAGEM') ?>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2" class="titulo" align="center" height="80"
                            style="border-top: #000000 1px solid; border-right: #000000 1px solid; font-size: 28px;">
                           <b><?php echo $fc_Pas[$x]->idipas ?></b>
                        </td>
                     </tr>
                     <tr>
                        <td width="50%" class="legenda" style="border-top: #000000 1px solid; border-right: #000000 1px solid;">
                           Data:
                        </td>
                        <td width="50%" class="legenda" style="border-top: #000000 1px solid"; border-right: #000000 0px solid;>
                           Andamento:
                        </td>
                     </tr>
                     <tr>
                        <td class="campo" align="center">
                           <?php echo date('d/m/Y',strtotime($fc_Pas[$x]->dtpsg)) ?>
                        </td>
                        <td class="campo" align="center" style="border-left: #000000 1px solid;border-right: #000000 0px solid;">
                           <!--?php echo (isset($NFSe->HoraRecebimento) ? $NFSe->HoraRecebimento : "") ?-->
                        </td>
                     </tr>
                  </table>

               </td>
            </tr>
         </table>
         <!-- Fim Cabecalho -->

         <!-- Inicio Linha em Branco -->
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
               <td height="10" style="font-size: 10px;">
                  &nbsp;
               </td>
            </tr>
         </table>
         <!-- Fim Linha em Branco -->

         <!-- Inicio Dados Prestador -->
         <table width="100%" border="1" cellpadding="0" cellspacing="0">
            <tr>
               <td height="25" align="center" bgcolor="#FFFFEA" class="titulo" style="border-bottom: #000000 1px solid">
                  PRESTADOR DO SERVI&Ccedil;O
               </td>
            </tr>
            <tr>
               <td>
                  <table width="100%" border="0" cellpadding="3" cellspacing="2" >
                     <tr>
                        <td width="14%" class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           NOME:
                        </td>
                        <td class="campo" align="left" style="border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                           <?php echo Util::subhex($fc_Ofi->nome) ?>
                        </td>
                        <td width="10%" class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           CNPJ:
                        </td>
                        <td width="20%" class="campo" align="left" style="border-bottom: #000000 1px solid">
                           <?php echo Util::mask(strval($fc_Ofi->cgccpf),"##.###.###/####-##") ?>
                        </td>
                     </tr>
                     <tr>
                        <td class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           ENDERE&Ccedil;O:
                        </td>
                        <td class="campo" align="left" style="border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                           <?php echo Util::subhex($fc_Ofi->endrua) ?>
                        </td>
                        <td class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           N&ordm;
                        </td>
                        <td class="campo" align="left" style="border-bottom: #000000 1px solid">
                           <?php echo Util::subhex($fc_Ofi->endnum) ?>
                        </td>
                     </tr>
                     <tr>
                        <td class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           BAIRRO:
                        </td>
                        <td class="campo" align="left" style="border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                           <?php echo Util::subhex($fc_Ofi->bairro) ?>
                        </td>
                        <td class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           CIDADE/UF
                        </td>
                        <td class="campo" align="left" style="border-bottom: #000000 1px solid">
                           <?php echo Util::subhex($fc_Ofi->cidade . "/" . $fc_Ofi->uf) ?>
                        </td>
                     </tr>
                     <tr>
                        <td class="legenda" align="right" style="border-right: #000000 1px dotted">
                           COMPLEMENTO:
                        </td>
                        <td class="campo" align="left" style="border-right: #000000 1px solid">
                           
                        </td>
                        <td class="legenda" align="right" style="border-right: #000000 1px dotted">
                           CEP:
                        </td>
                        <td class="campo" align="left">
                            <?php echo Util::mask(strval($fc_Ofi->cep),"#####-###") ?>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
         <!-- Fim Dados Prestador -->

         <!-- Inicio Dados Tomador -->
         <?php if ($fc_Usu !== NULL) { ?>
         
         <!-- Inicio Linha em Branco -->
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
               <td height="10" style="font-size: 10px;">
                  &nbsp;
               </td>
            </tr>
         </table>
         
         <table width="100%" border="1" cellpadding="0" cellspacing="0">
            <tr>
               <td height="25" align="center" bgcolor="#FFFFEA" class="titulo" style="border-bottom: #000000 1px solid">
                  TOMADOR DO SERVI&Ccedil;O
               </td>
            </tr>
            <tr>
               <td>
                  <table width="100%" border="0" cellpadding="3" cellspacing="2" >
                     <tr>
                        <td width="14%" class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           NOME:
                        </td>
                        <td class="campo" align="left" style="border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                           <?php echo Util::subhex($fc_Usu->nome) ?>
                        </td>
                        <td width="10%" class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           CPF/CNPJ:
                        </td>
                        <td width="20%" class="campo" align="left" style="border-bottom: #000000 1px solid">
                           <?php echo (strlen($fc_Usu->cgccpf) >= 14 ? 
                           Util::mask(strval($fc_Usu->cgccpf),"##.###.###/####-##") : 
                           Util::mask(strval($fc_Usu->cgccpf),"###.###.###-##" )) ?>
                        </td>
                     </tr>
                     <tr>
                        <td class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           ENDERE&Ccedil;O:
                        </td>
                        <td class="campo" align="left" style="border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                           <?php echo Util::subhex($fc_Usu->endrua) ?>
                        </td>
                        <td class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           N&ordm;
                        </td>
                        <td class="campo" align="left" style="border-bottom: #000000 1px solid">
                           <?php echo Util::subhex($fc_Usu->endnum) ?>
                        </td>
                     </tr>
                     <tr>
                        <td class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           BAIRRO:
                        </td>
                        <td class="campo" align="left" style="border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                           <?php echo Util::subhex($fc_Usu->bairro) ?>
                        </td>
                        <td class="legenda" align="right" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           CIDADE/UF
                        </td>
                        <td class="campo" align="left" style="border-bottom: #000000 1px solid">
                           <?php echo Util::subhex($fc_Usu->cidade . "/" . $fc_Usu->uf) ?>
                        </td>
                     </tr>
                     <tr>
                        <td class="legenda" align="right" style="border-right: #000000 1px dotted">
                           COMPLEMENTO:
                        </td>
                        <td class="campo" align="left" style="border-right: #000000 1px solid">
                           
                        </td>
                        <td class="legenda" align="right" style="border-right: #000000 1px dotted">
                           CEP:
                        </td>
                        <td class="campo" align="left">
                            <?php echo Util::mask(strval($fc_Usu->cep),"#####-###") ?>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
         </table>
         
         <!-- Fim Dados Tomador -->
         
         <?php } ?>
         <!-- Fim Linha em Branco -->

         <!-- Inicio Descricao dos Itens Servicos -->
         <?php if ($fc_Ser !== NULL) { ?>

         <!-- Inicio Linha em Branco -->
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
               <td height="10" style="font-size: 10px;">
                  &nbsp;
               </td>
            </tr>
         </table>
         
         <table class="itens" width="100%" border="1" cellpadding="0" cellspacing="0">
            <tr>
               <td height="22" align="center" bgcolor="#FFFFEA" class="titulo">
                  DESCRI&Ccedil;&Atilde;O DOS SERVI&Ccedil;OS
               </td>
            </tr>
            <tr>
               <td valign="top">
                  <table width="100%" border="0" cellpadding="1" cellspacing="2">
                     <tr>
                        <td width="6%" align="left" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           Codigo
                        </td>
                        <td align="left" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           Servi&ccedil;o
                        </td>
                        <td width="7%" align="center" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           Quant
                        </td>
                        <td width="8%" align="center" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           Vlr.Unit.
                        </td>
                        <!--td width="8%" align="center" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           Desc.
                        </td>
                        <td width="8%" align="center" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid">
                           Valor
                        </td-->
                     </tr>
                     
                     <?php
                     foreach ($fc_Ser as $item) {
                        $it  = '<tr>';
                        $it .=    '<td class="item" align="left" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">';
                        $it .=       $item->codser;
                        $it .=    '</td>';
                        $it .=    '<td class="item" align="left" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted; text-align="left">';
                        $it .=      Util::subhex($item->descri);
                        $it .=    '</td>';
                        $it .=    '<td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">';
                        $it .=       $item->quant;
                        //$it .=       number_format(floatval($item->Quantidade), 2, ",", ".");
                        $it .=    '</td>';
                        $it .=    '<td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">';
                        $it .=       $item->vlruni;
                        //$it .=       number_format(floatval($item->ValorUnitario), 2, ",", ".");
                        $it .=    '</td>';
                        $it .=    '<!--td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">';
                        //$it .=       $item->ValorDesconto;
                        //$it .=       number_format(floatval($item->ValorDesconto), 2, ",", ".");
                        $it .=    '</td>';
                        $it .=    '<td class="item" align="right" style="border-bottom: #000000 1px dashed;">';
                        //$it .=       '<strong>'.$item->ValorLiquido.'</strong>';
                        //$it .=       '<strong>'.number_format(floatval($item->ValorLiquido), 2, ",", ".").'</strong>';
                        $it .=    '</td-->';
                        $it .= '</tr>';
                        echo $it;
                     };
                     ?>
                  </table>
               </td>
            </tr>
         </table>
         <!-- Fim Descricao dos Itens Servicos -->

         <?php } ?>
         <!-- Fim Linha em Branco -->

         <!-- Inicio Descricao dos Itens Pecas -->
         <?php if ($fc_Pec !== NULL) { ?>
         
         <!-- Inicio Linha em Branco -->
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
               <td height="10" style="font-size: 10px;">
                  &nbsp;
               </td>
            </tr>
         </table>

         <table class="itens" width="100%" border="1" cellpadding="0" cellspacing="0">
            <tr>
               <td height="22" align="center" bgcolor="#FFFFEA" class="titulo">
                  DESCRI&Ccedil;&Atilde;O DAS PE&Ccedil;AS
               </td>
            </tr>
            <tr>
               <td valign="top">
                  <table width="100%" border="0" cellpadding="1" cellspacing="2">
                     <tr>
                        <td width="6%" align="left" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           Codigo
                        </td>
                        <td align="left" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           Pe&ccedil;a
                        </td>
                        <td width="7%" align="center" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           Quant
                        </td>
                        <td width="8%" align="center" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           Vlr.Unit.
                        </td>
                        <!--td width="8%" align="center" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                           Desc.
                        </td>
                        <td width="8%" align="center" class="legenda" bgcolor="#FFFFEA" style="border-bottom: #000000 1px solid">
                           Valor
                        </td-->
                     </tr>
                     
                     <?php
                     foreach ($fc_Pec as $item) {
                        $it  = '<tr>';
                        $it .=    '<td class="item" align="left" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">';
                        $it .=       $item->codpec;
                        $it .=    '</td>';
                        $it .=    '<td class="item" align="left" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted; text-align="left">';
                        $it .=      Util::subhex($item->descri);
                        $it .=    '</td>';
                        $it .=    '<td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">';
                        $it .=       $item->quant;
                        //$it .=       number_format(floatval($item->Quantidade), 2, ",", ".");
                        $it .=    '</td>';
                        $it .=    '<td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">';
                        $it .=       $item->vlruni;
                        //$it .=       number_format(floatval($item->ValorUnitario), 2, ",", ".");
                        $it .=    '</td>';
                        $it .=    '<!--td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">';
                        //$it .=       $item->ValorDesconto;
                        //$it .=       number_format(floatval($item->ValorDesconto), 2, ",", ".");
                        $it .=    '</td>';
                        $it .=    '<td class="item" align="right" style="border-bottom: #000000 1px dashed;">';
                        //$it .=       '<strong>'.$item->ValorLiquido.'</strong>';
                        //$it .=       '<strong>'.number_format(floatval($item->ValorLiquido), 2, ",", ".").'</strong>';
                        $it .=    '</td-->';
                        $it .= '</tr>';
                        echo $it;
                     };
                     ?>
                  </table>
               </td>
            </tr>
         </table>
         <!-- Fim Descricao dos Itens Pecas -->

         <?php } ?>

         <!-- Inicio Linha em Branco -->
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
               <td height="5" style="font-size: 5px;">
                  &nbsp;
               </td>
            </tr>
         </table>
         <!-- Fim Linha em Branco -->

         <!-- Inicio Totais -->
         <table width="100%" border="0" cellpadding="2" cellspacing="0">
            <tr>
               <td width="85%" height="22">
                  
               </td>
               <td width="15%" class="leg_totais" style="border-top: #000000 1px solid; border-left: #000000 1px solid; border-right: #000000 1px solid; border-bottom: #000000 1px dotted;">
                  Valor Total Nota
               </td>
            </tr>
            <tr>
               <td height="22">
               
               </td>
               <td class="cam_totais" style="border-bottom: #000000 1px solid; border-left: #000000 1px solid; border-right: #000000 1px solid; font-size: 16px;">
                  <?php 
                     if ($Totais !== NULL) { 
                        echo $Totais->lbltot;
                     } else {
                        echo '0,00';
                     }
                  ?>
               </td>
            </tr>

         </table>
         <!-- Fim Totais -->

         <!-- Inicio Linha em Branco -->
         <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
               <td height="10" style="font-size: 10px;">
                  &nbsp;
               </td>
            </tr>
         </table>
         <!-- Fim Linha em Branco -->

         <!-- Inicio Outras Informacoes -->
         <table width="100%" border="0" cellpadding="2" cellspacing="0">
            <tr>
               <td align="left" height="10" style="font-size: 10px;">
                  Powered by <a href="https://www.fichadocarro.com.br">https://www.fichadocarro.com.br</a>
               </td>
            </tr>
         </table>
         <!-- Fim Outras Informacoes -->
      </td>
   </tr>
</table>

<!-- Final da Tabela Principal -->
<!-- Final do HTML -->

