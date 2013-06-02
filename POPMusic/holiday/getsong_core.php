<?php
ini_set( 'default_charset', 'UTF-8' );

define('HOLIDAY_CACHE_PREFIX', 'hd_cache_prefix_'); // holiday cache
define('NEWCB_CACHE_PREFIX', 'nc_cache_prefix_'); // newcb caceh
define('YOUTUBE_CACHE_PREFIX', 'yt_caceh_prefix_');
define('SONG_CACHE_SECOND', 500);

require_once __DIR__ . '/holidayParser.inc';
require_once __DIR__ . '/newcbParser.inc';
require_once __DIR__ . '/YQL.inc';

$menu = array(
	'nc' => '國語新歌',
	'tc' => '國語點播',
	'nt' => '台語新歌',
	'tt' => '台語點播',
	'ct' => '廣東點播',
	'et' => '西洋點播',
	'jt' => '東洋點播',
);

$kind = filter_input(INPUT_GET, 'kind', FILTER_SANITIZE_STRING); 
if(empty($kind))
{
	$kind = "nc";
}

$song_name = filter_input(INPUT_GET, 'song', FILTER_SANITIZE_STRING);

$source = filter_input(INPUT_GET, 'source', FILTER_SANITIZE_STRING);
if(empty($source))
{
	$source = "holiday";
}

if($source == "holiday")
{
	// parse holiday
	$holiday_cache_key = HOLIDAY_CACHE_PREFIX . $kind;
	if(apc_exists($holiday_cache_key))
	{
		$total_songs = apc_fetch($holiday_cache_key);
	}
	else
	{
		$total_songs = get_songs($kind);
		apc_store( $holiday_cache_key, $total_songs, SONG_CACHE_SECOND);
	}

	$songlist_cache_key = $holiday_cache_key;
}
else
{
	$newcb_cache_key = NEWCB_CACHE_PREFIX . $kind;
	if(apc_exists($newcb_cache_key))
	{
		$total_songs = apc_fetch($newcb_cache_key);
	}
	else
	{
		$parser = new newcbParser();
		$total_songs = $parser->get_songs($kind);
		apc_store( $newcb_cache_key, $total_songs, SONG_CACHE_SECOND);
	}

	$songlist_cache_key = $newcb_cache_key;
}

?>
