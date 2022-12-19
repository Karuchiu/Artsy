<?php
include('functions/userfunctions.php');
include('includes/header.php');

if (isset($_GET['product'])) {
    $product_slug = $_GET['product'];
    $product_data = getSlugActive("products", $product_slug);
    $product = mysqli_fetch_array($product_data);

    if ($product) {
?>
        <div class="py-3 bg-primary">
            <div class="container">
                <h6 class="text-white">
                    <a class="text-white" href="categories.php">
                        Home /
                    </a>
                    <a class="text-white" href="categories.php">
                        Collections/
                    </a>
                    <?= $product['name']; ?>
                </h6>
            </div>
        </div>
        <div class="bg-light py-4">
            <div class="container product_data mt-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="shadow">
                            <img src="uploads/<?= $product['image']; ?>" alt="Product image" class="w-100">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4 class="fw-bold"><?= $product['name']; ?></h4>
                        <hr>
                        <p><?= $product['description']; ?></p>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Kshs. <span class="text-success fw-bold"> <?= $product['price']; ?></span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3" style="width: 100px">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" class="form-control text-center input-qty bg-white" value="1" disabled>
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <button class="btn btn-primary px-4 addToCartBtn" value="<?= $product['id']; ?>"> <i class="fa fa-shopping-cart me-2"></i>Add to Cart</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger px-4"> <i class="fa fa-heart me-2"></i>Add to Wishlist</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


<?php
    } else {
        "Product not found";
    }
} else {
    echo "Something went wrong";
}
include('includes/footer.php'); ?>