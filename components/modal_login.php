<?php 

if(empty($_SESSION['username'])) {
?>
<div id="login_form" class="modal">
    <div class="modal-content">
        <div class="round blue lighten-1 login-header">
            <h5 class="white-text center">Member Login - เข้าสู่ระบบ</h5>
        </div>
        <br />
        <div class="row space">
            <form class="col m12 space" method="post">
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">person_outline</i>
                        <input id="icon_prefix" name="login_user" type="text" class="validate" required>
                        <label for="icon_prefix">Username</label>
                    </div>
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix">lock</i>
                        <input minlength="8" id="icon_telephone" name="login_pass" type="password" class="validate" required>
                        <label for="icon_telephone">Password</label>
                    </div>
                </div>
                <button type="submit" name="submit_login" class="btn green right">เข้าสู่ระบบ</button>
            </form>
        </div>
    </div>
</div>
<?php } else { 

}?>