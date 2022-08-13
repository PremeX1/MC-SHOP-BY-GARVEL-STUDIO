<?php 
use Thedudeguy\Rcon;

if(isset($_SESSION['username'])) {

    function buy_product($player, $price, $host, $port, $password, $timeout, $command) {

        $player_price = fetchs("SELECT * FROM authme WHERE realname = :name", array("name"=> $player));

        if($player_price['point'] != 0 and $player_price['point'] >= $price) {

            $rcon = new Rcon($host, $port, $password, $timeout);

            $replace_by_player = str_replace("{player}", $player_price['realname'], $command);

            echo($replace_by_player);
            if ($rcon->connect()) {
                if($rcon->sendCommand($replace_by_player)) {

                    $buy_price = abs($player_price["point"]-$price);

                    $update_player = query("UPDATE authme SET point = :p WHERE realname = :player", 
                    array("player"=>$player_price['realname'], "p"=>$buy_price));

                    if($update_player) {
                        $p_data['status'] = 'success';
                        $p_data['msg'] = 'สั่งซื้อสินค้าเรียบร้อยแล้ว!';
                        $p_data['price'] = $buy_price;
                        $p_data['product_price'] = $price;
                    } else {
                        $p_data['status'] = 'error';
                        $p_data['msg'] = 'ฐานข้อมูลมีปัญหา';
                    }
                } else {
                    $p_data['status'] = 'error';
                    $p_data['msg'] = 'ไม่สามารถเชื่อมต่อกับเซิฟเวอร์ได้';
                }
            } else {
                $p_data['status'] = 'error';
                $p_data['msg'] = 'ไม่สามารถเชื่อมต่อกับเซิฟเวอร์ได้';
            }

        } else {
            $p_data['status'] = 'error';
            $p_data['msg'] = 'ยอดเงินไม่เพียงพอ';
            $p_data['product_price'] = $price;
        }

        return $p_data;
    }


} else {
    
    die("Error");

}




?>