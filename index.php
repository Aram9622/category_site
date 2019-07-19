<?php
require_once('inc/connect.php');
if (isset($_POST['cat'])) {
    $title = $_POST['title'];
    $descr = $_POST['descr'];
    if (!empty($title)) {
        $sql = $con->prepare("INSERT INTO `cats` (`title`, `descr`) VALUES ('$title', '$descr')");
        $sql->execute();
        if ($sql) {
            echo 'ok';
        }
    }
}

if (isset($_POST['prod'])) {
    $cat_id = $_POST['cat_id'];
    $title = $_POST['title'];
    $descr = $_POST['descr'];
    if (!empty($title)) {
        $sql_insert = $con->prepare("INSERT INTO `products` (`cat_id`, `title`, `descr`) VALUES (?, ? ,?)");
        $sql_insert->execute(array($cat_id, $title, $descr));
    }
}
$sql_select = $con->prepare("SELECT * FROM `cats`");
$sql_select->execute();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>


    <div class="row">
        <div class="col-md-3">
            <h1 style="color:green;">Category</h1>
            <form method="post">
                <input type="text" placeholder="Title" class="form-control" name="title">
                <textarea name="descr" cols="30" rows="10" class="form-control" placeholder="Description"></textarea>
                <button class="btn btn-info" type="submit" name="cat">Send</button>
            </form>
        </div>
        <div class="col-md-4">
            <h1 style="color:green;">Products</h1>
            <form class="form" method="post">
                <select name="cat_id" id="" class="browser-default custom-select">
                    <option value="0">None</option>
                    <?php while ($fetch = $sql_select->fetch()) { ?>
                    <option value="<?= $fetch['id'] ?>"><?= $fetch['title'] ?></option>
                    <?php } ?>
                </select>
                <input type="text" class="form-control" name="title" placeholder="Title">
                <textarea name="descr" cols="30" rows="8" class="form-control" placeholder="Description"></textarea>
                <button class="btn btn-info" type="submit" name="prod">Send</button>
            </form>
        </div>
        
        <div class="col-md-4">
            <h1 style="color:green;">BD</h1>
            <table width="500" border="1">
                <?php
    $sql_select_cat = $con->prepare("SELECT * FROM `cats`");
    $sql_select_cat->execute();
    while ($assoc = $sql_select_cat->fetch()) {
        $id = $assoc['id'];
        // category show
        $sql_select_prod = $con->prepare("SELECT * FROM `products` WHERE `cat_id`='$id'");
        $sql_select_prod->execute();
        $count = $sql_select_prod->rowCount();
        ?>
                <tr class="cat">
                    <th style="color: red;" class="count"><?=$assoc['title']?>(<span><?=$count?></span>)</th>
                </tr>
       <?php
        while($fetch_prod = $sql_select_prod->fetch()){
            $del_id = $fetch_prod['id'];
        
            // product show
            ?>
                <tr>
                    <td><?=$fetch_prod['title']?><button style="float:right;" class="btn btn-danger delete" data-id="<?=$del_id?>" data-cat-id="<?=$id?>">Delete</button></td>
                </tr>

                <?php } }?>
            </table>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
