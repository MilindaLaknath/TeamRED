<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

ini_set('error_log', 'tocoll-app-error.log');
require 'class/db.php';
require_once './libs/sms/Log.php';
require 'libs/sms/SMSSender.php';
require 'libs/sms/SMSReceiver.php';


$production = false;

$APP_ID = "APP_015652";
$PASSWORD = "fe933c2c89999303a0e6a94ea1e483c8";

$logger = new Logger();


if ($production == false) {
    $SMS_SERVER_URL = "http://localhost:7000/sms/send";
} else {
    $SMS_SERVER_URL = "https://api.dialog.lk/sms/send";
}

$sessId = $_POST["sessionId"];
$BinId = $_POST["BinId"];

$tel = "";
$longitude = "";
$latitude = "";
$gtype = "";
$gcid = "";

$rep_msg = "";
$address = "";

$logger->WriteLog("Test log @ to collector");


if (isset($sessId)) {
    $sms_sender = new SMSSender($SMS_SERVER_URL, $APP_ID, $PASSWORD);
    $serQry = "SELECT * FROM sessions s, individual i, collectables c WHERE s.sessionsid='" . $sessId . "' AND i.sessionid=s.sessionsid AND i.sms=0 AND c.id=i.gtype";
    $qrReslt = mysqli_query($connection, $serQry);
    while ($row = mysql_fetch_assoc($qrReslt)) {
        $tel = $row["tel"];
        $longitude = $row["longitude"];
        $latitude = $row["latitude"];
        $gtype = $row["type"];
        $gcid = $row["assigned"];
    }
    $url = "http://test.com?lat=" . $latitude . "&long=" . $longitude;
    $rep_msg = "You have new customer.\nType:" . $gtype . "\nNo:" . $tel . "\nURL:" . $url;

    $serGcoNum = "SELECT * FROM collector_number WHERE gcid='" . $gcid . "'";
    $gcNumRes = mysqli_query($connection, $serGcoNum);
    if (mysqli_error($connection)) {
        $logger->WriteLog(mysqli_error($connection));
    }
    while ($row1 = mysql_fetch_assoc($gcNumRes)) {
        $address = "tel:" . $row["number"];
        $sms_sender->sms($rep_msg, $address);
    }
} elseif (isset($BinId)) {
    $sms_sender = new SMSSender($SMS_SERVER_URL, $APP_ID, $PASSWORD);
    $serQry = "SELECT * FROM bin_tb b, collectables c WHERE b.bin_id='" . $BinId . "' AND b.sms=0 AND c.id=b.type";

    $qrReslt = mysqli_query($connection, $serQry);

    while ($row = mysql_fetch_assoc($qrReslt)) {
        $longitude = $row["lng"];
        $latitude = $row["lat"];
        $gtype = $row["type"];
        $gcid = $row["gcid"];
    }
    $url = "http://test.com?lat=" . $latitude . "&long=" . $longitude;
    $rep_msg = "Your bin is full.\nType:" . $gtype . "\nURL:" . $url;

    $serGcoNum = "SELECT * FROM collector_number WHERE gcid='" . $gcid . "'";
    $gcNumRes = mysqli_query($connection, $serGcoNum);
    while ($row1 = mysql_fetch_assoc($gcNumRes)) {
        $address = "tel:" . $row["number"];
        $sms_sender->sms($rep_msg, $address);
    }
}



//$sms_sender = new SMSSender($SMS_SERVER_URL, $APP_ID, $PASSWORD);
//$sms_sender->sms($rep_msg, $address);
?>