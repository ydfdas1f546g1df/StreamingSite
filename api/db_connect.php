<?php
$data = json_decode(file_get_contents('C:\Users\Colin\PhpstormProjects\StreamingSite\api\database.json'),true);

$mysqli = mysqli_connect($data['host'], $data['username'], $data['password'], $data['name']);