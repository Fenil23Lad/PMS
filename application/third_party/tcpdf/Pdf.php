<?php 
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
require_once dirname(__FILE__) . '/fpdfi/fpdi.php';

class PDF extends FPDI
{
    function LoadTemplate($source)
    {
        $this->setSourceFile($source);
		$this->AddPage();
		$tplIdx = $this->importPage(1);
		$this->useTemplate($tplIdx);
    }  
}
