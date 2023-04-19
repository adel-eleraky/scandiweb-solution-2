<?php

use App\Database\Models\Product;
use App\Http\Request\Validation;

require_once "../vendor/autoload.php";


// get products data
$product = new Product;
$productsData = $product->getData();


$validation = new Validation;
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // server side validation
    $validation->setInputName("sku")->setInput($_POST['sku'] ?? "")->required()->unique("products" , "sku");
    $validation->setInputName("name")->setInput($_POST['name'] ?? "")->required();
    $validation->setInputName("price")->setInput($_POST['price'] ?? "")->required()->numeric();
    $validation->setInputName("type")->setInput($_POST['type'] ?? "")->required();
    if(isset($_POST['weight'])){
        $validation->setInputName("weight")->setInput($_POST['weight'] ?? "")->required()->numeric();
        $details = "Weight : {$_POST['weight']} KG";
    }elseif(isset($_POST['size'])){
        $validation->setInputName("size")->setInput($_POST['size'] ?? "")->required()->numeric();
        $details = "Size : {$_POST['size']} MB";
    }elseif(isset($_POST['height'])){
        $validation->setInputName("height")->setInput($_POST['height'] ?? "")->required()->numeric();
        $validation->setInputName("width")->setInput($_POST['width'] ?? "")->required()->numeric();
        $validation->setInputName("length")->setInput($_POST['length'] ?? "")->required()->numeric();
        $details = "Dimensions : {$_POST['height']}x{$_POST['width']}x{$_POST['length']} CM";
    }
    // check if there is no server validation error -> then insert into database
    if(empty($validation->getErrors())){
        // set all product specs
        $product->setSku($_POST['sku'] ?? "")->setName($_POST['name'] ?? "")->setPrice($_POST['price'] ?? "")->setCategory($_POST['type'] ?? "")->setDetails($details ?? "");
        // insert product in database
        if($product->insert()){
            header('location:../index.php'); // after successful insert -> redirect to product list page
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/master.css">
    <title>Add Product</title>
</head>
<body>
    <!-- start header  -->
    <div class="header">
        <div class="container">
            <button id="save">Save</button>
            <button id="cancel">Cancel</button>
        </div>
    </div>
    <!-- end header  -->
    <!-- start form  -->
    <div class="form">
        <div class="container">
            <form action="" method="POST" id="product_form">
                <div class="sku">
                    <label for="sku">Sku</label>
                    <input type="text" name="sku" id="sku" onblur="validateSku()">
                    <?= $validation->getErrorMessage("sku") ?? "" ?> <!-- display server side error for sku input -->
                </div>
                <div class="name">
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" onblur="validateName()">
                    <?= $validation->getErrorMessage("name") ?? "" ?> <!-- display server side error for name input -->
                </div>
                <div class="price">
                    <label for="price">price</label>
                    <input type="number" name="price" id="price" onblur="validatePrice()">
                    <?= $validation->getErrorMessage("price") ?? "" ?> <!-- display server side error for price input -->
                </div>
                <div class="type">
                    <label for="productType">Type Switcher</label>
                    <select name="type" id="productType" onblur="validateType()">
                        <option value="Book">Book</option>
                        <option value="Furniture">Furniture</option>
                        <option value="DVD">DVD</option>
                    </select>
                    <?= $validation->getErrorMessage("type") ?? "" ?> <!-- display server side error for type input -->
                </div>
            </form>
                <?=  $validation->getErrorMessage("weight") ?? "" ?></br> <!-- display server side error for weight input -->
                <?=  $validation->getErrorMessage("width") ?? "" ?></br> <!-- display server side error for width input -->
                <?=  $validation->getErrorMessage("length") ?? "" ?></br> <!-- display server side error for length input -->
                <?=  $validation->getErrorMessage("height") ?? "" ?></br> <!-- display server side error for height input -->
                <?=  $validation->getErrorMessage("size") ?? "" ?></br> <!-- display server side error for size input -->
        </div>
    </div>
    <!-- end form  -->
    <script>
        // get all sku values and pass it javascript to make validation 
        let allSku = [];
        <?php foreach($productsData as $product): ?>
            allSku.push("<?php echo $product['sku'] ?>")
        <?php endforeach; ?>
    </script>
    <script src="../assets/js/addProduct.js"></script>
</body>
</html>