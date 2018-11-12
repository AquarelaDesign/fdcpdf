<?PHP
/**
 * @category   Ficha do Carro
 * @package    FDC
 * @copyright  Copyright (c) 2018
 * @author     Jose Augsuto Freire <jose at procyon dot com dot br>
 * @comment    Layout do Orçamento / Passagem
 */
$Titulo_01 = htmlentities(strtoupper($fc_Ofi->nome));
$Titulo_02 = Util::mask(strval($fc_Ofi->cgccpf),"##.###.###/####-##");
$Titulo_03 = htmlentities(strtolower($fc_Ofi->fone));
$Titulo_04 = htmlentities(strtolower($fc_Ofi->e_mail));
?>
<!-- Inicio do HTML -->

<!-- Inclui pagina de estilos -->
<link href="css/OrcPas.css" rel="stylesheet" type="text/css"/>

<page backtop="36mm" backbottom="5mm" style="font-size: 11px">
   <!-- Inicio Cabecalho -->
   <page_header>
   <table border="0" cellspacing="0" cellpadding="0" style="width: 700px;">
      <tr>
         <td valign="middle" align="center" style="width: 450px; padding: 4px; border: #000000 1px solid;">
            <table border="0" cellspacing="0" cellpadding="0" style="width: 450px;">
               <tr>
                  <?php if (!empty($logo)) { ?>
                  <td valign="middle" align="left" style="width: 100px; height: 110; padding: 4px;">
                     <div style="padding: 2px; background-color:white">
                        <img src="<?php echo $logo ?>" height="100" border="0"> 
                     </div>
                  </td>
                  <?php } else { ?>
                  <td valign="middle" align="left" style="width: 100px; height: 110; padding: 4px;">
                     <div style="padding: 2px; background-color:white; width: 135px; height: 110;">
                        &nbsp; 
                     </div>
                  </td>
                  <?php } ?>
                  
                  <td align="center" style="width: 350px; height:110; padding:4px;">
                     <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                           <td align="center" style="width: 350px; height:35px;">
                              <span style="font-family:Helvetica; font-size:18">
                                 <b><?php echo $Titulo_01 ?></b>
                              </span>
                           </td>
                        </tr>
                        <tr>
                           <td align="center">
                              <span style="font-family:Helvetica; font-size:14; height:24px;">
                                 <b><?php echo $Titulo_02 ?></b>
                              </span>
                           </td>
                        </tr>
                        <tr>
                           <td align="center">
                              <span style="font-family:Helvetica; font-size:14; height:24px;">
                                 <b><?php echo $Titulo_03 ?></b>
                              </span>
                           </td>
                        </tr>
                        <tr>
                           <td align="center">
                              <span style="font-family:Helvetica; font-size:10; height:24px;">
                                 <?php echo $Titulo_04 ?>
                              </span>
                           </td>
                        </tr>
                     </table>
                  </td>
               </tr>
            </table>
         </td>
         <td valign="top" style="width: 230px; border-top: #000000 1px solid; border-right: #000000 1px solid; border-bottom: #000000 1px solid;">

            <table border="0" cellspacing="0" cellpadding="4" style="width: 230px;">
               <tr>
                  <td colspan="2" valign="middle" align="center" class="titulo" bgcolor="#FFFFEA" style="width: 230px; height:30px; border-bottom: #000000 1px solid;">
                     <?php echo 'DADOS ' . ($tipo == 'ORC' ? 'DO '.htmlentities('ORÇAMENTO')  : 'DA PASSAGEM') ?>
                  </td>
               </tr>
               <tr>
                  <td colspan="2" valign="middle" class="titulo" align="center" height="55"
                        style="border-top: #000000 1px solid; font-size: 28px; border-bottom: #000000 1px solid;">
                     <b><?php echo $fc_Pas[$x]->idipas ?></b>
                  </td>
               </tr>
               <tr>
                  <td class="legenda" valign="middle" style="height:12px; border-top: #000000 1px solid; border-right: #000000 1px solid;">
                     Data:
                  </td>
                  <td class="legenda" valign="middle" style="height:12px; border-top: #000000 1px solid;">
                     Andamento:
                  </td>
               </tr>
               <tr>
                  <td class="campo" valign="middle" align="center" style="height:12px; border-right: #000000 1px solid;">
                     <?php echo date('d/m/Y',strtotime($fc_Pas[$x]->dtpsg)) ?>
                  </td>
                  <td class="campo" valign="middle" align="center" style="height:12px;">
                     &nbsp;
                  </td>
               </tr>
            </table>

         </td>
      </tr>
   </table>
   </page_header>
   <!-- Fim Cabecalho -->
   
   <!-- Inicio Dados Prestador -->
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
         <td style="font-size: 10px; height: 10">
            &nbsp;
         </td>
      </tr>
   </table>
   
   <table border="0" cellspacing="0" cellpadding="0" style="width: 700px;">
      <tr>
         <td valign="middle" align="center" bgcolor="#FFFFEA" class="titulo" style="width: 700px; height: 25; border: #000000 1px solid;">
            PRESTADOR DO SERVI&Ccedil;O
         </td>
      </tr>
      <tr>
         <td>
            <table border="0" cellpadding="0" cellspacing="0" style="width: 700px;">
               <tr>
                  <td class="legenda" align="right" style="border-left: #000000 1px solid; width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     NOME:
                  </td>
                  <td class="campo" align="left" style="width: 280px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Ofi->nome) ?>
                  </td>
                  <td class="legenda" align="right" style="width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     CNPJ:
                  </td>
                  <td class="campo" align="left" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::mask(strval($fc_Ofi->cgccpf),"##.###.###/####-##") ?>
                  </td>
               </tr>
               <tr>
                  <td class="legenda" align="right" style="border-left: #000000 1px solid; width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     ENDERE&Ccedil;O:
                  </td>
                  <td class="campo" align="left" style="width: 280px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Ofi->endrua) ?>
                  </td>
                  <td class="legenda" align="right" style="width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     N&ordm;
                  </td>
                  <td class="campo" align="left" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Ofi->endnum) ?>
                  </td>
               </tr>
               <tr>
                  <td class="legenda" align="right" style="border-left: #000000 1px solid; width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     BAIRRO:
                  </td>
                  <td class="campo" align="left" style="width: 280px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Ofi->bairro) ?>
                  </td>
                  <td class="legenda" align="right" style="width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     CIDADE/UF
                  </td>
                  <td class="campo" align="left" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Ofi->cidade . "/" . $fc_Ofi->uf) ?>
                  </td>
               </tr>
               <tr>
                  <td class="legenda" align="right" style="border-left: #000000 1px solid; width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     COMPLEMENTO:
                  </td>
                  <td class="campo" align="left" style="width: 280px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     
                  </td>
                  <td class="legenda" align="right" style="width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     CEP:
                  </td>
                  <td class="campo" align="left" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
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
   
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
         <td style="font-size: 10px; height: 10">
            &nbsp;
         </td>
      </tr>
   </table>
   
   <table border="0" cellspacing="0" cellpadding="0" style="width: 700px;">
      <tr>
         <td valign="middle" align="center" bgcolor="#FFFFEA" class="titulo" style="width: 700px; height: 25; border: #000000 1px solid;">
            TOMADOR DO SERVI&Ccedil;O
         </td>
      </tr>
      <tr>
         <td>
            <table border="0" cellpadding="0" cellspacing="2" style="width: 700px;">
               <tr>
                  <td class="legenda" align="right" style="border-left: #000000 1px solid; width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     NOME:
                  </td>
                  <td class="campo" align="left" style="width: 280px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Usu->nome) ?>
                  </td>
                  <td class="legenda" align="right" style="width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     CNPJ:
                  </td>
                  <td class="campo" align="left" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo (strlen($fc_Usu->cgccpf) >= 14 ? 
                           Util::mask(strval($fc_Usu->cgccpf),"##.###.###/####-##") : 
                           Util::mask(strval($fc_Usu->cgccpf),"###.###.###-##" )) ?>
                  </td>
               </tr>
               <tr>
                  <td class="legenda" align="right" style="border-left: #000000 1px solid; width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     ENDERE&Ccedil;O:
                  </td>
                  <td class="campo" align="left" style="width: 280px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Usu->endrua) ?>
                  </td>
                  <td class="legenda" align="right" style="width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     N&ordm;
                  </td>
                  <td class="campo" align="left" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Usu->endnum) ?>
                  </td>
               </tr>
               <tr>
                  <td class="legenda" align="right" style="border-left: #000000 1px solid; width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     BAIRRO:
                  </td>
                  <td class="campo" align="left" style="width: 280px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Usu->bairro) ?>
                  </td>
                  <td class="legenda" align="right" style="width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     CIDADE/UF
                  </td>
                  <td class="campo" align="left" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Usu->cidade . "/" . $fc_Usu->uf) ?>
                  </td>
               </tr>
               <tr>
                  <td class="legenda" align="right" style="border-left: #000000 1px solid; width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     COMPLEMENTO:
                  </td>
                  <td class="campo" align="left" style="width: 280px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     
                  </td>
                  <td class="legenda" align="right" style="width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     CEP:
                  </td>
                  <td class="campo" align="left" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::mask(strval($fc_Usu->cep),"#####-###") ?>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>

   <?php } ?>
   <!-- Fim Dados Tomador -->

   <!-- Inicio Dados Veiculo -->
   <?php if ($fc_Vei !== NULL) { ?>
   
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
         <td style="font-size: 10px; height: 10">
            &nbsp;
         </td>
      </tr>
   </table>
   
   <table border="0" cellspacing="0" cellpadding="0" style="width: 700px;">
      <tr>
         <td valign="middle" align="center" bgcolor="#FFFFEA" class="titulo" style="width: 700px; height: 25; border: #000000 1px solid;">
            VEÍCULO
         </td>
      </tr>
      <tr>
         <td>
            <table border="0" cellpadding="0" cellspacing="2" style="width: 700px;">
               <tr>
                  <td class="legenda" align="right" style="border-left: #000000 1px solid; width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     CHASSI:
                  </td>
                  <td class="campo" align="left" style="width: 280px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Vei->chassi) ?>
                  </td>
                  <td class="legenda" align="right" style="width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     PLACA:
                  </td>
                  <td class="campo" align="left" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Vei->placa) ?>
                  </td>
               </tr>
               <tr>
                  <td class="legenda" align="right" style="border-left: #000000 1px solid; width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     DESCRI&Ccedil;AO:
                  </td>
                  <td class="campo" align="left" style="width: 280px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Vei->descri) ?>
                  </td>
                  <td class="legenda" align="right" style="width: 100px; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     ANO:
                  </td>
                  <td class="campo" align="left" style="width: 200px; border-bottom: #000000 1px solid; border-right: #000000 1px solid">
                     <?php echo Util::subhex($fc_Vei->anomod) ?>
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>

   <?php } ?>
   <!-- Fim Dados Veiculo -->

   <!-- Inicio Descricao dos Itens Servicos -->
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
         <td height="10" style="font-size: 10px;">
            &nbsp;
         </td>
      </tr>
   </table>
         
   <table class="itens" border="1" cellspacing="0" cellpadding="0" style="width: 700px;">
      <tr>
         <td valign="middle" align="center" bgcolor="#FFFFEA" class="titulo" style="width: 700px; height: 25;">
            DESCRI&Ccedil;&Atilde;O DOS SERVI&Ccedil;OS
         </td>
      </tr>
      <tr>
         <td valign="top">
            <table border="0" cellspacing="0" cellpadding="2" style="width: 700px;">
               <tr>
                  <td align="left"   class="legenda" bgcolor="#FFFFEA" style="width:150; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     Codigo
                  </td>
                  <td align="left"   class="legenda" bgcolor="#FFFFEA" style="width:388; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     Servi&ccedil;o
                  </td>
                  <td align="center" class="legenda" bgcolor="#FFFFEA" style="width:50; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     Quant
                  </td>
                  <td align="center" class="legenda" bgcolor="#FFFFEA" style="width:50; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     Vlr.Unit.
                  </td>
                  <td align="center" class="legenda" bgcolor="#FFFFEA" style="width:50; border-bottom: #000000 1px solid;">
                     Total
                  </td>
               </tr>
               
               <?php
               if ($fc_Ser !== NULL) {
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
                     $it .=    '</td>';
                     $it .=    '<td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">';
                     $it .=       $item->vlruni;
                     $it .=    '</td>';
                     $it .=    '<td class="item" align="right" style="border-bottom: #000000 1px dashed;">';
                     $it .=       $item->vlrtot;
                     $it .=    '</td>';
                     $it .= '</tr>';
                     echo $it;
                  }
               } else {
                  $it  = '<tr>'
                          . '<td class="item" align="left" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">'
                             . '&nbsp;'
                          . '</td>'
                          . '<td class="item" align="left" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted; text-align="left">'
                             . '&nbsp;'
                          . '</td>'
                          . '<td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">'
                             . '&nbsp;'
                          . '</td>'
                          . '<td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">'
                             . '&nbsp;'
                          . '</td>'
                          . '<td class="item" align="right" style="border-bottom: #000000 1px dashed;">'
                             . '&nbsp;'
                          . '</td>'
                       . '</tr>';
                  echo $it;
               }
               ?>
            </table>
         </td>
      </tr>
   </table>
   <!-- Fim Descricao dos Itens Servicos -->

   <!-- Inicio Descricao dos Itens Pecas -->
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
         <td height="10" style="font-size: 10px;">
            &nbsp;
         </td>
      </tr>
   </table>
         
   <table class="itens" border="1" cellspacing="0" cellpadding="0" style="width: 700px;">
      <tr>
         <td valign="middle" align="center" bgcolor="#FFFFEA" class="titulo" style="width: 700px; height: 25;">
            DESCRI&Ccedil;&Atilde;O DAS PE&Ccedil;AS
         </td>
      </tr>
      <tr>
         <td valign="top">
            <table border="0" cellspacing="0" cellpadding="2" style="width: 700px;">
               <tr>
                  <td align="left"   class="legenda" bgcolor="#FFFFEA" style="width:150; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     Codigo
                  </td>
                  <td align="left"   class="legenda" bgcolor="#FFFFEA" style="width:388; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     Pe&ccedil;a
                  </td>
                  <td align="center" class="legenda" bgcolor="#FFFFEA" style="width:50; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     Quant
                  </td>
                  <td align="center" class="legenda" bgcolor="#FFFFEA" style="width:50; border-bottom: #000000 1px solid; border-right: #000000 1px dotted">
                     Vlr.Unit.
                  </td>
                  <td align="center" class="legenda" bgcolor="#FFFFEA" style="width:50; border-bottom: #000000 1px solid;">
                     Total
                  </td>
               </tr>
               
               <?php
               if ($fc_Pec !== NULL) {
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
                     $it .=    '</td>';
                     $it .=    '<td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">';
                     $it .=       $item->vlruni;
                     $it .=    '</td>';
                     $it .=    '<td class="item" align="right" style="border-bottom: #000000 1px dashed;">';
                     $it .=       $item->vlrtot;
                     $it .=    '</td>';
                     $it .= '</tr>';
                     echo $it;
                  }
               } else {
                  $it  = '<tr>'
                          . '<td class="item" align="left" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">'
                             . '&nbsp;'
                          . '</td>'
                          . '<td class="item" align="left" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted; text-align="left">'
                             . '&nbsp;'
                          . '</td>'
                          . '<td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">'
                             . '&nbsp;'
                          . '</td>'
                          . '<td class="item" align="right" style="border-bottom: #000000 1px dashed; border-right: #000000 1px dotted">'
                             . '&nbsp;'
                          . '</td>'
                          . '<td class="item" align="right" style="border-bottom: #000000 1px dashed;">'
                             . '&nbsp;'
                          . '</td>'
                       . '</tr>';
                  echo $it;
               }
               ?>
            </table>
         </td>
      </tr>
   </table>
   <!-- Fim Descricao dos Itens Pecas -->

   <!-- Inicio Totais -->
   <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
         <td height="5" style="font-size: 5px;">
            &nbsp;
         </td>
      </tr>
   </table>

   <table border="0" cellpadding="2" cellspacing="0" style="width: 700px;">
      <tr>
         <td rolspan="2" style="width: 182px; height: 22;">
            &nbsp;
         </td>
         <!--td style="width: 373px; height: 20mm">&nbsp;</td-->
         <td>
            <table border="0" cellpadding="2" cellspacing="0" style="width: 180px; height: 20mm;">
               <tr>
                  <td class="leg_totais" style="width: 180px; border-left: #000000 1px solid; border-right: #000000 1px solid; border-bottom: #000000 1px dotted; border-top: #000000 1px solid;">
                     Valor Total Serviços
                  </td>
               </tr>
               <tr>
                  <td class="cam_totais" style="width: 180px; height: 10mm; border-left: #000000 1px solid; border-right: #000000 1px solid; border-bottom: #000000 1px solid; font-size: 16px;">
                     <?php 
                        if ($Totais !== NULL) { 
                           echo (!empty($Totais->lblser) ? $Totais->lblser : '0,00');
                        } else {
                           echo '0,00';
                        }
                     ?>
                  </td>
               </tr>
               <tr>
                  <td align="center" style="font-size: 9px; width: 180px; height: 5mm;">
            				&nbsp;
                  </td>
               </tr>
            </table>
         </td>
         <td>
            <table border="0" cellpadding="2" cellspacing="0" style="width: 180px; height: 20mm;">
               <tr>
                  <td class="leg_totais" style="width: 180px; border-left: #000000 1px solid; border-right: #000000 1px solid; border-bottom: #000000 1px dotted; border-top: #000000 1px solid;">
                     Valor Total Peças
                  </td>
               </tr>
               <tr>
                  <td class="cam_totais" style="width: 180px; height: 10mm; border-left: #000000 1px solid; border-right: #000000 1px solid; border-bottom: #000000 1px solid; font-size: 16px;">
                     <?php 
                        if ($Totais !== NULL) { 
                           echo (!empty($Totais->lblpec) ? $Totais->lblpec : '0,00');
                        } else {
                           echo '0,00';
                        }
                     ?>
                  </td>
               </tr>
               <tr>
                  <td align="center" style="font-size: 9px; width: 180px; height: 5mm;">
            				&nbsp;
                  </td>
               </tr>
            </table>
         </td>
         <td>
            <table border="0" cellpadding="2" cellspacing="0" style="width: 185px; height: 20mm;">
               <tr>
                  <td class="leg_totais" style="width: 185px; border-left: #000000 1px solid; border-right: #000000 1px solid; border-bottom: #000000 1px dotted; border-top: #000000 1px solid;">
                     Valor Total Nota
                  </td>
               </tr>
               <tr>
                  <td class="cam_totais" style="width: 185px; height: 10mm; border-left: #000000 1px solid; border-right: #000000 1px solid; border-bottom: #000000 1px solid; font-size: 16px;">
                     <?php 
                        if ($Totais !== NULL) { 
                           echo $Totais->lbltot;
                        } else {
                           echo '0,00';
                        }
                     ?>
                  </td>
               </tr>
               <tr>
                  <td align="center" style="font-size: 9px; width: 185px; height: 5mm;">
            				&nbsp;
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
   <!-- Final Totais -->

   <!-- Inicio Rodape -->
   <page_footer>
   <table border="0" cellpadding="2" cellspacing="0" style="width: 197mm;">
      <tr>
         <td style="width: 22mm; height: 22mm;">
            <qrcode value="<?php echo $QRCode; ?>" style="width: 20mm;"></qrcode>
         </td>
         <td align="right" valign="bottom" style="font-size: 9px; width: 175mm; height: 20mm;">
            Powered by <a href="https://www.fichadocarro.com.br">https://www.fichadocarro.com.br</a> 
            - Gerado em <?php echo date("d-m-Y") . ' as ' . date("H:i:s"); ?>
         </td>
      </tr>
   </table>
   </page_footer>
   <!-- Final Rodape -->

</page>
<!-- Final do HTML -->

 