<?php
function SearchYoutube($query)
{
	$yqlQuery = "select * from youtube.search where query=\"$query\"";

	$httpParams = array(
		'q' => $yqlQuery,
		'diagnostics' => "true",
		'env' => 'store://datatables.org/alltableswithkeys',
		'format' => 'json',
	);

	$yql_query_url = "https://query.yahooapis.com/v1/public/yql?" . http_build_query($httpParams);
	$json = HTTP_GET( $yql_query_url );
	$phpObj =  json_decode($json, true);  

	return $phpObj;
}

function HTTP_GET($url)
{
	$session = curl_init($url);  
	curl_setopt($session, CURLOPT_RETURNTRANSFER,true);      
	$content = curl_exec($session);  
	curl_close($session); 

	return $content;
}
?>
