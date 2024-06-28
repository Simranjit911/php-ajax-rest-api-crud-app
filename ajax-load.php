<?php
include("config.php");
$sql = "SELECT * FROM student";
$res = mysqli_query($conn, $sql) or die("Error in query");
$data = [];
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(['message' => 'No records found']);
}
