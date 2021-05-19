<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once 'connect.php';

    $sql = "SELECT * FROM clts WHERE email='$email' ";

    $response = mysqli_query($conn, $sql);

    $result = array();
    $result['login'] = array();

    if ( mysqli_num_rows($response) === 1 ) {

        $row = mysqli_fetch_assoc($response);

        if ( password_verify($password, $row['password']) ) {

            $index['name'] = $row['name'];
            $index['email'] = $row['email'];
            $index['id'] = $row['id'];

            array_push($result['login'], $index);

            $result['Success'] = "1";
            $result['message'] = "Success";
            header('Content-Type: application/json');
            echo json_encode($result);

            mysqli_close($conn);

        } else {

            $result['Success'] = "0";
            $result['message'] = "error";
            header('Content-Type: application/json');
            echo json_encode($result);

            mysqli_close($conn);

        }

    }

}

?>
