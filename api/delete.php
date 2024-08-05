<?php
    include_once '../inc/config.php';
    include_once "../inc/drc.php";

    if(isset($_GET['productid'])){
        $delete_id = mysqli_real_escape_string($conn, $_GET['productid']);
        $sql = mysqli_query($conn, "DELETE FROM products WHERE productid = '{$delete_id}'");
        if($sql){
            $selectprod_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '{$delete_id}'");
            while ($pimgrowdelete = mysqli_fetch_assoc($selectprod_img)) {        
                $img1 = '../'.$pimgrowdelete['image_path'];
                unlink("$img1");
                $sql = mysqli_query($conn, "DELETE FROM product_images WHERE product_id = '{$delete_id}'");
            }
            header("Location: ". PRODUCTS."?status=productDeleted");
        }
    }else{
        header("Location: ". PRODUCTS."?status=noproductID");
    }
