<?php

require_once "conexion.php";
require_once 'fpdf/fpdf.php';

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: logIn.html");
} else {
    $user = $_SESSION['user'];
}

$sql = mysqli_query($con, "SELECT * FROM usuario WHERE correo='$user'");
$data = mysqli_fetch_assoc($sql);

$sqlV = mysqli_query($con, "SELECT * FROM ventas WHERE usuario='$user'");

$Total = $_POST['total'];
$SubTotal = $_POST['subtotal'];

ob_start();
?>

<?php
class PDF extends FPDF
{
    function Header()
    {
        $this->Image('img/logo_s.png', 270, 5, 20);
        $this->SetFont('Arial', 'B', 20); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(45); // Movernos a la derecha
        $this->SetTextColor(239, 184, 16); //color
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 10, 'PostMortem - Detalles de Compra', 0, 1, 'L');
        $this->Ln(10);

    }

    function Footer()
    {
        $this->SetY(-25);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Gracias por comprar en Post Mortem Cualquier duda o aclaracion, comuniquese al numero: 33282303567.', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

        $this->SetFont('Arial', 'I', 8); 
        $hoy = date('d/m/Y');
        $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'R');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();

$pdf->SetFont('Arial', 'B', 12);

$pdf->Ln(10);
$pdf->Cell(0, 10, 'Datos personales', 0, 1, 'L');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Nombre: ' . $data['nombre'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Correo: ' . $data['correo'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Edad: ' . $data['edad'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Ciudad: ' . $data['ciudad'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Estado: ' . $data['estado'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Direccion: ' . $data['direccion'], 0, 1, 'L');
$pdf->Cell(0, 10, 'CEL: ' . $data['cel'], 0, 1, 'L');

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(110, 10, 'Datos de Compra ' . $c, 0, 1, 'L');

$pdf->Ln(10);

$pdf->SetFillColor(239, 184, 16); //colorFondo
$pdf->SetTextColor(0, 0, 0); //colorTexto
$pdf->SetDrawColor(163, 163, 163); //colorBorde
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(55, 10, utf8_decode('NOMBRE DEL PRODUCTO'), 1, 0, 'C', 1);
$pdf->Cell(50, 10, utf8_decode('SABOR'), 1, 0, 'C', 1);
$pdf->Cell(55, 10, utf8_decode('CANTIDAD DE ALCOHOL'), 1, 0, 'C', 1);
$pdf->Cell(30, 10, utf8_decode('PRECIO'), 1, 1, 'C', 1);

$c = 1;
while ($dataV = mysqli_fetch_assoc($sqlV)) {
    $pdf->SetFillColor(255, 255, 255); //colorFondo
    $pdf->SetTextColor(0, 0, 0); //colorTexto
    $pdf->SetDrawColor(163, 163, 163); //colorBorde
    $pdf->SetFont('Arial', '', 11);
    $pdf->Cell(55, 10, '' . $dataV['nombre_p'], 1, 0, 'C', 1);
    $pdf->Cell(50, 10, '' . $dataV['sabor'], 1, 0, 'C', 1);
    $pdf->Cell(55, 10, '' . $dataV['cant_alcohol'], 1, 0, 'C', 1);
    $pdf->Cell(30, 10, 'MXN $' . $dataV['precio'], 1, 0, 'C', 1);
    $pdf->Ln(10);
    $c++;
}

$pdf->Ln(10);
$pdf->SetFillColor(239, 184, 16); //colorFondo
$pdf->SetTextColor(0, 0, 0); //colorTexto
$pdf->SetDrawColor(163, 163, 163); //colorBorde
$pdf->Cell(110, 10, 'PAGO', 1, 1, 'C', 1);
$pdf->Cell(110, 10, 'Subtotal: MXN $' . $SubTotal, 1, 1, 'C');
$pdf->Cell(110, 10, 'Total: MXN $' . $Total, 1, 1, 'C');

$pdf->Output('Ticket.pdf', 'F');

// Enviar correo
require_once 'correo.php';

try {
    mandar_correo('Ticket.pdf', $data['correo']);
    header('Location: productos.php');
} catch (Exception $e) {
    echo "Error al enviar el correo electrónico de la compra: {$e->getMessage()}";
}

?>