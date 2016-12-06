<?php

include "../plugins/mpdf/mpdf.php";

  $pdfheader = '
    <table width="100%" id="header">
      <tr>
        <td width="30%"><img src="../../layout/imagens/backend/logo.png" class="logo" width="170px" height="100px" /></td>
        <td width="30"><img width=100px height=100px></td>
      </tr>
    </table>
  ';

  $pdfbody='<div id="content">';
  $pdfbody.=$_POST['dadospdf'];
  $pdfbody.='</div>';

  $pdffooter = '
    <table width="100%" id="footer">
      <tr>
        <td width=33%>{DATE j/m/Y}</td>
        <td width=33% align="center">{PAGENO}/{nbpg}</td>
        <td width=33% align="center">HSUL</td>
      </tr>
    </table>
  ';

  $mpdf = new mPDF('c', 'A4', '', '', 20, 15, 48, 25, 10, 10);

  $mpdf->SetHTMLHeader($pdfheader);
  $mpdf->setHTMLFooter($pdffooter);
  $stylesheet = file_get_contents('../../layout/css/hs_pdf_css.css');
  $mpdf->WriteHTML($stylesheet,1);
  $mpdf->WriteHTML($pdfbody, 2);
  $mpdf->output();
 ?>
