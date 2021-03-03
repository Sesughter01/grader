<?php 
try{
    $connn=new PDO("mysql:host=localhost;dbname=church_manager", 'root',"Kelikume11&&");
    // set the PDO error mode to exception
    $connn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed:" .$e->getMessage();

}


?>