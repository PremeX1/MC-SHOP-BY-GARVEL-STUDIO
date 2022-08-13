<?php 


if(isset($_GET['l'])) {
    switch($_GET['l']) {
        case "shop":
            require './components/main/shop.php';
            break;
        case "home":
            require './components/main/home.php';
            break;
        case "topup":
            require './components/main/topup.php';
            break;
        default:
            require './components/main/home.php';
            break;
    }
} else {
    require './components/main/home.php';
}




?>