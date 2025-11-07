<?php
require "dbcon_open.php"; // contains $link

if (isset($_POST['ArtId'])) {
    $ArtId = trim($_POST['ArtId']);

    $stmt = $link->prepare("SELECT 1 FROM articles WHERE ArtId = ?");
    $stmt->bind_param("s", $ArtId);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo 'exists';
    } else {
        echo 'available';
    }

    $stmt->close();
    mysqli_close($link);
}
?>
