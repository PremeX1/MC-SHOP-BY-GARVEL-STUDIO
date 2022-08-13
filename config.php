<?php

error_reporting(0);

$config = array(
    "title" => "Minecraft Free OpenSource Store | Garvel Studio",
    "sql_host" => "localhost",
    "sql_user" => "root",
    "sql_pass" => "",
    "sql_db" => "mc_db",
    "tw_phone" => "TEST-STORE"
);



//ตั้งค่า 
$admin = array(
    "user" => 
    [
        "Admin" => 
        [

            "id" => "1",
            "password" => "admin1234"

        ],
        "Staff" => 
        [
            
            "id" => "2",
            "password" => "admin1234"

        ]
    ]
);
?>