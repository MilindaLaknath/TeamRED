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

    $rep_msg = $_POST["egrnmsg"];
    
    echo "$rep_msg";
    
    $rep_msg = trim($rep_msg);

    echo "$rep_msg";
    
    $serch_qry = "SELECT userid FROM egusers";

    $result = mysqli_query($connection, $serch_qry);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $address = $row['userid'];
            $sms_sender = new SMSSender($SMS_SERVER_URL, APP_ID, APP_PASSWORD);
            $sms_sender->sms($rep_msg, $address);
        }
    }

    header('Location: https://ideamarthosting.dialog.lk/milindalApps/egreen/websmsintf.php');
} catch (SMSServiceException $e) {
    $logger->WriteLog($e->getErrorCode() . ' ' . $e->getErrorMessage());
    echo $e;
}
