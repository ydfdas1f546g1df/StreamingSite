<?php

$to = "colin.heggli@gmail.com";
$subject = "Hello ma friend";


$headrs = array(
    "MINE-Version" => "1.0",
    "Content-Type" => "text/html;charset=UFT-8",
    "From" => "colin.heggli@gmail.com",
    "Reply-To"=> "colin.heggli@gmail.com"
);
$message = "memo mail";

$send =mail($to, $subject, $message, $headrs);

echo ($send ? "Mail is Send" : "Error");