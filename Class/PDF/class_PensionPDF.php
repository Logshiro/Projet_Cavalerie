<?php

include "class_Fpdf.php";
include "../class_pension.php";

class PensionPDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('../../image/logo.png',10,6,20);
        // Changement de Arial à Helvetica
        $this->SetFont('Helvetica','B',15);
        // Décalage à droite
        $this->Cell(50);
        
        // Définir la couleur de fond rouge pour la cellule de titre
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255,255,255);
        // Titre
        $this->Cell(120,10,'Instance de Pension',1,0,'C',true);
        $this->Ln(20);
    }

    function FancyTable($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        // Changement de Arial à Helvetica
        $this->SetFont('Helvetica','B',12);

        // Largeurs des colonnes (adjusted to match 5 columns)
        $w = array(40, 35, 35, 40, 40);

        // En-tête
        foreach($header as $i => $col) {
            $this->Cell($w[$i],7,$col,1,0,'C',true);
        }
        $this->Ln();

        // Restauration des couleurs et de la police
        $this->SetFillColor(255,230,230);
        $this->SetTextColor(0);
        // Changement de Arial à Helvetica
        $this->SetFont('Helvetica','',11);

        // Données
        $fill = false;
        foreach($data as $row) {
            $pension = new Pension('','','','','','');
            $cavalier = $pension->getPensionCavalerie($row['RefNumSir']);
            
            $this->Cell($w[0],6,$cavalier,'LR',0,'C',$fill);
            $this->Cell($w[1],6,$row['LibPension'],'LR',0,'C',$fill);
            $this->Cell($w[2],6,$row['Tarifs'],'LR',0,'C',$fill);
            $this->Cell($w[3],6,$row['DateDebutP'],'LR',0,'C',$fill);
            $this->Cell($w[4],6,$row['DateFinP'],'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Trait de terminaison
        $this->Cell(array_sum($w),0,'','T');
    }

    function Footer()
    {
        $this->SetY(-15);
        // Changement de Arial à Helvetica
        $this->SetFont('Helvetica','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    // Chargement des données via la classe Pension
    function LoadDataFromPension()
    {
        // Instancier la classe Pension
        $pension = new Pension('','');
        // Récupérer les données depuis la base de données
        $data = $pension->pension_all();
        // Retourner les données récupérées sous forme de tableau
        return $data;
    }
}

// Création du PDF
$pdf = new PensionPDF();
$pdf->AliasNbPages();
// Changement de Arial à Helvetica
$pdf->SetFont('Helvetica','',12);
$header = array('Cavalerie', 'Pension', 'Tarifs en euros', 'Date de debut', 'Date de fin');
$data = $pdf->LoadDataFromPension();
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>

