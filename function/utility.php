<?php 
	function connectDB() {
	
	 $noDatabase = true;
	  	
	if(getenv("VCAP_SERVICES"))
    {
        $services_json = json_decode(getenv("VCAP_SERVICES"),true);
        $mysql_config = $services_json["mysql-5.1"][0]["credentials"];
        $username = $mysql_config["username"];
        $password = $mysql_config["password"];
        $hostname = $mysql_config["hostname"];
        $port = $mysql_config["port"];
        $db = $mysql_config["name"];

        $link = mysql_connect("$hostname:$port", $username, $password);
  
        $db_selected = mysql_select_db($db, $link);
    }
	  	
	else
	{
	    		$link = mysql_connect("localhost", "root", "123456");
		mysql_query('SET NAMES utf8');
		mysql_select_db('dbproject');
	  	
	}




	
	  return $link;
	}
?>