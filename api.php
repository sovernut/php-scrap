<?php

function getDOM($item_count){
  global $cookie;
  $ch = curl_init();
  $url = "http://api.data.go.th/search_virtuoso/api/dataset/query?dsname=vir_1074_1497240613&loadAll=1&type=json&limit=".$item_count."&offset=0";
  //echo $url;
  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Cookie: $cookie"));
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $output = curl_exec($ch);
  curl_close($ch);
  return $output;
}
function savetoText($json,$item_count){
  $field = ["ลำดับ","G.S.No.","ชื่อพันธุ์ข้าว","ความยาวของลิ้นใบ","เส้นผ่าศูนย์กลางของลำต้น","ความยาวของลำต้น","ความยาวของแผ่นใบ","ความกว้างของแผ่นใบ"];
  $text_to_save = "";
  for ($x=0; $x<$item_count; $x++){
    for ($index=0; $index<count($field); $index++){
       $text_to_save .= $json['data'][$x][$field[$index]] . ' ';
    }
    $text_to_save .= "\n";
  }
  //echo $text_to_save;
  $myfile = fopen("./textfile/khao.txt", "w") or die("Unable to open file!");
  fwrite($myfile, $txt);
  fclose($myfile);
}
//$json = json_decode(getDOM());
function getandecho($num) {
  $response = getDOM($num);
  $json = json_decode($response ,true);
  savetoText($json,$num);
}
getandecho(1);

?>
