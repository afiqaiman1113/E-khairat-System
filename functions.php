
<?php

function redirect($location)
{
    return header("Location:" . $location);
    exit;
}

function ifItIsMethod($method = null)
{
    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
        return true;
    }
    return false;
}

//ni method pdo

// function email_exists($email) {
//     global $pdo;

//     $query_email = $pdo->prepare("SELECT user_email FROM ahli_kariah WHERE user_email = '$email' ");
//     $query_email->bindParam(':kariah_ic', $kariah_ic);
// 	$query_email->execute();
//     $result = $query_email->fetch();

//     if($result > 0) {
//         return true;
//     } else {
//         return false;
//     }
// }

//method biasa
function email_exists($email)
{
    global $conn;

    $query = "SELECT user_email FROM ahli_kariah WHERE user_email = '$email' ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function email_penama($email)
{
    global $conn;

    $query = "SELECT penama_email FROM penama WHERE penama_email = '$email' ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function ic_exists($ic_no)
{
    global $conn;

    $query = "SELECT kariah_ic FROM ahli_kariah WHERE kariah_ic = '$ic_no' ";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}
