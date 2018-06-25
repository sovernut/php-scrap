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
		$pokemon_row = $pokemon_xpath->query('//*[@id="body"]/div[2]/div/div[1]/div[2]/div[2]/div[1]');
//*[@id="body"]/div[2]/div/div[1]/div[2]/div[2]/div[1]
		//if($pokemon_row->length > 0){

		for ($x = 0; $x <= 25; $x++) {
				$bus_id = @$pokemon_xpath->query('./div['. $x .']/div/div/div[2]/a/div/h5',$pokemon_row[0]);
				/*$bus_area = remove_space(@$pokemon_xpath->query('./td[2]',$row)[0]->nodeValue);
				$bus_srcdes = remove_space(@$pokemon_xpath->query('./td[3]',$row)[0]->nodeValue);
				$bus_type = remove_space(@$pokemon_xpath->query('./td[4]',$row)[0]->nodeValue);
				$bus_time = remove_space(@$pokemon_xpath->query('./td[5]',$row)[0]->nodeValue);*/
				if (is_object($bus_id)) {
					echo $bus_id[0]->nodeValue . "\n";
				}
				/*$txt_to_return .= "BusID:" . $bus_id; . " BusArea:" . $bus_area .
						" BusSourceDest:" . $bus_srcdes . " BusType:" . $bus_type .
						" BusTime:" . $bus_time . "\n";*/
			}
		//}
		}
		//return $txt_to_return;
}

function remove_space($text){
    return preg_replace('/\s+/',"",$text);
}

get_bus_detail('https://www.wongnai.com/businesses?regions=11179&domain=1');
//echo $txt;
/*$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $txt);
fclose($myfile);*/
?>
