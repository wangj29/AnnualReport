<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class MYExcel3 extends CI_Controller {
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
        $countEach=0;
        $type='';
        foreach($query->result() as $row)
        {
            if ($type!== $row->type)
            {
                $i++;
                if ($type!==''){
                $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i, "Count:" );
                $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$i, $countEach );
                $countEach=0;
                $i+=2;
            }
                $type = $row->type;
                $obj->getActiveSheet()->getStyle("0:$i")->getFont()->setBold(true);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i,$row->type_name);
                    $i++;
                
            }
             $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i, $row->content );
             $i++;
             $countEach++;
        }
        $i++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$i, $countEach );
        
        $i+=2;
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $i)->getFont()->setBold(true);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i,'Award');
        $this->db->order_by('type asc');
        $queryB=$this->db->get('award');
        $i++;
        $countAward=0;
        $type='';
        foreach($queryB->result() as $row)
            {
                $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i, $row->name );
                $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$i, $row->year );
                $obj->getActiveSheet()->setCellValueByColumnAndRow(2,$i, $row->title );
                $i++;
                $countAward++;
            }
        $i++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$i, $countAward );
        
        $obj->createSheet(1);
        $obj->getSheet(1)->setTitle('Book');
        $obj->getSheet(1)->getColumnDimension('A')->setWidth(50);
        $obj->getSheet(1)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(1)->setCellValueByColumnAndRow(0,1,'Book/Book Chapter');
        $this->db->order_by('type asc');
        $query=$this->db->get('publication');
        $i=2;
        $countBook=0;
        $type='';
        foreach($query->result() as $row)
        {
            if ($row->type == 'book' )
            {
                $obj->getSheet(1)->setCellValueByColumnAndRow(0,$i, $row->content );
                $i++;
                $countBook++;
            }
        }
        $i++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$i, $countBook );
        
        
        $obj->createSheet(2);
        $obj->getSheet(2)->setTitle('Conference');
        $obj->getSheet(2)->getColumnDimension('A')->setWidth(50);
        $obj->getSheet(2)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(2)->setCellValueByColumnAndRow(0,1,'Conference');
        $this->db->order_by('type asc');
        $query=$this->db->get('publication');
        $i=2;
        $countConference=0;
        $type='';
        foreach($query->result() as $row)
        {
            if ($row->type == 'conference' )
            {
                $obj->getSheet(2)->setCellValueByColumnAndRow(0,$i, $row->content );
                $i++;
                $countConference++;
            }
        }
        $i++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$i, $countConference );
        
        $obj->createSheet(3);
        $obj->getSheet(3)->setTitle('Journal');
        $obj->getSheet(3)->getColumnDimension('A')->setWidth(50);
        $obj->getSheet(3)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(3)->setCellValueByColumnAndRow(0,1,'Journal');
        $this->db->order_by('type asc');
        $query=$this->db->get('publication');
        $i=2;
        $countJournal=0;
        $type='';
        foreach($query->result() as $row)
        {
            if ($row->type == 'journal' )
            {
                $obj->getSheet(3)->setCellValueByColumnAndRow(0,$i, $row->content );
                $i++;
                $countJournal++;
            }
        }
        $i++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$i, $countJournal );
        
        $obj->createSheet(4);
        $obj->getSheet(4)->setTitle('Award');
        $obj->getSheet(4)->getColumnDimension('A')->setWidth(30);
        $obj->getSheet(4)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(4)->setCellValueByColumnAndRow(0,1,'Award');
        $this->db->order_by('type asc');
        $queryB=$this->db->get('award');
        $i=2;
        $type='';
        foreach($queryB->result() as $row)
            {
                $obj->getSheet(4)->setCellValueByColumnAndRow(0,$i, $row->name );
                $obj->getSheet(4)->setCellValueByColumnAndRow(1,$i, $row->year );
                $obj->getSheet(4)->setCellValueByColumnAndRow(2,$i, $row->title );
                $i++;
            }
        $i++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$i, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$i, $countAward );
         
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