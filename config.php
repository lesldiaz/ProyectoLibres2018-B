<?php
/**
 * Created by PhpStorm.
 * User: mjg70
 * Date: 10/6/2018
 * Time: 16:54
 */
$mysqli=new mysqli('localhost','root','root','sistemaoa');

if($mysqli->connect_error){
    echo $mysqli->connect_error;
}

