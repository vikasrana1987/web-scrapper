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
			// 
		}
	}
	//echo $text;
	$html = $parser->removeAttributes($html);

	echo $html;
	

	/* 	$client = new Client();
	$crawler = $client->request('GET', 'http://cp.demo.netsmartz.us/Users/login');

	// select the form and fill in some values
	$form = $crawler->selectButton('Login')->form();
	$form['data[User][user_email]'] = 'ata7@hotmail.com';
	$form['data[User][password]'] = 'Freakenpm*7';

	// submit that form
	$crawler = $client->submit($form);
	$content = $crawler->filter('body');
	echo $content->html();
	var_dump($crawler);
 */?>