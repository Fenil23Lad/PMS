<?php
require_once APPPATH."third_party/tcpdf/Pdf.php";

class InvoicePdf 
{	

	public function generatePdf($invoice)
	{
        $pdf_template = "assets/invoices/template.pdf";
		$pdf_destination = "assets/invoices/".$invoice['InvoiceId'].".pdf";
        
		$pdf = new PDF();
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->LoadTemplate($pdf_template); 
		
		//---------------Part 1-------------------------------------------------
		$pdf->SetTextColor(110,105,105);
		$pdf->SetFont('', 'B', 20);
		$pdf->SetXY(12,19);
		$pdf->MultiCell(100,25, $invoice['From'], 0, 'L');
		$pdf->SetTextColor(0,0,0);

		$pdf->SetFont('', '', 12);
		$pdf->SetXY(162,27);
		$pdf->MultiCell(30,7, $invoice['InvoiceNo'], 0, 'L');
		$pdf->SetFont('', '', 10);
		$pdf->SetXY(162,35);
		$pdf->MultiCell(30,7, $invoice['IECode'], 0, 'L');
		$pdf->SetXY(162,42);
		$pdf->MultiCell(30,7, date('d M Y',strtotime($invoice['InvoiceDate'])), 0, 'L');
		
		//---------------Part 2-------------------------------------------------
		$pdf->SetFont('', '', 11);
		$pdf->SetXY(12,74);
		$pdf->MultiCell(100,25, $invoice['ToAddress'], 0, 'L');
		
		//---------------Part 3-------------------------------------------------
		$pdf->SetFont('', '', 11);
		$pdf->SetXY(12,109);
		$pdf->MultiCell(57,7, $invoice['SalesPerson'], 0, 'C');
		$pdf->SetXY(70,109);
		$pdf->MultiCell(33,7, $invoice['PONumber'], 0, 'C');
		$pdf->SetXY(104,109);
		$pdf->MultiCell(40,7, $invoice['ShippedVia'],0, 'C');
		$pdf->SetXY(145,109);
		$pdf->MultiCell(22,7, $invoice['Currency'], 0, 'C');
		$pdf->SetXY(168,109);
		$pdf->MultiCell(35,7, $invoice['Terms'], 0, 'C');
		
		//---------------Part 4-------------------------------------------------
		$Details = json_decode($invoice['InvoiceDetails']);
		foreach($Details as $key=>$Detail)
		{
			$pdf->SetXY(12,132+(7*$key));
			$pdf->MultiCell(13,7, $key+1, 0, 'C');
			$pdf->SetXY(28,132+(7*$key));
			$pdf->MultiCell(115,7, $Detail[0], 0, 'L');
			$pdf->SetXY(145,132+(7*$key));
			$pdf->MultiCell(20,7, $Detail[1], 0, 'C');
			$pdf->SetXY(168,132+(7*$key));
			$pdf->MultiCell(35,7, number_format($Detail[2], 2, '.', ','), 0, 'R');
		}
		
		$pdf->SetFont('', '', 14);
		$pdf->SetTextColor(102,51,0);
		$pdf->SetXY(167,188);
		$pdf->MultiCell(35,9, number_format($invoice['Amount'], 2, '.', ','), 0, 'R');
		
		//---------------Part 5-------------------------------------------------
		$pdf->SetTextColor(0,0,0);
		$pdf->SetFont('', '', 8);
		$pdf->SetXY(46,210);
		$pdf->MultiCell(10,10,$invoice['DueDay'], 0, 'L');
	
		   
		$pdf->Output(); 
                
	}
}
