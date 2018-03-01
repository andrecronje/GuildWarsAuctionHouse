<?php

ini_set('max_execution_time', 0);
$raw = file_get_contents("results.txt");

$data = json_decode($raw, true);

$printout="Name,Profit,Buy Price,Sell Price,Demand,Supply,Margin,Level,Rarity,Item Type\n";
for ($i = 0; $i < count($data["results"]); $i++) {

	$max_offer_unit_price = $data["results"][$i]["max_offer_unit_price"];
	$min_sale_unit_price = $data["results"][$i]["min_sale_unit_price"];
	$offer_availability =  $data["results"][$i]["offer_availability"];
	$sale_availability =  $data["results"][$i]["sale_availability"];
	$sale_price_change_last_hour =  $data["results"][$i]["sale_price_change_last_hour"];
	$offer_price_change_last_hour =  $data["results"][$i]["offer_price_change_last_hour"];


	if ($max_offer_unit_price == 0) {
		continue;
	}
	if ($min_sale_unit_price == 0) {
		continue;
	}
	if ($offer_availability < 60) {
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
	if ($profit > 100000) {
		continue;
	}
	if ($profit < 500) {
		continue;
	}
	$isprofitable = false;
	if ($profit > $max_offer_unit_price) {
		$isprofitable = true;
	} else {
		continue;
	}
	if ($data["results"][$i]["type_id"] == 0 && $data["results"][$i]["restriction_level"] < 80) {
		continue;
	}
	if ($data["results"][$i]["type_id"] == 18 && $data["results"][$i]["restriction_level"] < 80) {
		continue;
	}
	if ($data["results"][$i]["type_id"] == 15 && $data["results"][$i]["restriction_level"] < 80) {
		continue;
	}
	
	$margin = $profit / $max_offer_unit_price * 100;
	if ($margin > 400) {
		continue;
	}
	if ($isprofitable&&$issellable) {
	//Level,Rarity,Item Type
		$printout .=  $data["results"][$i]["name"].','.$profit.','.$max_offer_unit_price.','.$min_sale_unit_price.','.$offer_availability.','.$sale_availability.','.$margin.','.$data["results"][$i]["restriction_level"].','.$data["results"][$i]["rarity"].','.$data["results"][$i]["type_id"]."\n";
	}
}
file_put_contents("data.csv", $printout);


//Offer is buying amount, as in what person is ok to buy
//Sale is on sale amount, this should always be bigger than Offer + 15%

//minimum criteria
//$profit needs to be at least equal or greater than max_offer_unit_price
?>