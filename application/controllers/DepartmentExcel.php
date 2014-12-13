<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class DepartmentExcel extends CI_Controller {
    function __construct()
    {
      parent::__construct();
    }
    function IdToName($userId){
        $this -> db -> where('uniqueid',$userId);
        $query=$this->db->get('faculty');
        return $query->row()->faculty_name;
    }
    function index()
    {
        //load our new PHPExcel library
        
        $this->load->library('excel');
        $obj=new PHPExcel();
        $YearDecrease=$this->input->post('year');
        //$YearDecrease=5;
        $obj->getActiveSheet()->setTitle('Department');
        $obj->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,1,'Publication');
        $time = date('Y');
        $RangeYear=$time-$YearDecrease;
        
        $this->db->order_by('year desc');
        $query=$this->db->get('publication');
        $col=2;
        $countEach=0;
        //$type='';
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
        $col++;
        foreach ($query->result() as $row)
        {
            
            if ($time<$RangeYear){
                    break;
                }
            if ($time!=$row->year)
            {
                while ($time>$row->year){
                        $time--;
                        $col++;
                        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
                        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
                        $col++;
                    }
                    if ($time<$RangeYear){
                    break;
                }
            }
            $type = $row->type;
            $FullName=$this->IdToName($row->author);
            $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$FullName);
            $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col,$row->type);
            $obj->getActiveSheet()->setCellValueByColumnAndRow(2,$col,$row->content);
            $col++;
        }
        
        $col+=2;
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(16);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,'Award');
        $this->db->order_by('year desc');
        $queryB=$this->db->get('award');
        $col++;
        $countAward=0;
        $time = date('Y');
        //$type='';
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
        $col++;
        foreach($queryB->result() as $row)
            {
                if ($time==$RangeYear){
                    break;
                }
                if ($time!=$row->year)
                {
                while ($time>$row->year){
                        $time--;
                        $col++;
                        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
                        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
                        $col++;
                    }
                }
                $FullName=$this->IdToName($row->name);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col, $FullName );
                $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col, $row->title );
                $col++;
                $countAward++;
            }
        $col++;
        //$obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col, "Count:" );
        //$obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col, $countAward );
        
        $obj->createSheet(1);
        $obj->getSheet(1)->setTitle('Book');
        $obj->getSheet(1)->getColumnDimension('A')->setWidth(20);
        $obj->getSheet(1)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(1)->setCellValueByColumnAndRow(0,1,'Book');
        $this->db->order_by('year desc');
        $query=$this->db->get('publication');
        $col=2;
        $countBook=0;
        //$type='';
        $time = date('Y');
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
        $col++;
        foreach($query->result() as $row)
        {
            if ($time==$RangeYear){
                    break;
                }
             if ($time!=$row->year)
            {
                while ($time>$row->year){
                        $time--;
                        $col++;
                        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
                        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
                        $col++;
                    }
            }
            if ($row->type == 'Book' )
            {
                $FullName=$this->IdToName($row->author);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$FullName);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col,$row->status);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(2,$col,$row->content);
                $col++;
                $countBook++;
            }
        }
        $col++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col, $countBook );
        
         $obj->createSheet(2);
        $obj->getSheet(2)->setTitle('Book Chapter');
        $obj->getSheet(2)->getColumnDimension('A')->setWidth(20);
        $obj->getSheet(2)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(2)->setCellValueByColumnAndRow(0,1,'Book Chapter');
        $this->db->order_by('year desc');
        $query=$this->db->get('publication');
        $col=2;
        $countChapter=0;
        //$type='';
        $time = date('Y');
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
        $col++;
        foreach($query->result() as $row)
        {
            if ($time==$RangeYear){
                    break;
                }
             if ($time!=$row->year)
            {
                while ($time>$row->year){
                        $time--;
                        $col++;
                        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
                        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
                        $col++;
                    }
            }
            if ($row->type == 'chapter' )
            {
                $FullName=$this->IdToName($row->author);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$FullName);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col,$row->status);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(2,$col,$row->content);
                $col++;
                $countChapter++;
            }
        }
        $col++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col, $countChapter );
        
        $obj->createSheet(3);
        $obj->getSheet(3)->setTitle('Conference');
        $obj->getSheet(3)->getColumnDimension('A')->setWidth(20);
        $obj->getSheet(3)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(3)->setCellValueByColumnAndRow(0,1,'Conference');
        $this->db->order_by('year desc');
        $query=$this->db->get('publication');
        $col=2;
        $countConference=0;
        $type='';
        $time = date('Y');
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
        $col++;
        foreach($query->result() as $row)
        {
            if ($time==$RangeYear){
                    break;
                }
            if ($time!=$row->year)
            {
                while ($time>$row->year){
                        $time--;
                        $col++;
                        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
                        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
                        $col++;
                    }
            }
            if ($row->type == 'Conference' )
            {
                $FullName=$this->IdToName($row->author);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$FullName);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col,$row->status);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(2,$col,$row->content);
                $col++;
                $countConference++;
            }
        }
        $col++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col, $countConference );
        
        $obj->createSheet(4);
        $obj->getSheet(4)->setTitle('Journal');
        $obj->getSheet(4)->getColumnDimension('A')->setWidth(20);
        $obj->getSheet(4)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(4)->setCellValueByColumnAndRow(0,1,'Journal');
        $this->db->order_by('year desc');
        $query=$this->db->get('publication');
        $col=2;
        $countJournal=0;
        $type='';
        $time = date('Y');
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
        $col++;
        foreach($query->result() as $row)
        {
            if ($time==$RangeYear){
                    break;
                }
            if ($time!=$row->year)
            {
                while ($time>$row->year){
                        $time--;
                        $col++;
                        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
                        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
                        $col++;
                    }
                //$this->ExcelFunction->DisplayYear($time, $col, $obj);
            }
            if ($row->type == 'Journal' )
            {
                $FullName=$this->IdToName($row->author);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$FullName);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col,$row->status);
                $obj->getActiveSheet()->setCellValueByColumnAndRow(2,$col,$row->content);
                $col++;
                $countJournal++;
            }
        }
        $col++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col, $countJournal );
        
        $obj->createSheet(5);
        $obj->getSheet(5)->setTitle('Award');
        $obj->getSheet(5)->getColumnDimension('A')->setWidth(20);
        $obj->getSheet(5)->getStyleByColumnAndRow(0, 1)->getFont()->setBold(true)->setSize(16);
        $obj->getSheet(5)->setCellValueByColumnAndRow(0,1,'Award');
        $this->db->order_by('year desc');
        $queryB=$this->db->get('award');
        $col=2;
        $type='';
        $time = date('Y');
        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
        $col++;
        foreach($queryB->result() as $row)
            {
                if ($time==$RangeYear){
                    break;
                }
                if ($time!=$row->year)
                {
                    //for (;$time!=$row->year;$time--)
                    while ($time>$row->year){
                        $time--;
                        $col++;
                        $obj->getActiveSheet()->getStyleByColumnAndRow(0, $col)->getFont()->setBold(true)->setSize(12);
                        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col,$time);
                        $col++;
                    }
                //$this->ExcelFunction->DisplayYear($time, $col, $obj);
                }
                $FullName=$this->IdToName($row->name);
                $obj->getSheet(5)->setCellValueByColumnAndRow(0,$col, $FullName );
                //$obj->getSheet(4)->setCellValueByColumnAndRow(2,$col, $row->year );
                $obj->getSheet(5)->setCellValueByColumnAndRow(1,$col, $row->title );
                $col++;
            }
        $col++;
        $obj->getActiveSheet()->setCellValueByColumnAndRow(0,$col, "Count:" );
        $obj->getActiveSheet()->setCellValueByColumnAndRow(1,$col, $countAward );
         
        $filename='demoDepartment.xls'; //save our workBook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
                     
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
        //fixed the formtat to make it download normally
        ob_end_clean();
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
}