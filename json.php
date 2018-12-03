<?php
$people = '{"data":[{"first_name":"bob","last_name":"smith","age":31,"email":"bob@smith.com","secret":"VXNlIHRoaXMgc2VjcmV0IHBocmFzZSBzb21ld2hlcmUgaW4geW91ciBjb2RlJ3MgY29tbWVudHM="},{"first_name":"joe","last_name":"schmoe","age":85,"email": "joe@schmoe.com","secret":"YWxidXF1ZXJxdWUuIHNub3JrZWwu"},]}';
//The above line cannot be changed. It was the code that was given to me to start this challenge. I will treat it like an outside JSON being imported.
//Engage "Super Secret Spy Award" ;)
//Trim off the "," at the end of the JSON that is preventing us from decoding, without directly manipulating the source
$people[-3] = " ";
//Decode JSON to something we can work with
$tempArray = json_decode($people, true);
$newArray = $tempArray['data'];
//Pull our Email addresses and make a CSV list
$emails = array();
foreach($newArray as $person) {
    $emails[] = $person['email'];
}
$commaList = implode(', ', $emails);
//Sort the array in Descending order by Age
usort($newArray, function($a, $b) {
    if ($a['age'] == $b['age']) return 0;
    return ($a['age'] < $b['age']) ? 1 : -1;
});
//Create our Final Array with the required Schema
$finalArray = array();
foreach($newArray as $object) {
    $finalArray[] = array("name"=>$object['first_name'] . " " . $object['last_name'], "age"=>$object['age'], "email"=>$object['email'], "secret"=>$object['secret']);
}
//Output the Variables to double-check ;)
print_r($finalArray);
echo $commaList;
?>
