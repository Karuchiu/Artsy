<?php

include('../middleware/adminMiddleware.php');
include('includes/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="mb-0">Select Category</label>
                                <select name="category_id" class="form-select mb-2">
                                    <option selected>Select Category</option>
                                    <?php
                                    $categories = getAll("category");
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $item) {
                                    ?>
                                            <option value="<?= $item['id']; ?>"><?= $item['name']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo "No category available";
                                    }

                                    ?>


                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Name</label>
                                <input type="text" name="name" placeholder="Enter Category Name" class="form-control mb-2 ">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Description</label>
                                <textarea rows="3" name="description" placeholder="Enter Description" class="form-control mb-2 "></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Price</label>
                                <input type="text" name="price" placeholder="Enter Price" class="form-control mb-2 ">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Upload Image</label>
                                <input type="file" name="image" class="form-control mb-2 ">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-0">Quantity</label>
                                <input type="number" name="qty" placeholder="Enter Quantity" class="form-control mb-2 ">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Status</label>
                                <input type="checkbox" name="status">
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary " name="add_product_btn">Save</button>
                            </div>
                        </div>

                </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>

<?php include('includes/footer.php'); ?>