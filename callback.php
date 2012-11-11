<?php

include 'connection.php';

/////////////////////////////////////
//Parsing & Extracting the XML object
/////////////////////////////////////


$raw_message = (string) file_get_contents('php://input');
$simple_xml = simplexml_load_string($raw_message);
$image = $simple_xml->images->image;
$phone = $simple_xml->msisdn;
$message = $simple_xml->message;
$message = strtolower(trim($message));


///////
//Logic
///////    

if (count(explode(" ", $message)) > 1) {

/////////////////
//Megaphone Logic
/////////////////

    $messageArray = explode(" ", $message);
    if($messageArray[0] == "megaphone") {
        unset($messageArray[0]);
        $messageEncoded = urlencode(implode(" ", $messageArray));
        foreach ($number_to_name as $key => $value) {
            $url = 'https://api.mogreet.com/moms/transaction.send?client_id=1316&token=dbd7557a6a9d09ab13fda4b5337bc9c7&campaign_id=28420&to=' . intval($key) . '&message=' . $messageEncoded . '&format=json';
            $ch = curl_init($url); 
            $response = curl_exec($ch);
            curl_close($ch);            
        } 

///////////////
//Invite Logic
///////////////

    } elseif ($messageArray[0] == "invite") {
            $welcomeString = "Hey! Welcome to Event Space!";
            $url = 'https://api.mogreet.com/moms/transaction.send?client_id=1316&token=dbd7557a6a9d09ab13fda4b5337bc9c7&campaign_id=28420&to=' . intval(trim($somecontent_rcs_invite[1])) . '&message=' . $welcomeString . '&format=json';
            $ch = curl_init($url); 
            $response = curl_exec($ch);
            curl_close($ch);
        }

/////////////
//Album Logic
/////////////

    } elseif($message == "album"){
        $url = 'https://api.mogreet.com/moms/transaction.send?client_id=1316&token=dbd7557a6a9d09ab13fda4b5337bc9c7&campaign_id=28420&to=' . intval($somecontent_rcs_number) . '&message=www.rousseaukazi.com/&format=json';
        $ch = curl_init($url); 
        $response = curl_exec($ch);
        curl_close($ch);
    } else { 



////////////////////////////
//Writing to SQL! Bitch
////////////////////////////


mysql_query("INSERT INTO Entries VALUES ('$phone', NOW(),'$image', '$message')");




/////////////
//Email Logic
/////////////

$subject = $number_to_name[intval($phone)] . " just uploaded a photo!";

////////
// Send
////////
mail('kazi.rousseau@gmail.com', $subject, $phone);
mail('cchanningallen@gmail.com', $subject, $phone);
mail('svenkat45@gmail.com', $subject, $phone);
}
?>