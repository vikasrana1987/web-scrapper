<?php
	require ('vendor/autoload.php');
	require ('parser.php');
	use Rize\UriTemplate;
	use Goutte\Client;

	$uri = new UriTemplate();
	
	$client = new Client();
	$parser = new Parser();


	$url = $uri->expand('http://www.idchips.com/fr/recherche?search_identification_number={id}', ['id' => '999999999999999']);
	
	$crawler = $client->request('GET', $url);
	$content = $crawler->filter('div#content > table');
	
	$text = null;
	$html = null;
	if (!empty($content)) {
		try {
			if (!empty($node = $content->eq(0))) {
				$text = $node->text();
				$html = $node->html();
			}
		}
		catch(Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	//echo $text;
	$html = $parser->removeAttributes($html);

	echo $html;
	?>