<?php 

session_start();


?>

<head>
    <?php require "./script/head.php"; ?>
    <title><?php include './config.php'; echo $config["title"]; ?></title>
</head>

<body>
 <?php 

 require "./src/sql/sql.php"; 
 require "./script/scripts.php"; 
 require "./src/layout.php";

 ?>
    <!-- Login User -->
    <?php 

        if(isset($_GET['action'])) {


            if($_GET['action'] == 'logout') {
                unset($_SESSION['username']); 
                echo "<script>location.href = 'reload.php';</script>";
            }

        }


        require "./src/func/user.php";

        $hash_type = new sha256();
    
        if(isset($_POST['submit_login'])) {

            $error = login_process($_POST['login_user'],$_POST['login_pass'], $hash_type);
            if($error['status'] == 'success') {
                $_SESSION['username'] = $_POST['login_user'];
                echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Welcome back',
                        text: '".$error['msg']."',
                    }).then((result) => {
                        location.href = 'reload.php';
                    })
                </script>
                ";
            } else {
                echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: '".$error['msg']."',
                    }).then((result) => {
                        $('#login_form').modal('open');
                    })
                </script>
                ";
            }


        }
    ?>

    <?php  
        require './src/func/action_buy.php';
        require './src/api/Rcon.php';
    
        if(isset($_POST['action'])) {
            if($_POST['action'] == 'buy') {
                $server_info = fetchs("SELECT * FROM server WHERE id = :id",array("id" => $_POST['server_id']));
                $product_info = fetchs("SELECT * FROM product WHERE id = :id",array("id"=> $_POST['product_id']));
                $data = buy_product($_POST['player'], $product_info['price'], $server_info['rcon_host'], $server_info['rcon_port'], $server_info['rcon_pass'], 5, $product_info['cmd']);

                if($data['status'] == 'success') {
                    echo "
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ',
                            text: '".$data['msg']."',
                        }).then((result) => {
                            location.href = 'reload.php';
                        })
                    </script>
                    ";                    
                } else {
                    echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'ข้อผิดพลาด',
                            text: '".$data['msg']."',
                        }).then((result) => {
                            location.href = 'reload.php';
                        })
                    </script>
                    ";  
                }
            }

            if($_POST['action'] == 'topup') {

                require './src/func/topup.php';

                $data_tw = json_decode($tw_data, true);
                
                $check_status = str_contains($data_tw['status']['code'], 'SUCCESS');
                
                if($check_status) {
                    $_update_ = query("UPDATE authme SET point = point + :p WHERE realname = :player", array(":p"=>$data_tw['data']['voucher']['redeemed_amount_baht'], ":player"=>$_POST['ref_p']));
                    if($_update_) {
                        echo "
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: 'คุณได้เติมเงิน ".$data_tw['data']['voucher']['redeemed_amount_baht']."',
                            }).then((result) => {
                                location.href = 'reload.php';
                            })
                        </script>
                        "; 
                    } else {
                        echo "
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถทำรายการได้',
                                text: 'ฐานข้อมูลมีปัญหา',
                            }).then((result) => {
                                location.href = 'reload.php';
                            })
                        </script>
                        "; 
                    }
                } else {

                    echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'ไม่สามารถทำรายการได้',
                            text: '".$data_tw['status']['message']."',
                        }).then((result) => {
                            location.href = 'reload.php';
                        })
                    </script>
                    "; 

                }

            }
        } 


    
    
    ?>



</body>