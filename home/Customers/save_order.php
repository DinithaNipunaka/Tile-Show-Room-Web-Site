<?php
include("db_conection.php");

if (isset($_POST['order_save'])) {
    // Fetch input data
    $user_id = $_POST['user_id'];
    $order_name = $_POST['order_name'];
    $order_price = $_POST['order_price'];
    $order_quantity = $_POST['order_quantity'];

    // Calculate order total
    $order_total = $order_price * $order_quantity;
    $order_status = 'Pending';

    // Get current stock quantity for the item
    $stmt = $dbcon->prepare("SELECT qty FROM items WHERE item_name = ?");
    $stmt->bind_param("s", $order_name);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($item_qty);
    $stmt->fetch();
    $stmt->close();

    // Check if the requested quantity is available
    if ($order_quantity > $item_qty) {
        echo "<script>alert('Insufficient stock available for this item.');</script>";
        echo "<script>window.open('shop.php?id=1','_self')</script>";
        exit();
    } else if ($order_quantity <= 0) {
        echo "<script>alert('Quantity must be greater than zero.');</script>";
        echo "<script>window.open('shop.php?id=1','_self')</script>";
        exit();
    }

    // Insert order details into orderdetails table
    $save_order_details = $dbcon->prepare("INSERT INTO orderdetails (user_id, order_name, order_price, order_quantity, order_total, order_status, order_date) VALUES (?, ?, ?, ?, ?, ?, CURDATE())");
    $save_order_details->bind_param("isdiis", $user_id, $order_name, $order_price, $order_quantity, $order_total, $order_status);
    $save_order_details->execute();

    // Update item stock in the items table
    $new_qty = $item_qty - $order_quantity;
    $update_item_stock = $dbcon->prepare("UPDATE items SET qty = ? WHERE item_name = ?");
    $update_item_stock->bind_param("is", $new_qty, $order_name);
    $update_item_stock->execute();

    // Success message
    echo "<script>alert('Item successfully added to cart!');</script>";
    echo "<script>window.open('shop.php?id=1','_self')</script>";
}
?>
