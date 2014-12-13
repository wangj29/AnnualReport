<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class MYExcel2 extends CI_Controller {
    function __construct()
    {
      parent::__construct();
    }
    function index()
    {
        //load our new PHPExcel library
        
        $this->load->library('excel');
        $obj=new PHPExcel();
        
        $i=0;
        $query=$this->db->get('faculty');
        
        foreach ($query->result() as $row){
            $obj->createSheet($i);
            $obj->getSheet($i)->setTitle($row->faculty_name);
            
            $user=($row->UniqueID);
            $this->db->order_by('type asc');
            $queryA=$this->db->get('publication');
            $j=0;
            $type='';
            foreach($queryA->result() as $row)
            {
                if ($type!== $row->type)
                {
                    $j++;
                    $type = $row->type;
                    $obj->getSheet($i)->getStyle("0:$j")->getFont()->setBold(true);
                    $obj->getSheet($i)->setCellValueByColumnAndRow(0,$j,$row->type_name);
                    $j++;
                }
                if ($user == ($row->author))
                {
                    $obj->getSheet($i)->setCellValueByColumnAndRow(0,$j, $row->content );
                    $j++;
                }    
            }
            $j++;
            $queryB=$this->db->get('award');
            $obj->getSheet($i)->getStyleByColumnAndRow(0,$j)->getFont()->setBold(true);
            $obj->getSheet($i)->setCellValueByColumnAndRow(0,$j,'Award');
            $j++;
            foreach($queryB->result() as $row)
            {
                if ($user== $row->name){
                    $obj->getSheet($i)->setCellValueByColumnAndRow(0,$j, $row->year );
                    $obj->getSheet($i)->setCellValueByColumnAndRow(1,$j, $row->title );
                    $j++;
                }
            }
            //$obj->getSheet($i)->setCellValueByColumnAndRow(0,1,$row->UniqueID);
            $i++;
        }
         
        $filename='demo1.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
}