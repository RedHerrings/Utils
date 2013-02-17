<?php

function readCSVfile($fname)
{
	$fp = fopen($fname, "r");

	// skip first row
	fgetcsv($fp);

	$data = array();

	while( $line = fgetcsv($fp) )
	{
		$data[] = $line;
	}

	fclose($fp);

	return $data;
}

// readable_date: utf8
function ParseDateString($readable_date)
{
	sscanf($readable_date, "%d/%d/%d %s %d:%d:%d", $day, $month, $year, $noon, $hour, $minute, $second);

	if($noon == "下午")
		$hour += 12;

	$str = "$year-$month-$day $hour:$minute:$second";
	$timestamp = strtotime($str);

	echo "$readable_date => str ( $str ) => " . date('Y-m-d H:i:s', $timestamp) . PHP_EOL;

	return $timestamp * 1000;
}

function getXMLString(array $line)
{
	$tel = $line[0];
	$readable_date = $line[2];
	$msg = $line[3];

	$readable_date = iconv('cp950', 'UTF-8', $readable_date);
	//$date = strtotime($readable_date);
	$date = ParseDateString($readable_date);

	if(substr($tel, 0, 3) == "886")
	{
		// +886
		$tel = "+{$tel}";
	}

	$msg = iconv('cp950', 'UTF-8', $msg);
	$msg = htmlspecialchars($msg);
	$msg = str_replace('%c%n', '&#10;', $msg);

	$rowdata = array(
		'protocol' => 0,
		'address'  => $tel,
		'date'     => $date,
		'type'     => 1,
		'subject'  => "null",
		'body'     => $msg,
		'toa'      => "null",
		'sc_toa'   => "null",
		'service_center' => "null",
		'read'     => "1",
		'status'   => "-1",
		'locked'   => "0",
		'date_sent' => "0",
		'readable_date' =>  $readable_date,
		'contact_name' => "(Unknown)",
	);

	$outstr = "<sms ";

	foreach($rowdata as $key => $val)
	{
		$outstr .= "$key=\"$val\" ";
	}

	$outstr .= "/>\n";

	return $outstr;
}

function writeXML($data, $outfile)
{
	$count = count($data);
	$fp = fopen($outfile, "w");

	fwrite($fp, "<?xml version='1.0' encoding='UTF-8' standalone='yes' ?>\n<?xml-stylesheet type=\"text/xsl\" href=\"sms.xsl\"?>\n");
	fwrite($fp, "<smses count=\"$count\">\n");

	foreach($data as $line)
	{
		fwrite($fp, getXMLString($line));
	}
	
	fwrite($fp, "</smses>\n");
	fclose($fp);
}

date_default_timezone_set('Asia/Taipei');
ini_set( 'default_charset', 'UTF-8' );

$data = readCSVfile("Messages.csv");
writeXML($data, 'output.xml');

?>
