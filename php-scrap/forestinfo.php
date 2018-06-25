<?php
function get_bus_detail($url){
	$html = file_get_contents($url); //get the html returned from the following url

	$pokemon_doc = new DOMDocument();
	$txt_to_return = "";
	libxml_use_internal_errors(TRUE); //disable libxml errors

	if(!empty($html)){ //if any html is actually returned

		$pokemon_doc->loadHTML($html);
		libxml_clear_errors(); //remove errors for yucky html

		$pokemon_xpath = new DOMXPath($pokemon_doc);

		//get all the h2's with an id
		$pokemon_row = $pokemon_xpath->query('//*[@id="ctl00_CPH_Content_lb_content"]/table/tbody/tr');

		if($pokemon_row->length > 0){
			foreach($pokemon_row as $row){
				/*$bus_id = remove_space(@$pokemon_xpath->query('./td[1]',$row)[0]->nodeValue);
				$bus_area = remove_space(@$pokemon_xpath->query('./td[2]',$row)[0]->nodeValue);
				$bus_srcdes = remove_space(@$pokemon_xpath->query('./td[3]',$row)[0]->nodeValue);
				$bus_type = remove_space(@$pokemon_xpath->query('./td[4]',$row)[0]->nodeValue);
				$bus_time = remove_space(@$pokemon_xpath->query('./td[5]',$row)[0]->nodeValue);
				$txt_to_return .= "BusID:" . $bus_id . " BusArea:" . $bus_area .
						" BusSourceDest:" . $bus_srcdes . " BusType:" . $bus_type .
						" BusTime:" . $bus_time . "\n";*/
			$arow = "";
				for ($x=0; $x<13; $x++){
					$txt_to_return .= remove_space(@$pokemon_xpath->query('./td',$row)[$x]->nodeValue) . ' ';
					//print_r (explode(" ",$arow));
				}				//$ar = preg_split('/\s+/',$txt_to_return);
				//echo $ar[3];
				$txt_to_return .= "\n";
				echo "\n";
			}

		}
		}
		return $txt_to_return;
}

function remove_space($text){
		$trim_text = preg_replace('/[\s\t\n\r\s]+|,/',"",$text);
		$trim_text = trim($trim_text);
		//echo gettype($trim_text);
		$trim_text = str_replace('&nbsp;', "", $trim_text);
		$trim_text = str_replace(' ', "", $trim_text);
		$trim_text = floatVal($trim_text);
		//foreach(preg_split('//',$trim_text) as $char){ var_dump(ord($char)); }
		//$trim_text = floatVal($trim_text);
		return $trim_text;
}

$txt = get_bus_detail('http://forestinfo.forest.go.th/55/Content.aspx?id=72');
//echo $txt;
$myfile = fopen("forest.txt", "w") or die("Unable to open file!");
fwrite($myfile, $txt);
fclose($myfile);
?>
