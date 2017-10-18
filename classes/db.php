<?php
Class DbClass{
    protected static $connection;
/**
* Connect to Database
* @return mixed The result of the connect function
*
*/
public function connect() {    
    // Try and connect to the database
    if(!isset(self::$connection)) {
        // Load configuration as an array. Use the actual location of your configuration file
        $config = parse_ini_file('./config.ini'); 
        self::$connection = new mysqli('localhost',$config['username'],$config['password'],$config['dbname']);
    }

    // If connection was not successful, handle the error
    if(self::$connection === false) {
        // Handle error - notify administrator, log to a file, show an error screen, etc.
        return false;
    }
    return self::$connection;
}

        /**
         * Query the database
         *
         * @param $query The query string
         * @return mixed The result of the mysqli::query() function
         */
         public function query($query) {
            // Connect to the database
            $connection = $this -> connect();
    
            // Query the database
            $result = $connection -> query($query);
    
            return $result;
        }

        /**
         * Fetch rows from the database (SELECT query)
         *
         * @param $query The query string
         * @return bool False on failure / array Database rows on success
         */
         public function select($query) {
            $rows = array();
            $result = $this -> query($query);
            if($result === false) {
                return false;
            }
            while ($row = $result -> fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        }

}
?>