<?php

ini_set('max_execution_time', 0);
$raw = file_get_contents("http://api.gw2tp.com/1/bulk/items.csv");

$data = explode("\n", $raw);

$savevalues = array();

for ($i = 1; $i < count($data); $i++) {
	$row = explode(",", $data[$i]);
	if (isset($row[2])) {
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
		if ($profit > 1000000) {
			continue;
		}
		if ($profit < 500) {
			continue;
		}
		$isprofitable = false;
		
		$margin = $profit / $max_offer_unit_price * 100;
		if ($margin > 400) {
			continue;
		} else if ($margin < 10) {
			continue;
		} else {
			$isprofitable = true;
		}
		if ($isprofitable&&$issellable) {
		//Level,Rarity,Item Type
			$savevalues[$offer_availability] = '<div class="row table-content"><div class="col-sm-4">'.str_replace('"', '', $row[1]).'</div><div class="col-sm-2">'.$min_sale_unit_price.'</div><div class="col-sm-2">'.$max_offer_unit_price.'</div><div class="col-sm-2">'.$profit.'</div></div>';
		}
	}
}
$x = 0;
foreach ($savevalues as $value) {
	if ($x == 10) {
		return;
	}
	echo $value;
	$x++;
}

























$line = '<div id="table-flip">
		<div class="row table-header">
			<div class="col-sm-4" id="item-name-div">ITEM</div>
			<div class="col-sm-2" id="item-sell-div">SELL</div>
			<div class="col-sm-2" id="item-buy-div">BUY</div>
			<div class="col-sm-2" id="item-margin-div">PROFIT</div>
		</div>';
echo $line;
for ($i = 1; $i < count($data); $i++) {
	$row = explode(",", $data[$i]);
	if (isset($row[2])) {
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
		if ($profit > 1000000) {
			continue;
		}
		if ($profit < 500) {
			continue;
		}
		$isprofitable = false;
		
		$margin = $profit / $max_offer_unit_price * 100;
		if ($margin > 400) {
			continue;
		} else if ($margin < 10) {
			continue;
		} else {
			$isprofitable = true;
		}
		if ($isprofitable&&$issellable) {
		//Level,Rarity,Item Type
			$line = '<div class="row table-content"><div class="col-sm-4">'.str_replace('"', '', $row[1]).'</div><div class="col-sm-2">'.$max_offer_unit_price.'</div><div class="col-sm-2">'.$min_sale_unit_price.'</div><div class="col-sm-2">'.$offer_availability.'</div><div class="col-sm-2">'.round($margin).'</div></div>';
			echo $line; 
		}
	}
}


//Offer is buying amount, as in what person is ok to buy
//Sale is on sale amount, this should always be bigger than Offer + 15%

//minimum criteria
//$profit needs to be at least equal or greater than max_offer_unit_price
?>