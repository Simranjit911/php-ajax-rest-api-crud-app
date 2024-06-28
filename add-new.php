<?php
include("config.php");

// Check if the delete ID is set and handle the delete operation
if (isset($_POST['delId'])) {
    $delId = $_POST['delId'];
    $sql = "DELETE FROM student WHERE sid={$delId}";
    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 0;
    }
    // Close the connection and exit the script after handling the delete operation
    mysqli_close($conn);
    exit();
}

// Check if the name, number, and location are set and handle the insert operation
if (isset($_POST['name']) && isset($_POST['number']) && isset($_POST['location']) && isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $updateId = mysqli_real_escape_string($conn, $_POST['update']);
    if ($updateId == "0") {

        $sql = "INSERT INTO student (sname, sphone, saddress) VALUES ('{$name}', '{$number}', '{$location}')";
        if (mysqli_query($conn, $sql)) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        $sql = "UPDATE student SET sname = '{$name}', sphone = '{$number}', saddress = '{$location}' WHERE sid = {$updateId}";
        if (mysqli_query($conn, $sql)) {
            echo 1;
        } else {
            echo 0;
        }
    }
}

// Close the database connection
mysqli_close($conn);
