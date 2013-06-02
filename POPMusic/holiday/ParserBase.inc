<?php 
class ParserBase
{
	public function httpRequest($url, $post)
	{
		if(empty($post))
		{
			$content = @file_get_contents($url);
		}
		else
		{
			// Create a stream
			$opts = array('http' =>
					array(
						'method'  => 'POST',
						'content' => $post,
						'timeout' => 60,
					     )
				     );

			$context  = stream_context_create($opts);

			$content = @file_get_contents($url , false, $context);
		}

		return $content;
	}

	public function htmlTidy($html)
	{
		$config = array(
			'indent'         => false,
			'show-body-only' => true, 
		);
		
		$tidy = new tidy();
		$tidy->parseString($html, $config, 'utf8');
		$tidy->cleanRepair();
		
		$output = (string) $tidy;
		return $output;
	}
}
