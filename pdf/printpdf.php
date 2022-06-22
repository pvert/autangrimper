<?php
/*
 * Génération du dossier d'inscription
 * html2pdf   https://github.com/spipu/html2pdf/
 * author : Pierre VERT - Sedoo OMP
 */

/************************************************************************************************************************************** */

// convert in PDF
require_once dirname(__FILE__).'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    include dirname(__FILE__).'/get-content.php';
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    
    $html2pdf->output('Autan-grimper_'.get_field('atgp_nom').'inscription-'.$_GET['postID'].'.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}

?>
