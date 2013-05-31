<?php
ini_set( 'default_charset', 'UTF-8' );

define('HOLIDAY_CACHE_PREFIX', 'hd_cache_prefix_');
define('YOUTUBE_CACHE_PREFIX', 'yt_caceh_prefix_');
define('SONG_CACHE_SECOND', 500);

require_once __DIR__ . '/holidayParser.inc';
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

?>
