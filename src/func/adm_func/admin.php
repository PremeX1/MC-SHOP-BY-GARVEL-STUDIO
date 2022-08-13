<?php 
 //System by Garvel Stduio
include '../config.php';
$host = $config['sql_host'];
$db = $config['sql_db'];
$username = $config['sql_user'];
$password = $config['sql_pass'];

try {
  $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

function query($sql, $array=array()) {
  global $conn;
  $q = $conn->prepare($sql);
  $q->execute($array);

  return $q;
}

function fetch($sql, $array=array()) {
  global $conn;
  $q = $conn->prepare($sql);
  $q->execute($array);
  $f = $q->fetchAll(PDO::FETCH_ASSOC);

  return $f;
}

function fetchs($sql, $array=array()) {
  global $conn;
  $q = $conn->prepare($sql);
  $q->execute($array);
  $fs = $q->fetch(PDO::FETCH_ASSOC);

  return $fs;

}

// Checking session is same as data in database
function CheckingAdmin($username) {
    include '../config.php';
    foreach($admin as $c_user) {
        if($c_user[$username]) {
            return $c_user[$username];
        } else {
            return false;
        }
    }
}

function backend_login($username, $password) {
    include '../config.php';
    foreach($admin as $data) {
        if($data[$username]) {
            if($data[$username]['password'] == $password) {
                $res['user'] = $username;
                $res['status'] = true;
                return $res;
            } else  {
                return false;
            }
        } else {
            return false;
        }
    }
}

function adm_alert($type, $msg) {
    if($type == 'success') {
        $msg = "<div class='btn green'><i class='material-icons'>done</i> &nbsp; ".$msg."</div>";
    } else if($type == 'error'){
        $msg = "<div class='btn red'><i class='material-icons'>close</i> &nbsp; ".$msg."</div>";
    } 

    

    return $msg;

}

function setPoint($player, $amount) {

    if(isset($_SESSION['admin'])) {
        if(isset($player)) {
            $update_player = query("UPDATE `authme` SET `point` = :amount WHERE realname = :id", array("id" => $player, "amount" => $amount));
            if($update_player) {
                return adm_alert('success', 'แก้ไขสำเร็จ');
            } else {
                return adm_alert('error', 'พบข้อผิดพลาดไม่สามารถแก้ไขได้');
            }
        }
    }
}


function adm_product($action, $array) {
    switch($action) {
        case "add":
            $insert_data = query("INSERT INTO `product` (`id`, `name`, `price`, `info`, `cmd`, `server_id`, `img_path`) VALUES (NULL, :p_name, :price, :info, :cmd, :sv_id, :img)",$array);
            if($insert_data) {
                return adm_alert('success', "เพิ่มสินค้าสำเร็จ!");
            }
            break;
        case "edit":
            $update_data = query("UPDATE `product` SET `name` = :p_name, `price` = :price, `info` = :info, `cmd` = :cmd, `server_id` = :sv_id, `img_path` = :img WHERE `product`.`id` = :id",$array);
            if($update_data) {
                return adm_alert('success', "แก้ไขสำเร็จ");
            }   
            break;
        case "del":
            $delete_data = query("DELETE FROM product WHERE `id` = :id", $array);     
            if($delete_data) {
                return adm_alert('success', "ลบสำเร็จแล้ว");
            }
            break;
        case "add_sv":
            $insert_server = query("INSERT INTO `server` (`id`, `rcon_name`, `rcon_host`, `rcon_port`, `rcon_pass`, `rcon_img_path`) VALUES (NULL, :sv_name, :sv_host, :sv_port, :sv_pass, :sv_img)", $array);      
            if($insert_server) {
                return adm_alert('success', "เพิ่มเซิฟเวอร์สำเร็จแล้ว");
            }
            break;

        default:
            return false;
    }
}


function del_sv($id) {
    $result = query("DELETE FROM `server` WHERE id = :id", array("id" => $id));
    print_r($result);
    if($result) {
        return 1;
    } else {
        return 0;
    }
}
