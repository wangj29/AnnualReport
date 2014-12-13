<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Test extends MY_Member_Controller {
    function __construct()
    {
      parent::__construct();
      $this->load->library('excel');
    }
    function index(){        
        
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("title")
                         ->setDescription("description");
        
        // Assign cell values
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'cell value here');
        
        // Save it as an excel 2003 file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        
        // It will be called file.xls
        header('Content-Disposition: attachment; filename="Hello.xls"');
        
        // Write file to the browser
        $objWriter->save('php://output');
    }
    
}