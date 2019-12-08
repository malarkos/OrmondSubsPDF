<?php
//============================================================+
// File name   : ormondsubs.php
// Begin       : 2019-11-19
// Last Update : 2019-12-08
//
// Description : Create PDF subs notice for Ormond Ski Club
//               
//
// Author: Geoff Markley
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
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Geoff Makrley
 * @since 2019-11-19
 */

// Include the main TCPDF library (search for installation path).

require_once('tcpdf_include.php');
// Edited originally for right location

class myclass {
    // empty class
}
// extend TCPF with custom functions
class MYPDF extends TCPDF {
    // Colored table
    public function ColoredTable($header,$data,$colcount) {
        // Colors, line width and bold font
        $this->SetFillColor(192);
        $this->SetTextColor(0,0,0);
        $this->SetDrawColor(0,0,0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        if ($colcount == 3)
            $w = array(90, 45,45);
        if ($colcount == 2)
            $w = array(90,90);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach($data as $row) {
            //echo $row[0];
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            //$this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            //$this->Cell($w[1], 6, number_format($row[1]), 'LR', 0, 'R', $fill);
            if ($colcount == 3)
            {
                $this->Cell($w[1], 6, $row[1], 'LR', 0, 'R', $fill);
                $this->Cell($w[2], 6, $row[2], 'LR', 0, 'R', $fill);
            }
            if ($colcount == 2)
            {
                $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            }
            
            //$this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
    
}

// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Ormond Ski Club');
$pdf->SetTitle('2020 Subscription Notice');
$pdf->SetSubject('Subscription Notice');
$pdf->SetKeywords('Ormond, Ski Club, Subscription Notice');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// remove default header/footer
$pdf->setPrintHeader(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
// start master table
$html = '<table border="1">';
$html .= <<<EOD
<tr><td><h2>Ormond Ski Club 2020 Subscriptions Notice</h2></td></tr>
EOD;

$html .= '<tr><td align="center"><h3>TAX INVOICE</h3></td></tr>';

// row for Member details and club information

$memberfirstname = 'Geoff';
$membersurname = 'Markley';
$memberid = '351';
$html .= '<tr>
				<td width="50%">
                    '.$memberfirstname.' '.$membersurname.'<br>
                    Address

                </td>
				<td width="50%" align="right">
                    Ormond Ski Club<br>
                    1/175 Fitzroy St.<br>
                    FITZROY, Vic, 3065<br>
                    <i>email:general@ormondskiclub.com.au</i><br> 
                    <i>web: www.ormondskiclub.com.au</i><br>
				    ABN: 75004765753<br>
                    Date issued: <b>01 Dec 2020</b>
                </td>		
		</tr>';

// Member overview

$html .= '<tr><td colspan="2">
			Dear '.$memberfirstname.',<br><br>
			
			
				This is your 2020 Subscription Notice for Ormond Ski Club with
				subscriptions due by <b>28th Feb 2020</b>. Please check the
				subscriptions below are correct and advise any errors or required
				changes. Early payment of subscriptions helps the Club pay for Work
				Parties and other maintenance costs and Subs need to be paid prior
				to being able to book for the 2020 Ski season.  If you have any questions about your Subscription notice, please contact the Membership officer at general@ormondskiclub.com.au.
		
		</td></tr>';
// close out master table
$html .= '</table><p>';

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// column titles
$header = array('Item', 'Amount','Total');
$amountowning = 0.00;
$table_values = array(
    array('Balance as at 30 Nov 2019','$'.$amountowning,'$'.$amountowning)
        //array('Total',250.00)
        );
$total_owing = $amountowning;
$grad_sub = 300; $spouse_sub =150;$child_sub=110;$buddy_sub=150;$locker_sub=80;
$total_owing += $grad_sub;
array_push($table_values,array('Graduate Subs','$'.$grad_sub,'$'.$total_owing));
$total_owing += $spouse_sub;
array_push($table_values,array('Spouse Subs','$'.$spouse_sub,'$'.$total_owing));
$total_owing += $child_sub;
array_push($table_values,array('Child Subs','$'.$child_sub,'$'.$total_owing));
$total_owing += $buddy_sub;
array_push($table_values,array('Buddy Subs','$'.$buddy_sub,'$'.$total_owing));
$total_owing += $locker_sub;
array_push($table_values,array('Locker Subs','$'.$locker_sub,'$'.$total_owing));


array_push($table_values,array('Total Owing','','$'.$total_owing));

// print colored table
//$html .= '<tr>';
//$html .= 
$pdf->ColoredTable($header, $table_values,3);
$pdf->Ln();
//$html .= '</tr>';
// Add entries
// Add balance carried forward
// Add Graduate subs
// Add family subs
// Add buddy subs
// Add Locker subs
// show total

// show work party days
// Payment options
$html1 = '<h3>Payment Options</h3>';
$pdf->writeHTMLCell(0, 0, '', '', $html1, 0, 1, 0, true, '', true);

$header1 = array('Internet Transfer','Pay by Cheque');

$internet_transfer='ANZ Bank';
$cheque_payment = 'Send cheque to:<p>Ormond Ski Club Treasurerfdsafdsafdfasdfdsafdsafsafsfdsfds';
$sub_payment_options = array(array($internet_transfer,$cheque_payment));

$pdf->ColoredTable($header1, $sub_payment_options,2);
// Show contact details



// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$outputfile = '/Users/geoffmarkley/Documents/tcpdf/ormondsubs/'.$memberfirstname.'_'.$membersurname.'_2020_subs.pdf';
$pdf->Output($outputfile, 'F');

//============================================================+
// END OF FILE
//============================================================+
