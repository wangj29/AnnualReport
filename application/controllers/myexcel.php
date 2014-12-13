<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class MYExcel extends CI_Controller {
    function __construct()
    {
      parent::__construct();
    }
    function index()
    {
        //load our new PHPExcel library
        
        $this->load->library('excel');
        $obj=new PHPExcel();
        
            
        $obj->getActiveSheet()->setTitle('Department');
        $obj->getActiveSheet()->getColumnDimension('A')->setWidth(50);
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,1,'Publication');
        
        $this->db->order_by('type asc');
        $query=$this->db->get('publication');
        $i=2;
        $type='';
        foreach($query->result() as $row)
        {
            if ($type!== $row->type)
            {
                $i++;
                $type = $row->type;
                $obj->getActiveSheet()->getStyle("0:$i")->getFont()->setBold(true);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i,$row->type_name);
                    $i++;
                
            }
             $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i, $row->content );
             $i++;
        }
        
        $obj->createSheet(1);
        $obj->getSheet(1)->setTitle('Book');
        $obj->getSheet(1)->getColumnDimension('A')->setWidth(50);
        $obj->getSheet(1)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(1)->setCellValueByColumnAndRow(0,1,'Book/Book Chapter');
        $this->db->order_by('type asc');
        $query=$this->db->get('publication');
        $i=2;
        $type='';
        foreach($query->result() as $row)
        {
            if ($row->type == 'book' )
            {
                $obj->getSheet(1)->setCellValueByColumnAndRow(0,$i, $row->content );
                $i++;
            }
        }
        
        
        $obj->createSheet(2);
        $obj->getSheet(2)->setTitle('Conference');
        $obj->getSheet(2)->getColumnDimension('A')->setWidth(50);
        $obj->getSheet(2)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(2)->setCellValueByColumnAndRow(0,1,'Conference');
        $this->db->order_by('type asc');
        $query=$this->db->get('publication');
        $i=2;
        $type='';
        foreach($query->result() as $row)
        {
            if ($row->type == 'conference' )
            {
                $obj->getSheet(2)->setCellValueByColumnAndRow(0,$i, $row->content );
                $i++;
            }
        }
        
        $obj->createSheet(3);
        $obj->getSheet(3)->setTitle('Journal');
        $obj->getSheet(3)->getColumnDimension('A')->setWidth(50);
        $obj->getSheet(3)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(3)->setCellValueByColumnAndRow(0,1,'Journal');
        $this->db->order_by('type asc');
        $query=$this->db->get('publication');
        $i=2;
        $type='';
        foreach($query->result() as $row)
        {
            if ($row->type == 'journal' )
            {
                $obj->getSheet(3)->setCellValueByColumnAndRow(0,$i, $row->content );
                $i++;
            }
        }
        
        
        $i=4;
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
            
            $i++;
        }
         
        $filename='demo.xls'; //save our workbook as this file name
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