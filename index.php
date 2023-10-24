<?php
require_once "./boot.php";
if (auth()) header("Location: /home.php");
