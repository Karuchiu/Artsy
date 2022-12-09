<?php

include('../config/dbcon.php');
include('../functions/myfunctions.php');

if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1' : '0';

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $cate_query = "INSERT INTO category
    (name, slug, description, status, image)
    VALUES('$name', '$slug',  '$description', '$status', '$filename' )";

    $cate_query_run = mysqli_query($con, $cate_query);

    if ($cate_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect("add-category.php", "Category added successfully");
    } else {
        redirect("add-category.php", "Something went wrong");
    }
} else if (isset($_POST['update_category_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../uploads";

    $update_query = "UPDATE category SET name='$name', slug='$slug', description='$description', status='$status', image='$update_filename' WHERE id='$category_id'";

    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-category.php?id=$category_id", "Category Updated");
    } else {
        redirect("edit-category.php?id=$category_id", "Not Updated");
    }
} else if (isset($_POST['delete_category_btn'])) {
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    $category_query = "SELECT * FROM category WHERE id='$category_id' ";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM category WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        redirect("category.php", "Category deleted");
    } else {
        redirect("category.php", "Category NOT deleted");
    }
} else if (isset($_POST['add_product_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $status = isset($_POST['status']) ? '1' : '0';

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    if ($name != "") {
        $product_query = "INSERT INTO products
        (category_id, name, slug, description, price, qty, status, image)
        VALUES('$category_id', '$name', '$slug', '$description', '$price', '$qty', '$status', '$filename' )";

        $product_query_run = mysqli_query($con, $product_query);

        if ($product_query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
            redirect("add-product.php", "Product added");
        } else {
            redirect("add-product.php", "Something went wrong");
        }
    }
    else {
        redirect("add-product.php", "All fields are mandatory");
    }

} else if (isset($_POST['update_product_btn'])){
    $product_id = $_POST['product_id'];

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $status = isset($_POST['status']) ? '1' : '0';

    $path = "../uploads";

   
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE products SET name='$name', slug='$slug', description='$description', price = '$price', qty = '$qty', status='$status', image='$update_filename' WHERE id='$product_id'";

    $update_product_query_run = mysqli_query($con, $update_product_query);

    if ($update_product_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-product.php?id=$product_id", "Product Updated");
    } else {
        redirect("edit-product.php?id=$product_id", "Not Updated");
    }
} else if (isset($_POST['delete_product_btn'])){
    
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id' ";
    $product_query_run = mysqli_query($con, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id='$product_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        //redirect("products.php", "Product deleted");
        echo 200;
    } else {
        //redirect("products.php", "Product NOT deleted");
        echo 500;
    }
}
else {
    header('Location: ../index.php');
}

?>