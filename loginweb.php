<?php
if ($_SERVER['REQUEST_METHOD']=='POST')
{
 if ( isset( $_GET['submit-btn'] ) )
 {

  $Email = $_GET['Email'];
  $Pass = $_GET['Pass'];

  require_once 'connection.php';
  $sql = "SELECT * FROM clts Where Email='$Email'";

  $response = mysqli_query($conn, $sql);

  $result = array();
  $result['login']= array();

if(mysqli_num_rows($response) === true )
{

  $row = mysqli_fetch_assoc($response);
  if(Pass_verify($Pass, $row['Pass']))
  {

    $index['Email'] = $row['Email'];
    array_push($result['login'], $index);

    $result['success'] = "1";
    $result['message'] = "success";
    echo "string";
    echo json_encode($result);
    mysqli_close($conn);
  }
  else
  {
    $result['success'] = "0";
    $result['message'] = "error";
    echo "tring";
    echo json_encode($result);
    mysqli_close($conn);
  }
}
}
}
?>
