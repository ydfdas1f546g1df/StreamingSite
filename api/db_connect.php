<?php
$data = json_decode(file_get_contents(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/database.json'),true);

$mysqli = mysqli_connect($data['host'], $data['username'], $data['password'], $data['name']);