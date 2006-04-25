<?php


// draw a broken line
$width=3;
$area=216;
$pad=2;

for ($i=10;$i<200;$i++) {
	$linePos=array($i,$area,$width);
	$pdf->drawLine($linePos);
	$i = (($i+$width)+$pad)-1;
}


// company addy
$companyBlockPositions=array( "10","220","60" );
$companyText=$org_address."\n".$org_city.", ".$org_state." ".$org_code." ".$org_country;
$pdf->addTextBlock( $org_name, $companyText ,$companyBlockPositions );


// billing Address
$billPositions = array("85","235","60");
$billText=$bill_street."\n".$bill_city.", ".$bill_state." ".$bill_code."\n".$bill_country;
$pdf->addTextBlock("Billing Address:",$billText, $billPositions);

// totals
$totalBlock=array("155","235","4", "110");
$totalText="SubTotal:      ".$price_subtotal."\n".
	   "Tax:              ".$price_tax."\n".
	   "Adjustment:  ".$price_adjustment."\n".
	   "Total:            ".$price_total;
$pdf->addDescBlock($totalText, "Total Due", $totalBlock);

$blurbBlock=array("10","265","150", "60");
$blockText="Detach on above line and send a check, money order or cashiers check in the provided envelope";
$pdf->addDescBlock($blockText, "Instructions", $blurbBlock);

?>
