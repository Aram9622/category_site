<?php
    require_once('inc/connect.php');

    if(isset($_POST['id'])) {
        $del_id = $_POST['id'];
        $cat_id = $_POST['cat_id'];
            $del = $con->prepare("DELETE FROM `products` WHERE `id`='$del_id'");
            $del->execute();
            if($del){
                $sql_select = $con->prepare("SELECT * FROM `products` WHERE `cat_id`='$cat_id'");
                $sql_select->execute();
                echo $sql_select->rowCount();
            }
        }

?>