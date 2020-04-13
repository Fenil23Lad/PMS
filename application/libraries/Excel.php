<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once APPPATH."third_party/PHPExcel.php";

class Excel extends PHPExcel 
{
    public function __construct() 
	{
        parent::__construct();
    }
	
	/*
	* Function Name : readExcelFile
	* ParamName 	: fileName
	* Return        : Exceldata in Array
	*/
	
	public function readExcelFile($fileName)
	{	
		$file = $fileName;
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		
		//------------ Get value in PHP Array --------------
		
		foreach ($cell_collection as $cell) 
		{
			$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();

			if ($row == 1) 
			{
				$header[$row][$column] = $data_value;
			} 
			else 
			{
				$arr_data[$row][$column] = $data_value;
			}
		}
		
		$data['header'] = $header;
		$data['values'] = $arr_data;
		return $data;
	}
	
	/*
	* Function Name : createExcelFile
	*/
	public function createExcelFile($data)
	{
		//print_r($data);exit;
		$this->setActiveSheetIndex(0);
		$this->getActiveSheet()->setTitle('worksheet');

		$char= 'A';
		for($i=0;$i<=16;$i++)
		{
			$this->getActiveSheet()->getStyle($char.'1')->getFont()->setSize(12);
			$this->getActiveSheet()->getStyle($char.'1')->getFont()->setBold(true);
			$this->getActiveSheet()->getStyle($char.'1')->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$char++;
		}
		
		// ============ For Width Setting  =============================
		
		$this->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$this->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$this->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$this->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$this->getActiveSheet()->getColumnDimension('E')->setWidth(19);
		$this->getActiveSheet()->getColumnDimension('F')->setWidth(19);
		$this->getActiveSheet()->getColumnDimension('G')->setWidth(20);
		$this->getActiveSheet()->getColumnDimension('H')->setWidth(40);
		$this->getActiveSheet()->getColumnDimension('I')->setWidth(25);
		$this->getActiveSheet()->getColumnDimension('J')->setWidth(12);
		$this->getActiveSheet()->getColumnDimension('K')->setWidth(15);

		// ==========================================================
		
		$this->getActiveSheet()->setCellValue('A1', 'Project Name');
		$this->getActiveSheet()->setCellValue('B1', 'Project Description');
		$this->getActiveSheet()->setCellValue('C1', 'Estimate Time');
		$this->getActiveSheet()->setCellValue('D1', 'Estimate Start Date');
		$this->getActiveSheet()->setCellValue('E1', 'Project Created On');
		$this->getActiveSheet()->setCellValue('F1', 'Project Created By');
		$this->getActiveSheet()->setCellValue('G1', 'Project Stage');
		$this->getActiveSheet()->setCellValue('H1', 'Note');
		$this->getActiveSheet()->setCellValue('I1', 'Project Category Name');
		$this->getActiveSheet()->setCellValue('K1', 'Total Task');
		$this->getActiveSheet()->setCellValue('L1', 'Running Task');
		$this->getActiveSheet()->setCellValue('M1', 'Completed Task');
		
		$i = 2;
		foreach($data as $key=>$data_res) {
			
			// For Set Word Wrap
			$this->getActiveSheet()->getStyle('A' . $i .':O'. $i)->getAlignment()->setWrapText(true); 
			//===============================
			
			$this->getActiveSheet()->setCellValue('A' . $i, $data_res[0]['ProjectName']);
			$this->getActiveSheet()->setCellValue('B' . $i, $data_res[0]['ProjectDesc']);
			$this->getActiveSheet()->setCellValue('C' . $i, $data_res[0]['EstimateTime']);
			$this->getActiveSheet()->setCellValue('D' . $i, date('d/m/Y',strtotime($data_res[0]['EstimateStartDate'])));
			$this->getActiveSheet()->setCellValue('E' . $i, date('d/m/Y',strtotime($data_res[0]['ProjectCreatedOn'])));
			$this->getActiveSheet()->setCellValue('F' . $i, $data_res[0]['Proj_Created_Name']);
			$this->getActiveSheet()->setCellValue('G' . $i, $data_res[0]['ProjectStage']);
			$this->getActiveSheet()->setCellValue('H' . $i, $data_res[0]['Note']);
			$this->getActiveSheet()->setCellValue('I' . $i, $data_res[0]['ProjectCategoryName']);
			$this->getActiveSheet()->setCellValue('J' . $i, $data_res[0]['total_task']);
			$this->getActiveSheet()->setCellValue('K' . $i, $data_res[0]['total_task']-$data_res[0]['complete_task']);
			$this->getActiveSheet()->setCellValue('L' . $i, $data_res[0]['complete_task']);
			$i++;
		}
		$filename = $data_res[0]['ProjectName'].'.xls';
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"'); 
		header('Cache-Control: max-age=0');
		
		$objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel5');  
		$objWriter->save('php://output');
	}
	
	
}
