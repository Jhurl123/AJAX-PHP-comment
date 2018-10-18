<?php
//Class used for connecting to Database 
// returns the same connection if already connected
//Returns new connection if not - Justin Hurley
//=======================================================================


class ConnectScr
{

   function dbConn() {
   
       if(isset($conn)){
          
	        return $conn;
   
       }
   	
	   else {
	
	       $servername= "localhost";
           $username= "root";
           $password= "";
           $dbname = "commDB";
	
	        //create a new connection object
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
             return $conn;
	
	}
   }


}
	
	
	?>