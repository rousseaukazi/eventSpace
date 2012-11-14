<?php

include "connection.php";

/////////////////////////////////////
//Parsing & Extracting the XML object
/////////////////////////////////////


$raw_message = (string) file_get_contents('php://input');
$simple_xml = simplexml_load_string($raw_message);
$image = $simple_xml->images->image;
$phone = $simple_xml->msisdn;
$message = $simple_xml->message;
$message = strtolower(trim($message));
$messageArray = explode(" ", $message);

// ///////
// //Logic
// ///////    

// /////////////
// //Album Logic
// /////////////

// if ($messageArray[0] == "album"){
//     $url = 'https://api.mogreet.com/moms/transaction.send?client_id=1316&token=dbd7557a6a9d09ab13fda4b5337bc9c7&campaign_id=28420&to=' . intval($phone) . '&message=www.sumanvenkat.com/&format=json';
//     $ch = curl_init($url); 
//     $response = curl_exec($ch);
//     curl_close($ch);
// } 

// // /////////////////
// // //Megaphone Logic
// // /////////////////


// elseif($messageArray[0] == "megaphone") {
//     unset($messageArray[0]);
    
//     $messageEncoded = urlencode(implode(" ", $messageArray));

//     $data = mysql_query("SELECT Phone From TestUsers");

//     while($info = mysql_fetch_array($data)){
//         $url = 'https://api.mogreet.com/moms/transaction.send?client_id=1316&token=dbd7557a6a9d09ab13fda4b5337bc9c7&campaign_id=28420&to=' . intval($info['Phone']) . '&message=' . $messageEncoded . '&format=json';
//         $ch = curl_init($url); 
//         $response = curl_exec($ch);
//         curl_close($ch);   
//     }

// }
   

// // ///////////////
// // //Invite Logic
// // ///////////////

// elseif ($messageArray[0] == "invite") {
//     $welcomeString = "Hey! Welcome to Event Space!";
//     mysql_query("INSERT INTO TestUsers VALUES ('$messageArray[1]'");
//     $url = 'https://api.mogreet.com/moms/transaction.send?client_id=1316&token=dbd7557a6a9d09ab13fda4b5337bc9c7&campaign_id=28420&to=' . intval(trim($messageArray[1]) . '&message=' . $welcomeString . '&format=json';
//     $ch = curl_init($url); 
//     $response = curl_exec($ch);
//     curl_close($ch);
// }




// else { 



////////////////////////////
//Writing to SQL! Bitch
////////////////////////////


    mysql_query("INSERT INTO TestEntries (Phone, Picture, Album) VALUES ('$phone', '$image', '$message')");

    $thankYouMsg = "Awesome!_Check_out_your_picture_at_the_album_URL!!!";

    $url = 'https://api.mogreet.com/moms/transaction.send?client_id=1316&token=dbd7557a6a9d09ab13fda4b5337bc9c7&campaign_id=28420&to=' . intval($phone) . '&message='. $thankYouMsg;
    $ch = curl_init($url); 
    $response = curl_exec($ch);
    curl_close($ch);


/////////////
//Email Logic
/////////////

    $subject = $phone . " just uploaded a photo!";

////////
// Send
////////
    mail('kazi.rousseau@gmail.com', $subject, $phone);
    mail('cchanningallen@gmail.com', $subject, $phone);
    mail('svenkat45@gmail.com', $subject, $phone);

// }


?>