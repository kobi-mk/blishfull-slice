<?php
$connect = mysqli_connect("localhost","root","","cake_shop");
if(!$connect)
{
    die("Sorry, server connection error".mysqli_connect_error());
}
?>