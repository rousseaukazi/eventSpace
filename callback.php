<?php

$number_to_name = array(
    "16508420492" => "Rousseau Kazi",
    "18042294822" => "Channing Allen",
    "18477226071" => "Suman Venkataswamy"
    // "14086246110" => "Ashley Malone",
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
    // "15514047775" => "Chistopher Lo",
    // "14014411418" => "Vihang Mehta"
);

$filename = 'day_three_test.txt';
$raw_message = (string) file_get_contents('php://input');
$simple_xml = simplexml_load_string($raw_message);
$somecontent_rcs_image = $simple_xml->images->image;
$somecontent_rcs_number = $simple_xml->msisdn;
$somecontent_rcs_message = $simple_xml->message;
$somecontent_rcs_message = trim($somecontent_rcs_message);
$somecontent_rcs_message = strtolower($somecontent_rcs_message);

$somecontent_rcs_invite = explode(" ", $somecontent_rcs_message);

if($somecontent_rcs_message == "album"){
    $url = 'https://api.mogreet.com/moms/transaction.send?client_id=1316&token=dbd7557a6a9d09ab13fda4b5337bc9c7&campaign_id=28420&to=' . intval($somecontent_rcs_number) . '&message=www.rousseaukazi.com/&format=json';
    $ch = curl_init($url); 
    $response = curl_exec($ch);
    curl_close($ch);
} elseif ($somecontent_rcs_message == "megaphone") {
    foreach ($number_to_name as $key => $value) {
        $url = 'https://api.mogreet.com/moms/transaction.send?client_id=1316&token=dbd7557a6a9d09ab13fda4b5337bc9c7&campaign_id=28420&to=' . intval($key) . '&message=Text%20Rousseau%20when%20you%20get%20this%20message%21&format=json';
        $ch = curl_init($url); 
        $response = curl_exec($ch);
        curl_close($ch);
    }

} elseif (strtolower(trim($somecontent_rcs_invite[0])) == "invite" ) {
    $url = 'https://api.mogreet.com/moms/transaction.send?client_id=1316&token=dbd7557a6a9d09ab13fda4b5337bc9c7&campaign_id=28420&to=' . intval(trim($somecontent_rcs_invite[1])) . '&message=You%27re%20in%21%20Reply%20with%20007%20and%20a%20photo%20to%20join%20in%20on%20the%20fun%21&format=json';
    $ch = curl_init($url); 
    $response = curl_exec($ch);
    curl_close($ch);
} else {

$somecontent = $somecontent_rcs_image . "\n" . $somecontent_rcs_number . "\n" . $somecontent_rcs_message;


// Let's make sure the file exists and is writable first.
if (is_writable($filename)) {

    // In our example we're opening $filename in append mode.
    // The file pointer is at the bottom of the file hence
    // that's where $somecontent will go when we fwrite() it.
    if (!$handle = fopen($filename, 'a')) {
         echo "Cannot open file ($filename)";
         exit;
    }

    // Write $somecontent to our opened file.
    if (fwrite($handle, $somecontent . "\n") === FALSE) {
        echo "Cannot write to file ($filename)";
        exit;
    }

    echo "Success, wrote ($somecontent) to file ($filename)";

    fclose($handle);

} else {
    echo "The file $filename is not writable";
}



$message = $somecontent_rcs_number;

$subject = $number_to_name[intval($somecontent_rcs_number)] . " just uploaded a photo!";

// Send
mail('kazi.rousseau@gmail.com', $subject, $message);
mail('cchanningallen@gmail.com', $subject, $message);
mail('svenkat45@gmail.com', $subject, $message);
}
?>