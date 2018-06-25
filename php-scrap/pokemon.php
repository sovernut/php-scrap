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
		$pokemon_row = $pokemon_xpath->query('//*[@id="block-system-main"]/div/div/div[2]/table/tbody/tr');

		if($pokemon_row->length > 0){
			foreach($pokemon_row as $row){
				$bus_id = remove_space((@$pokemon_xpath->query('./td[1]',$row))[0]->nodeValue);
				$bus_area = remove_space(@$pokemon_xpath->query('./td[2]',$row)[0]->nodeValue);
				$bus_srcdes = remove_space(@$pokemon_xpath->query('./td[3]',$row)[0]->nodeValue);
				$bus_type = remove_space(@$pokemon_xpath->query('./td[4]',$row)[0]->nodeValue);
				$bus_time = remove_space(@$pokemon_xpath->query('./td[5]',$row)[0]->nodeValue);
				$txt_to_return .= "BusID:" . $bus_id . " BusArea:" . $bus_area .
						" BusSourceDest:" . $bus_srcdes . " BusType:" . $bus_type .
						" BusTime:" . $bus_time . "\n";
				//echo "BusArea : " . $bus_area[0]->nodeValue . "";
			}
		}
		}
		return $txt_to_return;
}

function remove_space($text){
    return preg_replace('/\s+/',"",$text);
}

$txt = get_bus_detail('http://www.bmta.co.th/th/bus-lines');
echo $txt;
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $txt);
fclose($myfile);
?>
