<?php

if(empty($msg)) {
    // $msg = "<div class='btn green'><i class='material-icons'>done</i> &nbsp; เพิ่มสินค้าเรียบร้อย</div>";
    $msg = null;
}

echo $msg;

require '../config.php';
require '../backend/admin.php';

if (isset($_SESSION['admin'])) {
    $adm_status = CheckingAdmin($_SESSION['admin']);
    if ($adm_status == false) {
        unset($_SESSION['admin']);
        echo ("Failed");
        header("refresh: 1;");
    } else {
        require './page/main.php';
    }
} else {
}


?>
<div class="container space">
    <div class="row">
        <div class="col s4 m4">
            <div class="card-panel red lighten-1">
                <h5 class='white-text'><i class="material-icons Small">add_shopping_cart</i> จัดการสินค้า</h5>
                <hr/>
                <span class="white-text">
                <p>Total Items: 0</p>
                </span>
                <a href="?p=add_item" style="width: 100%" class="waves-effect waves-light red darken-3 btn-small">จัดการ</a>
            </div>
        </div>
        <div class="col s4 m4">
            <div class="card-panel light-blue lighten-1">
                <h5 class='white-text'><i class="material-icons Small">library_add</i> จัดการเซิฟเวอร์</h5>
                <hr/>
                <span class="white-text">
                <p>Total Items: 0</p>
                </span>
                <a href="?p=add_sv" style="width: 100%" class="waves-effect waves-light blue darken-1 btn-small">จัดการ</a>
            </div>
        </div>
        <div class="col s4 m4">
            <div class="card-panel green">
                <h5 class='white-text'><i class="material-icons Small">person_outline</i> จัดการผู้เล่น</h5>
                <hr/>
                <span class="white-text">
                <p>Total Items: 0</p>
                </span>
                <a href="?p=player" style="width: 100%" class="waves-effect waves-light green darken-1 btn-small">จัดการ</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
<div class='center'><?php echo $msg; ?></div>
<?php 
if(isset($_GET['p'])) {
    switch($_GET['p']) {
        case "add_item": page_add_item(); break;
        case "add_sv": page_add_server(); break;
        case "player": page_edit_player(); break;
    }
}


?>

<?php 
$data_player = fetch("SELECT * FROM authme WHERE realname = :id", array("id" => $_POST['edit_player_by']));
print_r($data);

$data = fetch("SELECT * FROM product WHERE id = :id", array("id" => $_POST['adm_edit']));
print_r($data);

?>

</div>
<form method="post" enctype='multipart/form-data'>
<input id="icon_prefix" value="<?php echo $data_player[0]["realname"]; ?>" name="edit_player_name" type="text" class="validate" hidden>
<input type='hidden' name='id' value='<?php echo $data_player[0]['id']; ?>' hidden>
<div id="edit_player" class="modal">
    <div class="modal-content">
        <div class="round blue lighten-1 login-header">
            <h5 class="white-text center">จัดการผู้เล่น : <?php echo $data_player[0]["realname"]; ?></h5>
        </div>
        <br />
        <div class="row space">
            <form class="col m12 space" method="post">
                <div class="row">
                    <div class="input-field">
                        <input id="icon_prefix" value="<?php echo $data_player[0]["realname"]; ?>" name="aaaaaaa" type="text" class="validate" disabled>
                        <label for="icon_prefix">ชื่อผู้เล่น</label>
                    </div>
                    <div class="input-field">
                        <input id="icon_prefix" value="<?php echo($data_player[0]["point"]); ?>" name="edit_player_point" type="number" class="validate" required>
                        <label for="icon_prefix">พ้อยผู้เล่น</label>
                    </div>
                    <br />
                </div>
                <button type="submit" value="edit_player_submit" name="action" class="btn green right">ตกลง</button>
            </form>
        </div>
    </div>
</div>

<div id="edit_item" class="modal">
    <div class="modal-content">
        <div class="round blue lighten-1 login-header">
            <h5 class="white-text center">จัดการสินค้า ID: <?php echo $data[0]["name"]; ?></h5>
        </div>
        <br />
        <div class="row space">
            <form class="col m12 space" method="post" enctype='multipart/form-data'>
                <input type='hidden' name='id' value='<?php echo $data[0]['id']; ?>'>
                <div class="row">
                    <div class="input-field">
                        <input id="icon_prefix" value="<?php echo($data[0]["name"]); ?>" name="edit_name" type="text" class="validate" required>
                        <label for="icon_prefix">ชื่อสินค้า</label>
                    </div>
                    <div class="input-field">
                        <input id="icon_prefix" value="<?php echo($data[0]["info"]); ?>" name="edit_info" type="text" class="validate" required>
                        <label for="icon_prefix">รายละเอียดสินค้า</label>
                    </div>
                    <div class="input-field">
                        <input id="icon_prefix" value="<?php echo($data[0]["price"]); ?>" name="edit_price" type="number" class="validate" required>
                        <label for="icon_prefix">ราคา</label>
                    </div>
                    <div class="input-field">
                        <select class='select' name='edit_sv' >
                            <?php 
                                $q = query("SELECT * FROM server");
                                foreach($q as $s) { ?>
                                    <option value="<?php echo $s['id'] ?>"><?php echo $s['rcon_name']; ?></option>
                                <?php } ?>
                        </select>
                        <label for="icon_prefix">เลือกเซิฟเวอร์</label>
                    </div>
                    <br/>
                    <div class="input-field">
                        <input id="icon_prefix" value="<?php echo($data[0]["cmd"]); ?>" name="edit_cmd" type="text" class="validate" required>
                        <label for="icon_prefix">คำสั่ง</label>
                    </div>
                    <div class="input-field">
                    <div class='file-field btn-small blue'>
                        <span>แก้ไขรูปภาพ (*จำเป็นต้องเลือก)</span>
                        <input name='edit_pimg' id='edit_pimg' type='file'>
                    </div>
                    <p class="red-text">*หากไม่เลือกรูปภาพจะหาย เลือกรูปใหม่หรือรูปเก่าจากไฟล์เดิม</p>
                    <br />
                </div>
                <button type="submit" value="edit_item" name="action" class="btn green right">ตกลง</button>
                <button type="submit" value="del_item" name="action" class="btn red left">ลบสินค้า</button>
            </form>
        </div>
    </div>
</div>
</form>