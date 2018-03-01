<?php

ini_set('max_execution_time', 0);
$raw = file_get_contents("http://api.gw2tp.com/1/bulk/items.csv");

$data = explode("\n", $raw);

$printout="Name,Profit,Buy Price,Sell Price,Demand,Supply,Margin\n";
for ($i = 1; $i < count($data); $i++) {
	$row = explode(",", $data[$i]);
	$max_offer_unit_price = $row[2];
	$min_sale_unit_price = $row[3];
	$sale_availability =  $row[4];
	$offer_availability =  $row[5];
	
	
	
	if (strpos($row[1], ' Skin') !== FALSE) {
		$printout .=  $row[1].','.$row[2].','.$row[3]."\n";
	}
}
file_put_contents("gw2tpskin.csv", $printout);


//Offer is buying amount, as in what person is ok to buy
//Sale is on sale amount, this should always be bigger than Offer + 15%

//minimum criteria
//$profit needs to be at least equal or greater than max_offer_unit_price
?>