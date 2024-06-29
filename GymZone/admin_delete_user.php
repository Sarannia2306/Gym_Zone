<?php

include 'db_connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM user_data WHERE id = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header('location: admin_user.php?user deleted');
} else {
    echo "Failed: " . mysqli_error($conn);
}
?>