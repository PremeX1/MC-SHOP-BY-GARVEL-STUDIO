<div class="row">
        <?php

        if (empty($_POST['server'] and empty($_POST['test']))) {
            echo '<form method="post">';
            $item = fetch("SELECT * FROM server");

            foreach ($item as $result) {
        ?>

                <div class="col s12 m6">
                    <div class="card-panel blue lighten-2 center round" href="#asdad">
                        <img src="<?php echo $result['rcon_img_path']; ?>" width="100" height="100">
                        <br /><br />
                        <button type="submit" name="server" value="<?php echo $result['id']; ?>" class="btn-large purple round center white-text" style="font-size: 20px;"><b><?php echo $result['rcon_name']; ?></b></b></button>
                        <br /><br />
                        <p></p>
                    </div>
                </div>

            <?php } ?>
</div>
</form>
<?php } else {

            $shop_item = fetch("SELECT * FROM product WHERE server_id = :id", array("id" => $_POST['server']));
            $sv_name = fetchs("SELECT * FROM server WHERE id = :id", array("id" => $_POST['server']))['rcon_name'];

            ?>
            <?php
            foreach ($shop_item as $item) {
                echo "
            <form method='post'>
            <div class='card col m12 grey lighten-5 round'>
                <div class='card-content'>
                    <div class='row'>
                    <div class='col m3 s12 center' style='margin-top: 10px'>
                        <img src='" . $item['img_path'] . "' width='150'>
                        <input hidden name='player' value='".$_SESSION['username']."'>
                        <input hidden name='server_id' value='".$item['server_id']."'>
                        <input hidden name='action' value='buy'>
                    </div>    
                    <div class='col m9 s12'>
                        <h5 class='dark-text'>" . $item['name'] . "</h5>
                        <p>Server: " . $sv_name . " ID: ".$item['id']."</p>
                        &nbsp;
                        <p class='dark-text'>" . $item['info'] . "</p>
                        <hr>
                        <button name='product_id' value='".$item['id']."' class='center green round waves-effect waves-light btn col s12' type='submit'>" . $item['price'] . " P.</button>
                    </div>
                    </div>
            </div>
        </div>
    ";
            }




?></form><?php } ?>


<?php

?>