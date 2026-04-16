<?php
/**
* Template Name: Récapitulatif d'inscription
*/
//============================================================+
// File name   : example_061.php
// Begin       : 2010-05-24
// Last Update : 2014-01-25
//
// Description : Example 061 for TCPDF class
//               XHTML + CSS
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: XHTML + CSS
 * @author Nicola Asuni
 * @since 2010-05-25
 */

// Include the main TCPDF library (search for installation path).
require_once('includes/vendor/tcpdf/tcpdf.php');

if( isset($_REQUEST["post_id"]) && isset($_REQUEST["customer_id"]) )
{
    $sessionPostId = $_REQUEST['post_id'];
    $customerId = $_REQUEST['customer_id'];
    $mySession = new Session($sessionPostId);
    $customer = new User($customerId);
}
else
{
  wp_redirect( home_url() );
}




// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ORL-DPC');
$pdf->SetTitle("Votre demande d'inscription à la formation");
$pdf->SetSubject('l');
$pdf->SetKeywords('ORL,DPC');
$pdf->SetTextColor(39, 72, 120);


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Votre demande d’inscription à la session '.$mySession->session_id, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP+10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style


$html = '
<style>
table.session-detail{
    border-collapse:collapse;
    background-color: #F7F7F7;
}
table.session-detail tr td{
    border-collapse:collapse;
    padding:15px;
}
table.customer-info
{
    border-collapse:collapse;
    background-color: #F7F7F7;
    padding:10px 0;
    width:100%;

}
table.customer-info tr td
{
    width:50%;
    padding:10px 0;
    border-bottom:1px solid #fff;
}

.session-date-day {
    color: #E04F5F;
    font-weight: 700;
    font-size: 24px;
}
.customer-info span{
    font-weight:bold;
}
div, h2, h3{
    margin-top:15px !important;
    padding-top:0 !important;
}

.item-title
{


    margin-top: .5em;
}
h2{
   font-size: 1.3em !important;
   color: #2EAEC4 !important;
}





</style>
<?php

?>
<h1 class="title" style="color: #377DBF;font-size: 2.3em; margin-top: .3em;margin-bottom: .5em;font-weight: 300;">Votre dossier d\'inscription ORL-DPC</h1>';


$html.= '<h2 class="item-title" style="font-size: 1.3em; color: #2EAEC4;">'.$mySession->getCourseTitle().'</h2>
        <table class="session-detail" cellpadding="20" style="border-collapse:collapse;">
            <tr>
                <td class="session-date" style="padding:10px;"><span>'.$mySession->getSessionDayName().'</span><br/>
                    <span class="session-date-day">'.$mySession->getSessionDayNum().'</span><br/>
                    <span>'.$mySession->getSessionMonthName().' '.$mySession->getSessionYear().'</span>
                </td>
                <td class="session-location">'.$mySession->location.'<br/>'.$mySession->address.'<br/><strong>'.$mySession->zipcode.' '.$mySession->city.'</strong>
                </td>
                <td class="session-meta"><strong>Session '.$mySession->session_id.'</strong><br/>DPC n°'.$mySession->dpc_id.'<br/>
                    '.$mySession->duration.'
                </td>
            </tr>
        </table>
';
$html .= '<section class="session-content">'.$mySession->getCourseContent().'</section>';
$address=$customer->address1;
if (isset($customer->address2) && ($customer->address2 != ""))
{
    $address .= $customer->address2;
}
$html.='<table class="customer-info" cellpadding="10">
            <tr><td style="font-weight:bold;">Votre prénom : </td><td>'.$customer->firstname.'</td></tr>
            <tr><td style="font-weight:bold;">Votre nom : </td><td>'.$customer->lastname.'</td></tr>
            <tr><td style="font-weight:bold;">Votre adresse professionnelle :</td><td>'.$address.'<br/>'.$customer->zipcode.' '.$customer->city.'</td></tr>
            <tr><td style="font-weight:bold;">Votre numéro RPPS :</td><td>'.$customer->RPPS.'</td></tr>
            <tr><td style="font-weight:bold;">Date de naissance :</td><td>'.$customer->birthdate.'</td></tr>
            <tr><td style="font-weight:bold;">Statut :</td><td>'.$customer->type.'</td></tr>
            <tr><td style="font-weight:bold;">Téléphone professionnel : </td><td>'.$customer->phone.'</td></tr>
            <tr><td style="font-weight:bold;">Mobile : </td><td>'.$customer->mobile.'</td></tr>
            <tr><td style="font-weight:bold;">Adresse email :</td><td>'.$customer->email.'</td></tr>
        </table>';


$html .= '
            <h2 style="font-size: 1.3em; color: #274878;">Inscrivez-vous en ligne sur mondpc.fr</h2>
            <p>Afin de pouvoir bénéficier de l’indemnisation par l’Agence du DPC,, vous devez impérativement être enregistré sur le site agencedpc.fr. Si vous n’avez pas de compte, créez le en quelques minutes.</p>
            <p><span class="bullet-number" style="color: #377DBF;font-size: 1.3em; font-weight:bold;text-indent:40px;">  1. </span>Connectez-vous à votre espace personnel sur le site <strong><a href="https://www.agencedpc.fr/professionnel/" target="_blank">http://www.agencedpc.fr</a></strong> et cliquer sur le bouton <strong>« actions DPC » </strong> et « rechercher une action/s’inscrire »</p>
            <p><span class="bullet-number" style="color: #377DBF;font-size: 1.3em; font-weight:bold;text-indent:40px;">  2. </span>A gauche de votre écran, rendez-vous dans la rubrique <strong>« Rechercher une action »</strong></p>
            <p><span class="bullet-number" style="color: #377DBF;font-size: 1.3em; font-weight:bold;text-indent:40px;">  3. </span>Saisissez la référence de l\'action <strong>'.$mySession->dpc_id.'</strong> et sélectionnez <strong>« Rechercher »</strong></p>
            <p><span class="bullet-number" style="color: #377DBF;font-size: 1.3em; font-weight:bold;text-indent:40px;">  4. </span>Cliquez sur le bouton <strong>« Détail »</strong>  à droite</p>
            <p><span class="bullet-number" style="color: #377DBF;font-size: 1.3em; font-weight:bold;text-indent:40px;">  5. </span>Allez dans la rubrique <strong>« Liste sessions »</strong> choisissez <strong>session N° '.$mySession->dpc_number.'> puis cliquer sur le bouton « s’inscrire » et valider.</p>
        ';
if( $customer->paycheck_IsValid() != 2) :
$html .= '

    <h2 style="font-size: 1.3em; color: #274878;">Chèque de caution</h2>
    <p>Merci de joindre à votre courrier un chèque de caution de <strong>'.get_field('website_paycheck_amount', 'option').'€</strong> à l’ordre d’ORL-DPC.</p>
    <h3 style="font-size: 1em; color: #274878;">Pourquoi un chèque de caution ?</h3>
    <p>ORL-DPC encaissera le chèque de caution formation, en cas d’annulation du participant <b>(quel qu’en soit le motif)</b> moins de 15 jours calendaires avant la formation ou en cas de non-participation à la totalité de la formation.<br/>
    Nous conserverons ce chèque durant l’année en cours pour toutes inscriptions. Il sera détruit en fin d’année sauf en cas d’annulation tardive (voir modalités ci-dessous).</p>';
endif;
$html .= '<table class="" cellpadding=10 width="100%">
                <tr><td colspan=2>
                '.get_field('website_session_disclaimer', 'option').get_post_field('post_content', $sessionPostId).'
                </td></tr>
            </table>';
$html .= '
    <h2 style="font-size: 1em; color: #274878;text-indent:0px;">Indemnisation ANDPC : <span class="bullet-number" style="color: #377DBF;font-size: 1.3em; font-weight:bold;text-indent:40px;">'.$mySession->indemnisation.'€</span> (dans la limite de votre plafond de prise en charge).</h2>
    <p><input type="checkbox" name="box" value="1" readonly="true" /> Je reconnais avoir pris connaissance des conditions d’inscription et d’annulation ci-dessus.</p><br/>
    <table style="width:100%;">
        <tr style="width:50%;"><td>Date:</td>
        <td style="width:50%;">Signature et cachet (obligatoire)</td>
    </tr>
    </table>';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_061.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>
</body>
