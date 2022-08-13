<?php



if (isset($_POST['adm_edit'])) {
  echo ("<script>
  $(document).ready(function(){
     $('#edit_item').modal('open'); 
  });
 </script>");
}

if(isset($_POST['edit_player_by']) && isset($_SESSION['admin'])) {
  $find_player = fetch("SELECT * FROM authme WHERE realname = :user", array("user" => $_POST['edit_player_by']));
  if($find_player) {
    echo ("<script>
    $(document).ready(function(){
       $('#edit_player').modal('open'); 
    });
   </script>");
  } else {
    $msg = adm_alert('error', 'ไม่พบผู้เล่น');
  }

}


if (isset($_POST['action'])) {

  if (isset($_FILES['add_pimg'])) {
    $target_file = '../public/' . basename($_FILES["add_pimg"]["name"]);
    move_uploaded_file($_FILES["add_pimg"]["tmp_name"], $target_file);
  }
  if (isset($_FILES['edit_pimg'])) {
    $edit_target_file = '../public/' . basename($_FILES["edit_pimg"]["name"]);
    move_uploaded_file($_FILES["edit_pimg"]["tmp_name"], $edit_target_file);
    print($edit_target_file);
  }

  if (isset($_FILES['add_svimg'])) {
    $sv_target_file = '../public/' . basename($_FILES["add_svimg"]["name"]);
    move_uploaded_file($_FILES["add_svimg"]["tmp_name"], $sv_target_file);
  }

  switch ($_POST['action']) {
    case "add_item":
      $msg = adm_product("add", array(
        "p_name" => $_POST['add_pname'],
        "price" => $_POST['add_pprice'],
        "info" => $_POST['add_pinfo'],
        "sv_id" => $_POST['add_psv'],
        "cmd" => $_POST['add_pcmd'],
        "img" => $target_file
      ));
      break;

    case "edit_item":
      $msg = adm_product("edit", array(
        "p_name" => $_POST['edit_name'],
        "price" => $_POST['edit_price'],
        "info" => $_POST['edit_info'],
        "cmd" => $_POST['edit_cmd'],
        "sv_id" => $_POST['edit_sv'],
        "img" => $edit_target_file,
        "id" => $_POST['id'],
      ));
      break;

    case "del_item":
      echo $_POST['adm_edit'];
      $msg = adm_product("del", array(
        "id" => $_POST['id']
      ));
      break;

    case "add_server":

      // echo($sv_target_file);
      // echo($_POST['sv_name']);
      // echo($_POST['sv_host']);
      // echo($_POST['sv_port']);
      // echo($_POST['sv_pass']);
      $msg = adm_product("add_sv", array(
        "sv_name" => $_POST['sv_name'],
        "sv_host" => $_POST['sv_host'],
        "sv_port" => $_POST['sv_port'],
        "sv_pass" => $_POST['sv_pass'],
        "sv_img" => $sv_target_file,
      ));
      break;

    case "edit_player_submit":
    
      $msg = setPoint($_POST['edit_player_name'], $_POST['edit_player_point']);

      echo("test");
      break;

    default:
  }







  // unset($_POST['action']);
  // header('refresh: 1');
}


function page_add_item()
{
  $opt = query("SELECT * FROM server");
  $value = query("SELECT * from product");
  echo ("
    <h5>เพิ่มสินค้า</h5>
    <hr/>
    <form method='post' enctype='multipart/form-data'>
    <input name='action' value='add_item' hidden>
    <table>
    <thead>
      <tr>
          <th>ID</th>
          <th>ชื้อสินค้า</th>
          <th>ราคา</th>
          <th>ข้อมูลสินค้า</th>
          <th>เลือกเซิฟเวอร์</th>
          <th>คำสั่ง</th>
          <th>อัพโหลดรูป</th>
          <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Auto</td>
        <td style='width: 10%'><input type='text' name='add_pname' placeholder='ชื้อสินค้า' required></td>
        <td style='width: 10%'><input type='number' name='add_pprice' placeholder='กำหนดราคา' required></td>
        <td style='width: 20%'><input type='text' name='add_pinfo' placeholder='ข้อมูลสินค้า' required></td>
        <td style='width: 10%'>
          <select class='select' name='add_psv' required>
          ");
  foreach ($opt as $res) {
    echo ("<option value=" . $res['id'] . ">" . $res['rcon_name'] . "</option>");
  }
  echo ("
          </select>
        </td>
        <td style='width: 20%'><input type='text' name='add_pcmd' placeholder='ตัวอย่าง: give {player} diamond ' required></td>
        <td style='width: 10%'>
          <div class='file-field btn-small blue'>
            <span>เลือกไฟล์ภาพ</span>
            <input name='add_pimg' id='add_pimg' type='file' required>
          </div>
        </td>
        <td>
        <button type='submit' class='btn green'><i class='material-icons prefix'>add</i> &nbsp;เพิ่ม</button>
        <td
      </tr>
    </tbody>
  </table>
  </form>
  <br/>");
  echo ("
    <h5>สินค้าทั้งหมด</h5>
    <hr/>
    <table>
    <thead>
      <tr>
          <th>ID</th>
          <th>ชื้อสินค้า</th>
          <th>ราคา</th>
          <th>ข้อมูลสินค้า</th>
          <th>เซิฟเวอร์</th>
          <th>คำสั่ง</th>
          <th>ตำแหน่งรูป</th>
          <th>Action</th>
      </tr>
    </thead>
    ");
  foreach ($value as $result) {
    echo ("     
    <form method='post'>
    <tbody>
      <tr>
        <td>" . $result['id'] . "</td>
        <td>" . $result['name'] . "</td>
        <td>" . $result['price'] . "</td>
        <td>" . $result['info'] . "</td>
        <td>" . $result['server_id'] . "</td>
        <td>" . $result['cmd'] . "</td>
        <td style='width: 10%'>" . $result['img_path'] . "</td>
        <td><button type='submit' name='adm_edit' value='" . $result['id'] . "' class='btn orange'>จัดการ</button></td>
      </tr>
    </tbody>
    </form>");
  }
  echo ("</table>");
}

function page_edit_player() {
  $p_query = query("SELECT * FROM authme");
  echo("<h5>จัดการข้อมูลผู้เล่น</h5> <hr / > <br / ><form method='post'><input type='text' name='edit_player_by' placeholder='กรอกชื่อผู้ใช้'></form> <br />");
  echo ("
  <table>
  <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>IP</th>
        <th>Points</th>
    </tr>
  </thead>
  <tbody>
   
  ");
  foreach ($p_query as $p) {
    if($p['ip'] == NULL) { $p_ = "ไม่พบไอพีผู้เล่น"; } else { $p_ = $p['ip']; }
    echo ("
  <form method='post'>
    <tr>
      <td>" . $p["id"] . "</td>
      <td>" . $p["realname"] . "</td>
      <td>" . $p_ . "</td>
      <td>" . $p["point"] . "</td>
      <td><button type='submit' name='edit_player_by' value='" . $p["realname"] . "' class='btn red'>แก้ไข</button></td>
    </tr>
  </form>
  ");
  }

  echo ("
  </tbody>
  </table>");
}

if (isset($_POST['sv_del_id'])) {
  if (del_sv($_POST['sv_del_id']) == 1) {
    echo (del_sv($_POST['sv_del_id']));
    unset($_POST['sv_del_id']);
    header("refresh 1;");
  } else {
    echo ("False0");
  }
}
function page_add_server()
{
  $sv = query("SELECT * FROM `server`");

  echo ("
    <h5>เพิ่มเซิฟเวอร์</h5>
    <hr/>
    <form method='post' enctype='multipart/form-data'>
    <input name='action' value='add_server' hidden >
    <table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Rcon Name</th>
        <th>Rcon Host</th>
        <th>Rcon Port</th>
        <th>Rcon Pass</th>
        <th>Images</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
      <tr>
        <td>Auto</td>
        <td style='width: 10%'><input type='text' name='sv_name' placeholder='ชื้อเซิฟเวอร์' required></td>
        <td style='width: 10%'><input type='text' name='sv_host' placeholder='ที่อยู่ไอพี' required></td>
        <td style='width: 20%'><input type='number' name='sv_port' placeholder='พอร์ตของ RCON' required></td>
        <td style='width: 20%'><input type='text' name='sv_pass' placeholder='รหัสผ่าน RCON' required></td>
        <td style='width: 10%'>
          <div class='file-field btn-small blue'>
            <span>เลือกไฟล์ภาพ</span>
            <input name='add_svimg' id='add_svimg' type='file'>
          </div>
        </td>
        <td>
        <button type='submit' class='btn green'><i class='material-icons prefix'>add</i> &nbsp;เพิ่ม</button>
        <td
      </tr>
    </tbody>
  </table>
  </form>
  <br/>");

  echo ("
  <table>
  <thead>
    <tr>
        <th>ID</th>
        <th>Rcon Name</th>
        <th>Rcon Host</th>
        <th>Rcon Port</th>
        <th>Rcon Pass</th>
        <th>Images</th>
        <th>Action</th>
    </tr>
  </thead>
  <tbody>
   
  ");
  foreach ($sv as $lsv) {
    echo ("
  <form method='post'>
    <tr>
      <td>" . $lsv["id"] . "</td>
      <td>" . $lsv["rcon_name"] . "</td>
      <td>" . $lsv["rcon_host"] . "</td>
      <td>" . $lsv["rcon_port"] . "</td>
      <td>" . $lsv["rcon_pass"] . "</td>
      <td>" . $lsv["rcon_img_path"] . "</td>
      <td><button type='submit' name='sv_del_id' value='" . $lsv["id"] . "' class='btn red'>ลบ</button></td>
    </tr>
  </form>
  ");
  }

  echo ("
  </tbody>
  </table>");
}
