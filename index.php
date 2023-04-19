<?php

use App\Database\Models\Product;

require_once "vendor/autoload.php";


$product = new Product;

if($_SERVER['REQUEST_METHOD'] == "POST"){

    // loop on ids to do mass delete
    if(isset($_POST['ids'])){
        foreach($_POST['ids'] as $id){
            $product->setId($id)->delete();
        }
    }
}

// get products data
$productsData = $product->getData();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/master.css">
    <title>STORE</title>
</head>
<body>
    <!-- start header  -->
    <div class="header">
        <div class="container">
            <button id="add">ADD</button>
            <button id="delete-product-btn">MASS DELETE</button>
        </div>
    </div>
    <!-- end header  -->
    <!-- start product list  -->
    <div class="product-list">
        <div class="container">
            <form action="" method="POST" id="delete_form">
                <!-- loop on all products -->
                <?php foreach($productsData as $product): ?>
                    <div class="product-item">
                        <input type="checkbox" class="delete-checkbox" name="ids[]" value="<?= $product['id'] ?>">
                        <p class="sku"><?= $product["sku"] ?></p>
                        <p class="name"><?= $product['name'] ?></p>
                        <p class="price"><?= $product['price'] . " $" ?></p>
                        <p class="details"><?= $product['details'] ?></p>
                    </div>
                <?php endforeach; ?>
            </form>
        </div>
    </div>
    <!-- end product list  -->
    <script src="assets/js/main.js"></script>
</body>
</html>