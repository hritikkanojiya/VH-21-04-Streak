<?php
require_once '../db_con.php';
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pass = $_POST['pass'];
$monthly_income = $_POST['monthly_income'];
$currency = $_POST['currency'];
$delete = 1;

$stmt = $conn->prepare("INSERT INTO `masters_users` (`Email_Id`, `Password`,`Is_Delete`) VALUES (?,?,?)");
$stmt->bind_param("ssd", $email, $pass, $delete);
if ($stmt->execute()) {
    $User_Id = mysqli_insert_id($conn);
    $stmt = $conn->prepare("INSERT INTO `masters_profile` (`Users_Id`, `User_Name`, `Monthly_Inc`, `Currency`, `Contact_Number`, `Is_Delete`) VALUES ('?', '?', '?', '?', '?', '?')");
    $stmt->bind_param("dsdsii", $User_Id, $name, $monthly_income, $currency, $phone, $delete);
    if ($stmt->execute()) {
        $status = 200;
    } else {
        $status = 400;
    }
} else {
    $status = 401;
}
echo $status;
