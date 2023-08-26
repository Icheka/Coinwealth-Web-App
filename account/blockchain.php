<?php 
/*..
* THIS IS THE API CALL 
..*/
//error_reporting(0);
@session_start();

DEFINE("key", "5d98b4d4d55db990df2be346d976d96c");

$url = "https://api.nomics.com/v1/currencies/ticker?key=" . key . "&ids=BTC,ETH,XRP&interval=1d,30d&convert=USD";
//https://api.nomics.com/v1/currencies/ticker?key=demo-26240835858194712a4f8cc0dc635c7a&ids=BTC,ETH,XRP&interval=1d,30d&convert=USD
//5d98b4d4d55db990df2be346d976d96c

$api_return = file_get_contents($url);

$data = json_decode($api_return, true);

