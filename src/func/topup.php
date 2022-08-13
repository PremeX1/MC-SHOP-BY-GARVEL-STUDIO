<?php 
    include "../../config.php";
    include './src/api/trueWallet.php';
    $api = new trueWallet($config['tw_phone'],$_POST['tw_url']);
    $tw_data = $api->toPup();
?>