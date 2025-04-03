<?php

include "class_Fpdf.php";
include "../class_race.php";

class RacePDF extends FPDF
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
        $this->Cell(120,10,'Instance de Race',1,0,'C',true);
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

        // Largeurs des colonnes
        $w = array(40, 50, 100);

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
            $this->Cell($w[0],6,$row['idRace'],'LR',0,'C',$fill);
            $this->Cell($w[1],6,$row['LibRace'],'LR',0,'C',$fill);
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

    // Chargement des données via la classe Race
    function LoadDataFromRace()
    {
        // Instancier la classe Race
        $race = new Race('','');
        // Récupérer les données depuis la base de données
        $data = $race->race_all();
        // Retourner les données récupérées sous forme de tableau
        return $data;
    }
}

// Création du PDF
$pdf = new RacePDF();
$pdf->AliasNbPages();
// Changement de Arial à Helvetica
$pdf->SetFont('Helvetica','',12);
$header = array('ID Race', 'Libelle Race');
$data = $pdf->LoadDataFromRace();
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>

