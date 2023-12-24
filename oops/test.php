<?php
 include "config.php";

 $obj = new query();
 //$result = $obj->getData('user','*','','','name',);
 $result = $obj->getData('user','*');
 echo "<pre>";
 print_r($result);
 

?>