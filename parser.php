<?php
	/*
		Class: Parser
		Author: Vikas Rana
	*/
	
	class Parser {
		public function removeAttributes($html = null, $attributes = array('style'))
		{
			if(!empty($html))
			{
				if(!empty($attributes))
				{
					foreach($attributes as $attribute)
					{
						$html = preg_replace('/(<[^>]+) '.$attribute.'=".*?"/i', '$1', $html);
					}
				}	
			}
			return $html;
		}
	} 
?>