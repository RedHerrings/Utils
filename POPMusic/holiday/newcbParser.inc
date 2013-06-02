<?php
require_once __DIR__ . '/ParserBase.inc';

class newcbParser extends ParserBase
{
	public function get_songs($kind)
	{
		$html = $this->getHTML($kind);
		$html = $this->getTable($html);
		$total_songs = $this->parseTable($html);
		return $total_songs;
	}

	private $mapping = array(
			'nc' => 5,
			'tc' => 0,
			'nt' => 6,
			'tt' => 1,
			'ct' => 2,
			'et' => 3,
			'jt' => 4,
			);

	private $url = "http://www.newcbparty.com/billboard.php?p=";

	public function getHTML($kind)
	{
		$url = $this->url . $this->mapping[$kind];
		$html = $this->httpRequest($url, null);
		$html = $this->htmlTidy($html);
		
		return $html;
	}

	public function getTable($html)
	{
		$fp = fopen("php://memory" , "r+");
		fwrite($fp, $html);
		rewind($fp);
		
		$findStatus = 0; // 0: 沒找到 table, 1: 
		$html = '';

		while(($line = fgets($fp)) !== false)
		{
			switch($findStatus)
			{
			case 0:	// 找到 "歌手"
				if(trim($line) == "<td>歌手</td>")
					$findStatus++;
				break;
			case 1: // 找到 </tr>
				if(trim($line) == "</tr>")
					 $findStatus++;
				break;	
			case 2: // 找到 </table>
				if(trim($line) == "</table>")
					 $findStatus++;
				else
					$html .= $line;
				break;	
			}

			if($findStatus > 2)
				break;
		}

		fclose($fp);
		return $html;
	}

	public function parseTable($html)
	{
		$html = <<<DOC
			<html>
			<head>
			<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
			</head>
			<body>
			<table>
			$html
			</table>
			</body>
			</html>
DOC;
		$dom = new DOMDocument();
		$ret = $dom->loadHTML($html);
		$rows = $dom->getElementsByTagName('tr');

		$songs = array();

		foreach($rows as $rkey => $row)
		{
			$cols = $row->getElementsByTagName('td');
			$song = array(
					'grade'  => trim($cols->item(0)->nodeValue),
					'singer' => trim($cols->item(5)->nodeValue),
					'song'   => trim($cols->item(4)->nodeValue),
				     );

			$songs[] = $song;
		}

		return $songs;
	}
}
?>
