<div class="container center">
    <p class="center" id="txt3">เติมเงินด้วยทรูมันนี่ วอเล็ต</p>
    <div class="col m12 s12">
        <img src="/public/tmw.png" alt="" class="responsive-img col m8 s8 offset-m2 offset-s2"></img>
    </div>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <form method="post">
        <div class="input-field">
        <input name="tw_url" type="url" id="gift_code" class="validate">
        <input name="ref_p" hidden type="text" value="<?php echo $_SESSION['username']; ?>">
        <label for="gift_code">กรอกลิงค์ซองของขวัญ</label>
        </div>
        <br/>
        <button class="btn darken-3 col s12 m12" type="submit" name="action" value="topup"><i class="material-icons prefix">add_box</i>&nbsp; เติมเงิน</button>
    </form>
</div>