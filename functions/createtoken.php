<?php

function createToken() {

  $_SESSION["token"] = bin2hex(random_bytes(32));
}

?>