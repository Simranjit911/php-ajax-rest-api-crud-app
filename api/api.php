<?php
include("config.php");
header("Content-Type:application/json");
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET["id"]);
            $sql = "SELECT * FROM student where sid={$id}";
            $res = $conn->query($sql);
            if (mysqli_num_rows($res) > 0) {
                $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
                echo json_encode($data);
            } else {
                echo json_encode(["msg" => "Data not Found"]);
            }
        } elseif (isset($_GET['s'])) {
            $srch = mysqli_real_escape_string($conn, $_GET['s']);
            $sql = "SELECT * FROM student WHERE sname LIKE '%$srch%' OR saddress LIKE '%$srch%'";
            $res = $conn->query($sql);
            if (mysqli_num_rows($res) > 0) {
                $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
                echo json_encode($data);
            } else {
                echo json_encode(["msg" => "Data not Found"]);
            }
        } else {
            $sql = "SELECT * FROM student";
            $res = mysqli_query($conn, $sql);
            if (mysqli_num_rows($res) > 0) {
                $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
                echo json_encode($data);
            }
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'];
        $number = $data['number'];
        $location = $data['location'];
        $sql = "INSERT INTO student (sname, sphone, saddress) VALUES ('$name', $number, '$location')";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["msg" => "Student Created!"]);
        } else {
            echo json_encode(['message' => 'Error: ' . $conn->error]);
        }
        break;
    case "PUT":
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $number = $data['number'];
        $location = $data['location'];
        $id = $data['update'];
        $sql = "UPDATE student SET sname='{$name}',sphone={$number},saddress='{$location}' where sid={$id}";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(["msg" => "Student Updated!"]);
        } else {
            echo json_encode(['message' => 'Error: ' . $conn->error]);
        }
        break;



    case "DELETE":
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "DELETE FROM student where sid={$id}";
            if (mysqli_query($conn, $sql)) {
                echo json_encode(["msg" => "Student Deleted!"]);
            } else {
                echo json_encode(['message' => 'Error: ' . $conn->error]);
            }
        } else {
            echo json_encode(['message' => 'Student not found!']);
        }
        break;
    default:
        echo json_encode(["msg" => "This method not allowed"]);
}
