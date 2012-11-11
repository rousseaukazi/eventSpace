<?php

include 'connection.php';

//////////////
//Contact List
//////////////

$number_to_name = array(
    "16508420492" => "Rousseau Kazi",
    "18042294822" => "Channing Allen",
    "18477226071" => "Suman Venkataswamy",
    "14086246110" => "Ashley Malone",
    // "19518928892" => "Ashley Bennett",
    // "16505213837" => "Alexa Krakaris",
    // "18472716925" => "Jonathon Paul",
    // "19519929201" => "Jelani Hayes",
    // "14157866212" => "Sumaya Kazi",
    // "12532283438" => "Joshua Evenson",
    // "19413024516" => "Rob Balian",
    // "17143920591" => "Evan Kawahara",
    // "19145847487" => "Maddie Boyd",
    // "13046155153" => "Addison Litton",
    // "15514047775" => "Chistopher Lo"
    // "14014411418" => "Vihang Mehta"
);

/////////////////////////////////////
//Parsing & Extracting the XML object
/////////////////////////////////////

$filename = 'day_three_test.txt';
$raw_message = (string) file_get_contents('php://input');
$simple_xml = simplexml_load_string($raw_message);
$image = $simple_xml->images->image;
$phone = $simple_xml->msisdn;
$message = $simple_xml->message;
$message = strtolower(trim($message));
$album = "";

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


mysql_query("INSERT INTO Entries VALUES ('$phone', NOW(),'$image', '$album')");




/////////////
//Email Logic
/////////////

$subject = $number_to_name[intval($somecontent_rcs_number)] . " just uploaded a photo!";

////////
// Send
////////
mail('kazi.rousseau@gmail.com', $subject, $phone);
mail('cchanningallen@gmail.com', $subject, $phone);
mail('svenkat45@gmail.com', $subject, $phone);
}
?>