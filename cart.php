<?php
include 'connect.php';
session_start();

$acctID = $_SESSION['acctID'];
$userID = $_SESSION['userID'];
if (!isset($userID)) {
    header('location: login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the AJAX request
    $requestData = json_decode(file_get_contents("php://input"), true);

    if (isset($_POST['deleteItem']) && $_POST['deleteItem'] === 'true') {
        // Delete the item from the database
        $cartID = mysqli_real_escape_string($connection, $_POST['cartID']);
        $delete_query = "DELETE FROM tblcart WHERE cartID = '$cartID'";
        $delete_result = mysqli_query($connection, $delete_query);

        if ($delete_result) {
            echo "Item deleted successfully";
        } else {
            echo "Error deleting item: " . mysqli_error($connection);
        }
    } else {
       // Update quantity and cost in the database (the cost/price remains the same to avoid doubling up when refreshing)."
        $cartID = mysqli_real_escape_string($connection, $requestData['cartID']);
        $newQuantity = mysqli_real_escape_string($connection, $requestData['newQuantity']);
        $cost = mysqli_real_escape_string($connection, $requestData['cost']);

        $update_query = "UPDATE tblcart SET quantity = '$newQuantity', cost = '$cost' WHERE cartID = '$cartID'";
        $result = mysqli_query($connection, $update_query);

        if ($result) {
            echo "Quantity and total cost updated successfully";
        } else {
            echo "Error updating quantity and total cost: " . mysqli_error($connection);
        }
    }
}
?>
