<?php

include "class_Fpdf.php";
include "../class_evenement.php";

class EvenementPDF extends FPDF
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
        $this->Cell(120,10,'Instance des Evenements',1,0,'C',true);
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

        // Données idEvenement,TitreE,CommentaireE
        $fill = false;
        foreach($data as $row) {
            $this->Cell($w[0],6,$row['idEvenement'],'LR',0,'C',$fill);
            $this->Cell($w[1],6,$row['TitreE'],'LR',0,'C',$fill);
            $this->Cell($w[2],6,$row['CommentaireE'],'LR',0,'C',$fill);
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

    // Chargement des données via la classe Evenement
    function LoadDataFromEvenement()
    {
        // Instancier la classe Evenement
        $evenement = new Evenement('','','');
        // Récupérer les données depuis la base de données
        $data = $evenement->Evenement_All();
        // Retourner les données récupérées sous forme de tableau
        return $data;
    }
}

// Création du PDF
$pdf = new EvenementPDF();
$pdf->AliasNbPages();
// Changement de Arial à Helvetica
$pdf->SetFont('Helvetica','',12);
$header = array('ID Evenement', 'Titre Evenement', 'Commentaire Evenement');
$data = $pdf->LoadDataFromEvenement();
$pdf->AddPage();
$pdf->FancyTable($header,$data);
$pdf->Output();
?>

