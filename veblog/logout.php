<?php 
require("./functions.php");

if(! athenticated()){
      redirect('index.php');
}


logout();



?>