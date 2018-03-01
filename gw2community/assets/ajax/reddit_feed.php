<?php

function humanTiming ($time)
{
	if (($time != '')||($time != null)) {
		$time = time() - $time; // to get the time since that moment

		$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
		);

		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').' ago';
		}
	}

}



ini_set('max_execution_time', 0);
$json = file_get_contents("http://www.reddit.com/r/guildwars2/hot.json");

$encrypted = json_decode(json_encode($json), true);
$array = json_decode($json, true);

$headlines = $array['data']['children'];

$count = count($array['data']['children']);
for ($i = 0; $i < $count; $i++) {
	$title = $headlines[$i]['data']['title'];
	$url = $headlines[$i]['data']['url'];
	$selftext_html = str_replace('&lt;!-- SC_ON --&gt;', '', str_replace("&lt;!-- SC_OFF --&gt;", "", $headlines[$i]['data']['selftext_html']));
	$num_comments = $headlines[$i]['data']['num_comments'];
	$permalink = "http://www.reddit.com".$headlines[$i]['data']['permalink'];
	$created = $headlines[$i]['data']['created_utc'];
	if (isset($headlines[$i]['data']['secure_media'])) {
		$selftext_html = $headlines[$i]['data']['secure_media']['oembed']['html'];
	}
	
	
	echo '<div class="row">';
    echo '  <div class="col-xs-12">';
    echo '    <h2>'.$title.'</h2>';
    echo html_entity_decode($selftext_html);
    echo '    <p class="lead"><a href="'.$url.'" class="btn btn-default">Read More</a></p>';
    echo '    <p class="pull-right"><span class="label label-default">keyword</span> <span class="label label-default">tag</span> <span class="label label-default">post</span></p>';
    echo '    <ul class="list-inline"><li><a href="#">'.humanTiming($created).'</a></li><li><a href="'.$permalink.'"><i class="glyphicon glyphicon-comment"></i> '.$num_comments.' Comments</a></li><li><a href="#"><i class="glyphicon glyphicon-share"></i> 14 Shares</a></li></ul>';
    echo '  </div>';
    echo '</div>';
    echo '<hr>';
}
?>