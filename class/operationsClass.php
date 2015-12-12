<?php

require 'db.php';

class Operations {

    public $session_id = '';
    public $session_menu = '';
    public $session_pg = 0;
    public $session_tel = '';
    public $session_others = '';
    public $res_arry = array();
    public $res_arry_id = array();

    public function setSessions($sessions) {
        global $connection;
//        $connection = mysqli_connect("localhost", "root", "123", "sessiondb");
//        mysqli_select_db($connection, "sessiondb");

        $sql_sessions = "INSERT INTO `redsessions` (`sessionsid`, `tel`, `menu`, `pg`, `created_at`,`others`,`longitude`,`latitude`) VALUES 
			('" . $sessions['sessionid'] . "', '" . $sessions['tel'] . "', '" . $sessions['menu'] . "', '" . $sessions['pg'] . "', CURRENT_TIMESTAMP,'" . $sessions['others'] . "', '" . $sessions['longitude'] . "', '" . $sessions['latitude'] . "')";

        mysqli_query($connection, $sql_sessions);
//        mysqli_close($connection);
//        return $sql_sessions;
    }

    public function getSession($sessionid) {
        global $connection;
//        $connection = mysqli_connect("localhost", "root", "123", "sessiondb");
        $sql_session = "SELECT *  FROM  `redsessions` WHERE  sessionsid='" . $sessionid . "'";
        $quy_sessions = mysqli_query($connection, $sql_session);
        $fet_sessions = mysqli_fetch_array($quy_sessions);
        $this->session_others = $fet_sessions['others'];
//        mysqli_close($connection);
        return $fet_sessions;
    }

    public function saveSesssion() {
        global $connection;
//        $connection = mysqli_connect("localhost", "root", "123", "sessiondb");
        $sql_session = "UPDATE  `redsessions` SET 
			`menu` =  '" . $this->session_menu . "',
			`pg` =  '" . $this->session_pg . "',
			`others` =  '" . $this->session_others . "'
			WHERE `sessionsid` =  '" . $this->session_id . "'";
        mysqli_query($connection, $sql_session);
//        mysqli_close($connection);
    }

    public function setAlert($paramarry) {
        global $connection;
        $sql_sessions = "INSERT INTO `redalert` (`number`, `type`, `latitude`, `longitude`, `alert_time`) VALUES 
			('" . $paramarry['number'] . "', '" . $paramarry['type'] . "', '" . $paramarry['latitude'] . "', '" . $paramarry['longitude'] . "','" . $paramarry['alert_time'] . "')";
        mysqli_query($connection, $sql_sessions);
    }

    function closeConn() {
        global $connection;
        mysqli_close($connection);
    }

}

?>