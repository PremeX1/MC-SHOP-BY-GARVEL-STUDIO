

<ul id="dropdown2" class="dropdown-content">
    <?php if(isset($_SESSION['username'])) {?>
    <li><a href="?l=home">หน้าหลัก</a></li>
    <li><a href="?l=shop">ซื้อสินค้า</a></li>
    <li><a href="?l=topup">เติมเงิน</a></li>
    <?php } else { ?>
    <li><a class="modal-trigger" href="#login_form">เข้าสู่ระบบ</a></li>
    <?php } ?>
</ul>
<nav>
    <div class="nav-wrapper white">
        <ul>
            <li class="left"><a class="" onClick="history.back()" data-target="dropdown2"><i class="material-icons left blue-text">arrow_left</i></a></li>
            <li class="right"><a class="btn dropdown-trigger" href="#!" data-target="dropdown2">ตัวเลือก<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
    </div>
</nav>
<div class="card-panel round scroller" style="width: 100%; height: 50%;">
    <div class="">
        <div class="card-content">
            <?php
            if (isset($_SESSION['username'])) {
                require './components/main/load.php';
            } else {
                echo '
                <div class="card-panel red lighten-3 round">
                    <div class="card-content">
                        <div class="center"> <i class="small material-icons">error</i> </div>
                        <h5 class="center">กรุณาเข้าสู่ระบบก่อนทำรายการ</h5>
                    </div>
                </div>
                <hr/>
                ';
                require './components/main/home.php';
            }
            ?>
        </div>
    </div>
</div>
<div class="card-action">
        <a class="btn orange" href="reload.php"><i class="material-icons">arrow_left</i>ย้อนกลับ</a></li>
</div>
