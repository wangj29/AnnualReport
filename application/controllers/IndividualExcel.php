<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class IndividualExcel extends CI_Controller {
    function __construct()
    {
      parent::__construct();
    }
    function index()
    {
        //load our new PHPExcel library
        
        $this->load->library('excel');
        $obj=new PHPExcel();
        
        $user=$this->session->userdata('username');
        $i=0;
        $query=$this->db->get('faculty');
        
        foreach ($query->result() as $row){
            if ($user==$row->uniqueid){
                //$obj->createSheet($i);
                //$obj->getSheet($i)->setTitle($row->faculty_fullname);
                $obj->getActiveSheet()->setTitle($row->faculty_name);
            }
            
            $this->db->order_by('type asc');
            $queryA=$this->db->get('publication');
            $j=0;
            $countEach=0;
            $type='';
            foreach($queryA->result() as $row)
            {
                if ($type!== $row->type)
                {
                    $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$j, "Count:" );
                    $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$j, $countEach );
                    $countEach=0;
                    $j+=2;
                    $type = $row->type;
                    //$obj->getSheet($i)->getStyle("0:$j")->getFont()->setBold(true);
                    //$obj->getSheet($i)->setCellValueByColumnAndRow(0,$j,$row->type_name);
                    $obj->getActiveSheet()->getStyle("0:$j")->getFont()->setBold(true);
                    //$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$j,$row->type_name);
                    $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$j,$row->type);
                    $j++;
                }
                if ($user == ($row->author))
                {
                    //$obj->getSheet($i)->setCellValueByColumnAndRow(0,$j, $row->content );
                    $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$j, $row->content );
                    $j++;
                    $countEach++;
                }
            }
            $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$j, "Count:" );
            $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$j, $countEach );
            $j+=2;
            $queryB=$this->db->get('award');
            //$obj->getSheet($i)->getStyleByColumnAndRow(0,$j)->getFont()->setBold(true);
            //$obj->getSheet($i)->setCellValueByColumnAndRow(0,$j,'Award');
            $obj->getActiveSheet()->getStyleByColumnAndRow(0,$j)->getFont()->setBold(true);
            $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$j,'Award');
            $j++;
            $countAward=0;
            foreach($queryB->result() as $row)
            {
                if ($user== $row->name){
                    //$obj->getSheet($i)->setCellValueByColumnAndRow(0,$j, $row->year );
                    //$obj->getSheet($i)->setCellValueByColumnAndRow(1,$j, $row->title );
                    $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$j, $row->year );
                    $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$j, $row->title );
                    $j++;
                    $countAward++;
                }
            }
            $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$j, "Count:" );
            $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$j, $countAward );
            
            //$obj->getSheet($i)->setCellValueByColumnAndRow(0,1,$row->UserID);
        }
         
        $filename='demo4.xls'; //save our workbook as this file name
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