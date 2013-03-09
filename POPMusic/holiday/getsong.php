<?php
ini_set( 'default_charset', 'UTF-8' );

require_once __DIR__ . '/holidayParser.inc';

$menu = array(
	'nc' => '國語新歌',
	'tc' => '國語點播',
	'nt' => '台語新歌',
	'tt' => '台語點播',
	'ct' => '廣東點播',
	'et' => '西洋點播',
	'jt' => '東洋點播',
);

$kind = $_GET['kind'];
if(empty($kind))
{
	$kind = "nc";
}

echo "好樂迪排行榜："; 
foreach($menu as $key => $str)
{
	if($key == $kind)
		$str = "<b>$str</b>";

	echo "<a href=\"?kind=$key\">$str</a> | ";
}

echo "<hr>\n";
?>
<!--
  <script type="text/javascript" src="swfobject.js"></script> 
  <div id="ytapiplayer">
    You need Flash player 8+ and JavaScript enabled to view this video.
  </div>
  <script type="text/javascript">

    var params = { allowScriptAccess: "always" };
    var atts = { id: "myytplayer" };
    swfobject.embedSWF("http://www.youtube.com/v/VIDEO_ID?enablejsapi=1&playerapiid=ytplayer&version=3",
                       "ytapiplayer", "425", "356", "8", null, null, params, atts);

    function onYouTubePlayerReady(playerId) {
      //ytplayer = document.getElementById("myytplayer");
	alert('player ready');
    }

  </script>
-->
<?php
$total_songs = get_songs($kind);

function renderHTML(array $songs)
{
	echo "<ul>";
	foreach($songs as $song)
	{
		$query = array(
				"search_query" => "{$song['singer']} {$song['song']} MV",
			      );

		$link = "https://www.youtube.com/results?" . http_build_query($query);

		echo "<li><a href=\"{$link}\" target=\"_blank\">".implode(' ', $song)."</a></li>\n";
	}

	echo "</ul>";
}

renderHTML($total_songs);
