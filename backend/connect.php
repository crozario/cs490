<?
//Creates a connection to server
//@param: database name
public function connection($db){
        $servername = "sql.njit.edu";
        $username = "eo65";
        $dbpassword = "";
        $dbname = "eo65";

        //Create connection
        $conn = new mysqli($servername, $username, $dbpassword, $dbname);
        if ($conn->connect_error) die($conn->connect_error);
        //check if database exists
        $database=$conn->select_db($db);
        if (!$database){
                die ('Database does not exist'.mysql_error());
        }
        else{
                return $database;
        }
}
?>