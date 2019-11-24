<?php
    require "fpdf.php";
    
    $db = new PDO('mysql:host=localhost;dbname=dkut_scheduling_system;','root','');
    //$reg = 'C025-02-0029/2015'; 
    
    class myPDF extends FPDF{
        function header(){
            $serial = 'Serial: 0010'.rand(123,999);
            $this->Image('logo.png',10,6);
            $this->SetFont('Arial','B',14);
            $this->Cell(276,5,'BATIAN FAMILY MEDICAL CLINIC',0,0,'C');
            $this->Ln();
            $this->SetFont('Times','',12);
            $this->Cell(276, 10, 'P.O BOX 1590 -10100',0,0,'C');
            $this->Ln();
            $this->Cell(276, 10, 'NyeriTown',0,0,'C');
            $this->Ln(20);
            $this->Cell(276, 10, 'Registered Specialists',0,0,'L');
            $this->Ln(10);
        }
        function footer(){
            $this->SetY(-26);
            $this->SetFont('Arial','',8);
            $this->Ln();
            $this->Cell(0,10,'Batian family medical clinic',0,0,'C');
            $this->Ln();
            $this->Cell(0,10,'Page',0,0,'C');
        }

        function docHeader(){
            $this->SetFont('Times','',12);
            $this->Cell(10,10,'id#',1,0,'C');
            $this->Cell(40,10,'first name',1,0,'C');
            $this->Cell(40,10,'last name',1,0,'C');
            $this->Cell(70,10,'Email',1,0,'C');
            $this->Cell(40,10,'Category',1,0,'C');
            $this->Ln();
        }
        function docs($db){
            $this->SetFont('Times','',12);

            $stmt = $db->query("SELECT *FROM doctors ORDER BY id");
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $this->Cell(10,10,$data->id,1,0,'L');
                $this->Cell(40,10,$data->fname,1,0,'L');
                $this->Cell(40,10,$data->lname,1,0,'L');
                $this->Cell(70,10,$data->email,1,0,'L');
                $this->Cell(40,10,$data->categoryname,1,0,'L');
                $this->Ln();
            }
        }

        function headerTable(){
            $this->SetFont('Times','',12);
            $this->Cell(10,10,'id#',1,0,'C');
            $this->Cell(40,10,'patient',1,0,'C');
            $this->Cell(30,10,'datescheduled',1,0,'C');
            $this->Cell(40,10,'status',1,0,'C');
            $this->Cell(30,10,'timescheduled',1,0,'C');
            $this->Cell(20,10,'Doc ID#',1,0,'C');
            $this->Cell(30,10,'Category',1,0,'C');
            //$this->Cell(70,10,'Description',1,0,'C');
            $this->Ln();
        }
        function viewUsers($db){
            $this->SetFont('Times','',12);

            $stmt = $db->query("SELECT *FROM schedules WHERE status='COMPLETED' ORDER BY status, date_scheduled, time_scheduled");
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $this->Cell(10,10,$data->id,1,0,'L');
                $this->Cell(40,10,$data->pat_name,1,0,'L');
                $this->Cell(30,10,$data->date_scheduled,1,0,'L');
                $this->Cell(40,10,$data->status,1,0,'L');
                $this->Cell(30,10,$data->time_scheduled,1,0,'L');
                $this->Cell(20,10,$data->doc_id,1,0,'C');
                $this->Cell(30,10,$data->category,1,0,'L');
                //$this->Cell(70,10,$data->description,1,0,'L');
                $this->Ln();
            }
        }

        function additioalinfo0(){
            // $this->Image('logo.png',10,6);
            $this->SetFont('Arial','B',14);
            $this->Cell(276,5,'BATIAN MEDICAL',0,0,'L');
            $this->Ln();
            $this->SetFont('Times','',12);
            $this->Cell(276, 10, 'Users in the system',0,0,'L');
            $this->Ln(20);
        }

        function progressheader(){
            $this->SetFont('Times','',12);
            $this->Cell(30,10,'Progress',1,0,'C');
            $this->Cell(40,10,'Date',1,0,'C');
            $this->Cell(40,10,'time',1,0,'C');
            $this->Cell(50,10,'Officer Sig.',1,0,'C');
            $this->Cell(40,10,'Student Sig',1,0,'C');
            $this->Cell(40,10,'Stamp',1,0,'C');
            $this->Ln();
        }
        function viewcollection(){
            $this->SetFont('Times','',12);
            $this->Cell(30,20,'Collection',1,0,'C');
            $this->Cell(40,20,' ',1,0,'C');
            $this->Cell(40,20,' ',1,0,'C');
            $this->Cell(50,20,' ',1,0,'C');
            $this->Cell(40,20,' ',1,0,'C');
            $this->Cell(40,20,' ',1,0,'C');
            $this->Ln();
        }
        function viewreturn(){
            $this->SetFont('Times','',12);
            $this->Cell(30,20,'Return',1,0,'C');
            $this->Cell(40,20,' ',1,0,'C');
            $this->Cell(40,20,' ',1,0,'C');
            $this->Cell(50,20,' ',1,0,'C');
            $this->Cell(40,20,' ',1,0,'C');
            $this->Cell(40,20,' ',1,0,'C');
            $this->Ln(20);
        }

        function additioalinfo2(){
            $this->SetFont('Arial','B',14);
            $this->Cell(276,5,'Seal',0,0,'C');
            $this->getY();
            $this->Image('cleared.png',170,45);
            $this->Ln();
            $this->SetFont('Times','',12);
            $this->Ln(20);
        }
        function space(){
            $this->Ln(10);
            $this->SetFont('Arial','B',14);
            $this->Cell(276,5,'ALL SCHEDULES AND THEIR ALLOCATED SPECIALISTS',0,0,'L');
            $this->Ln(10);
        }
    }  

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->docHeader();
    $pdf->docs($db);
    $pdf->space();
    $pdf->headerTable();
    $pdf->viewUsers($db);
    $pdf->output();
?>