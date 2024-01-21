<?php
include "database.php";

session_start();

if($_POST){
$number = $_POST['number'];
$next_question =$number+1;

$userID = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;  
$_SESSION['user_id'] = $userID;

$selectSQL = "SELECT * FROM question";
$selectResult = mysqli_query($conn,$selectSQL);
$total_question = mysqli_num_rows($selectResult);

$selectedoption = isset($_POST['selected_option']) ? $_POST['selected_option'] : null;
$_SESSION['selected_options'][$number] = $selectedoption;

$questionID = isset($_POST['question_id']) ? $_POST['question_id'] : null;
$_SESSION['question_id'][$number] = $questionID;

$insertSQL = "INSERT INTO quiz_record (`question_id`,`user_id`,`selected_answer`) VALUES ('$questionID', '$userID', '$selectedoption')";
$insertResult = mysqli_query($conn, $insertSQL);

if($number == $total_question) {
    header("Location:final.php");
} else {
    header("Location:quiz.php?n=$next_question&user_id=$userID");
}
}
?>

