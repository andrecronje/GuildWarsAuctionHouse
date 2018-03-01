<?php

ini_set('max_execution_time', 0);
$raw = file_get_contents("item.csv");
$data = explode("\n", $raw);

$printout="Name,Profit,Buy Price,Sell Price,Demand,Supply,Margin\n";
for ($i = 1; $i < count($data); $i++) {
	$row = explode(",", $data[$i]);
	$max_offer_unit_price = $row[2];
	$min_sale_unit_price = $row[3];
	$sale_availability =  $row[4];
	$offer_availability =  $row[5];
	


	if ($max_offer_unit_price == 0) {
		continue;
	}
	if ($min_sale_unit_price == 0) {
		continue;
	}
	if ($sale_availability < 6) {
		continue;
	}
	
	
	$issellable = false;
	if ($offer_availability > $sale_availability) {
		$issellable = true;
	} else {
		continue;
	}
	
	$profit = (($min_sale_unit_price * 0.85)-1) - ($max_offer_unit_price+1);
	$isprofitable = false;
	
	$margin = $profit / $max_offer_unit_price * 100;
	if ($margin > 100) {
		continue;
	} else if ($margin < 20) {
		continue;
  } else if ($profit < 10000) {
		continue;
	} else {
		$isprofitable = true;
	}
	if ($isprofitable&&$issellable) {
	//Level,Rarity,Item Type
		$printout .=  $row[1].','.$profit.','.$max_offer_unit_price.','.$min_sale_unit_price.','.$offer_availability.','.$sale_availability.','.$margin."\n";
	}
}
file_put_contents("gw2tp.csv", $printout);


//Offer is buying amount, as in what person is ok to buy
//Sale is on sale amount, this should always be bigger than Offer + 15%

//minimum criteria
//$profit needs to be at least equal or greater than max_offer_unit_price
?>