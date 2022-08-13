<head>
    <?php require "../script/head.php"; ?>
    <?php require "../script/scripts.php"; ?>
    <title>Backend Dashboard</title>
</head>
<body>
<?php 

session_start();


if(isset($_GET['a'])) {
    unset($_SESSION['admin']);
}

require '../src/func/adm_func/admin.php';

if(isset($_POST['backend_user'])) {
    if(backend_login($_POST['backend_user'], $_POST['backend_pass']) != false) {
        $_SESSION['admin'] = $_POST['backend_user'];
    } 
}


if(isset($_SESSION['admin'])) {
    require 'dashboard.php';
} else {
    require("./page/login.php");
}



?>
</body>