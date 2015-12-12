<?php

date_default_timezone_set("Asia/Colombo");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


ini_set('error_log', 'sms-app-error.log');
require 'class/db.php';
require_once './libs/sms/Log.php';
require_once './libs/sms/SMSReceiver.php';
require_once './libs/sms/SMSSender.php';
require_once './libs/MtUssdSender.php';


$production = true;

if ($production == false) {
    $SMS_SERVER_URL = "http://localhost:7000/sms/send";
} else {
    $SMS_SERVER_URL = "https://api.dialog.lk/sms/send";
}

define('APP_ID', 'APP_015652'); 
define('APP_PASSWORD', 'fe933c2c89999303a0e6a94ea1e483c8');

$logger = new Logger();



try {

    // Creating a receiver and intialze it with the incomming data
    $receiver = new SMSReceiver(file_get_contents('php://input'));

    //Creating a sender
//    $sender = new SMSSender(SERVER_URL, APP_ID, APP_PASSWORD);

    $message = $receiver->getMessage(); // Get the message sent to the app
    $address = $receiver->getAddress(); // Get the phone no from which the message was sent 

    $logger->WriteLog($receiver->getAddress());


    list($keyword, $userNo) = explode(" ", $message);



    if (isset($userNo)) {
	$logger->WriteLog($userNo."\n");
        //DB save
	 $saveUsr = "INSERT INTO egusers VALUES('" . $address . "','" . $userNo . "')";
//       $saveUsr = "INSERT INTO egusers VALUES(userid='" . $address . "',mobno='" . $userNo . "')";
//        $saveUsr = "UPDATE egusers SET mobno='" . $userNo . "' WHERE userid='" . $address . "'";
        $ccc = mysqli_query($connection, $saveUsr);
        if (mysqli_error($connection)) {
            $logger->WriteLog(mysqli_error($connection));
        }

        $rep_msg = "Thank you for Register.\nDial #771*426# for use our Service.";
        $sms_sender = new SMSSender($SMS_SERVER_URL, APP_ID, APP_PASSWORD);
        $sms_sender->sms($rep_msg, $address);


        //http post request
//        $params = array(
//            "BinId" => $address
//        );
//        httpPost("http://ideamarthosting.dialog.lk/milindalApps/IdeaApp/tocollector.php", $params);
    } else {
        $rep_msg = "Something wrong with your entry.Type egrn <Your No> to 77101 for registration.";
        $sms_sender = new SMSSender($SMS_SERVER_URL, APP_ID, APP_PASSWORD);
        $sms_sender->sms($rep_msg, $address);
    }
} catch (SMSServiceException $e) {
    $logger->WriteLog($e->getErrorCode() . ' ' . $e->getErrorMessage());
}

//function httpPost($url, $params) {
////set POST variables
//    $url = 'http://greeen.brightron.net/greeen_project/index.php/ajax/insert';
//    $fields = array('lng' => 6.8830417,
//        'lat' => 79.8556852,
//        'gcid' => 2,
//        'type' => 2
//    );
//
////url-ify the data for the POST
//    foreach ($fields as $key => $value) {
//        $fields_string .= $key . '=' . $value . '&';
//    }
//    rtrim($fields_string, '&');
//
////open connection
//    $ch = curl_init();
//
////set the url, number of POST vars, POST data
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_POST, count($fields));
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
//
////execute post
//    $result = curl_exec($ch);
//
////close connection
//    curl_close($ch);
//}

?>
