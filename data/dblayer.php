<?php
class Config {
    const HOST = "localhost";
    const USER = "root";
    const PASS = "root";
    const DB_NAME = "frontend-test";
    const CREATED_AT ="created_at";
    const CONTACT_MSG_TABLE 	= "contact_msg";
    const CONTACT_MSG_NAME 		= "name";
    const CONTACT_MSG_EMAIL 	= "email";
    const CONTACT_MSG_WEBSITE 	= "website";
    const CONTACT_MSG_MSG 	    = "msg";
    const CONTACT_MSG_READ 	    = "readit";
}

class DBConnection extends Config  {

    public function __construct() {}

    static function getConnection() {
        $mysqli = new mysqli(self::HOST, self::USER, self::PASS, self::DB_NAME);
        if ($mysqli->connect_error) {
            die("Can't connect to mysql (" . $mysqli->connect_errno . ") ". $mysqli->connect_error);
        }
        return $mysqli;
    }

    /*static function getLatestTop10ResultFromDB() {
        $imdbtop10_db = self::getConnection();
        $query = "SELECT t1 . * FROM ".self::TOP10_TABLE." t1 WHERE t1." .self::TOP10_DATE." = (SELECT t2.".self::TOP10_DATE.
            " FROM ".self::TOP10_TABLE." t2 ORDER BY t2.".self::TOP10_ID." DESC LIMIT 1 ) ORDER BY t1.".self::TOP10_RANK;
        $movies = array();
        $result = mysqli_query($imdbtop10_db, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($movies,$row);
        }
        mysqli_close($imdbtop10_db);
        return $movies;
    }
    static function getTop10ResultFromDB($date) {
        $imdbtop10_db = self::getTop10Connection();
        $query = "SELECT * from ".self::TOP10_TABLE." where date = '".$imdbtop10_db->escape_string($date)."';";
        $movies = array();
        $result = mysqli_query($imdbtop10_db, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($movies,$row);
        }
        mysqli_close($imdbtop10_db);
        return $movies;
    }

    static function checkIfDateExistInDB($date){
        $imdbtop10_db = self::getConnection();
        $query = "SELECT COUNT(id) from ".self::TOP10_TABLE." where date = '".$date."';";
        $nrOfRowsWithSpecificDate = mysqli_fetch_array(mysqli_query($imdbtop10_db, $query));
        mysqli_close($imdbtop10_db);
        return $nrOfRowsWithSpecificDate[0] > 0;
    }*/

    static function saveMessageToDB($fullname, $email, $website, $msg){
        $db = self::getConnection();
        $logDate = date("Ymd H:m:s");
        $now = date('Y-m-d H:i:s');
        if ($db) {
            $query = 'INSERT INTO '.self::CONTACT_MSG_TABLE.' ('.
                self::CREATED_AT.', '.
                self::CONTACT_MSG_NAME.', '.
                self::CONTACT_MSG_EMAIL.', '.
                self::CONTACT_MSG_WEBSITE.', '.
                self::CONTACT_MSG_MSG.', '.
                self::CONTACT_MSG_READ.')
								VALUES ("'.$now.'", "'.
                    $fullname.'", "'.
                    $email.'", "'.
                    $website.'", "'.
                    $msg.'", "'.
                    false.'");';

            //echo("Query=".$query);

            $resultOfInsert = mysqli_query($db, $query);
            if ($resultOfInsert) {
                //echo $logDate." Succesfully update db\n";
                return true;
            } else {
                echo $logDate." Error update db\n";
                return false;
            }

        } else {
            mysqli_close($db);
            throw new Exception("Can't save to database, no database connection");
        }

    }
}