<?php  $user = fetchs("SELECT * FROM authme WHERE realname = :name", array("name"=> $_SESSION['username'])); $point = $user['point']; ?>

<!-- Modal Structure -->
<div class="card round">
    <div class="card-content center">
        <?php
        if (empty($_SESSION['username'])) {
        ?>
            <p class="red col round badge-text white-text"><i class="material-icons prefix">error_outline</i> คุณยังไม่เข้าสู่ระบบ</p>
        <?php } else {
            echo '<p class="center grey round user_hightlight"><b>Member Information</b></p>';
        } ?>
        <br /><br />
        <?php
        if (isset($_SESSION['username'])) {
            echo '<img class="round space responsive-img" src="https://minotar.net/avatar/' . $_SESSION['username'] . '/100.png">';
        } else {
            echo '<img class="round space responsive-img" src="https://minotar.net/avatar/alex/100.png">';
        }
        ?>
    </div>
    <?php if (isset($_SESSION['username'])) { ?>
        <div class="card-content center">
            <ul class="collection with-header">
                <li class="collection-header">
                    <p><b>ข้อมูลผู้ใช้</b></p>
                </li>
                <b>
                <li class="collection-item">
                    <div><i class="material-icons left">person</i> ชื่อผู้ใช้<a href="#!" class="secondary-content grey round text-white user_hightlight"><?php echo $_SESSION['username']; ?></a></div>
                </li>
                <li class="collection-item">
                    <div><i class="material-icons left">attach_money</i> ยอดเงินคงเหลือ<a href="#!" class="secondary-content grey round text-white user_hightlight"><?php echo $point; ?> Point. </a></div>
                </li>
                <li class="collection-item">
                    <div><i class="material-icons left">data_usage</i> ยอดเงินที่ใช้แล้ว<a href="#!" class="secondary-content grey round text-white user_hightlight"><?php echo $point; ?> Point. </a></div>
                </li>
                <li class="collection-item">
                    <div><i class="material-icons left">add_circle_outline</i> เติมเงิน<a href="?l=topup" class="secondary-content orange round user_hightlight">เติมเงิน</a></div>
                </li>
                </b>
            </ul>
        </div>
        <div class="card-content grey lighten-3 center">
        <div class="row">
            <div class="col s12">
                <a class="btn red" href="?action=logout" style="width: 100%;"><i class="material-icons">exit_to_app</i> ออกจากระบบ</a>
            </div>
        </div>
    </div>
    <?php } else { ?>
        <div class="card-content center">
            <div class="row">
                <div class="col s12">
                    <a class="btn green modal-trigger" href="#login_form" style="width: 100%;"><i class="material-icons prefix">lock</i> &nbsp; เข้าสู่ระบบ</a>
                </div>
                <div class="col s12 space">
                    <a class="btn purple modal-trigger" href="#howtologin" style="width: 100%;"><i class="material-icons prefix">bookmark</i> &nbsp; วิธีการเข้าสู่ระบบ</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>