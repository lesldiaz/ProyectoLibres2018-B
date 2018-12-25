<?php
    ## connect to database with pdo
    $pdo = new PDO('mysql:host=localhost;dbname=sistemaoa;charset=utf8', 'root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
