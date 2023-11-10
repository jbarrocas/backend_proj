<?php

function inputData($data) {

  $data =  htmlspecialchars(strip_tags(trim($data)));
  return $data;
  
}

?>