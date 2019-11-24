<?php
    require "fpdf.php";
    
    $db = new PDO('mysql:host=localhost;dbname=dkut_clearance_system;','root','');
    //$reg = 'C025-02-0029/2015'; 
    
    class myPDF extends FPDF{
        function header(){
            $serial = 'Serial: 0010'.rand(123,999);
            $this->Image('logo.png',10,6);
            $this->SetFont('Arial','B',14);
            $this->Cell(276,5,'GAWN COLLECTION FORM',0,0,'C');
            $this->Ln();
            $this->SetFont('Times','',12);
            $this->Cell(276, 10, 'Student Gawn Collection Form',0,0,'C');
            $this->Ln();
            $this->Cell(276, 10, $serial,0,0,'C');
            $this->Ln(40);
        }
        function footer(){
            $this->SetY(-26);
            $this->SetFont('Arial','',8);
            $this->Ln();
            $this->Cell(0,10,'Dedan Kimathi University Clearance System [GOWN COLLECTION]',0,0,'C');
            $this->Ln();
            $this->Cell(0,10,'Page',0,0,'C');
        }
        function headerTable(){
            $this->SetFont('Times','',12);
            $this->Cell(30,10,'student#',1,0,'C');
            $this->Cell(70,10,'Registration',1,0,'C');
            $this->Cell(70,10,'Email',1,0,'C');
            $this->Ln();
        }
        function viewUser($db){
            $this->SetFont('Times','',12);
            if (isset($_GET['reg'])){
                $reg = $_GET['reg'];
            }
             
            $stmt = $db->query("SELECT *FROM users where username='$reg'");
            while($data = $stmt->fetch(PDO::FETCH_OBJ)){
                $this->Cell(30,10,$data->id,1,0,'C');
                $this->Cell(70,10,$data->username,1,0,'L');
                $this->Cell(70,10,$data->email,1,0,'L');
                $this->Ln(20);
            }
        }

        function additioalinfo0(){
            // $this->Image('logo.png',10,6);
            $this->SetFont('Arial','B',14);
            $this->Cell(276,5,'GAWN COLLECTION PROGRESS ',0,0,'L');
            $this->Ln();
            $this->SetFont('Times','',12);
            $this->Cell(276, 10, 'Follow the following procedures towards collecting and returning of the graduation gawn ',0,0,'L');
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
    }  

    $pdf = new myPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L','A4',0);
    $pdf->headerTable();
    $pdf->viewUser($db);
    $pdf->additioalinfo0();
    $pdf->progressheader();
    $pdf->viewcollection();
    $pdf->viewreturn();
    $pdf->additioalinfo2();
    $pdf->output();

?>