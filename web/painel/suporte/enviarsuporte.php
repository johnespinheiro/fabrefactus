<?php  
include '../conexao.php';

$receiverid = mysqli_real_escape_string($conn, $_POST['selcli']);
$subject = mysqli_real_escape_string($conn, $_POST['subject']);
$senderid = mysqli_real_escape_string($conn, $_POST['senderid']);
$message = mysqli_real_escape_string($conn, $_POST['suportemessage']);
$sendertype = mysqli_real_escape_string($conn, $_POST['sendertype']);
$receivertype = mysqli_real_escape_string($conn, $_POST['receivertype']);

$sql = "INSERT INTO messages (senderid,receiverid,sendertype,receivertype,subject,message,boxid) VALUES ('$senderid', '$receiverid','$sendertype','$receivertype','$subject','$message','2')";
$executasql = mysqli_query($conn, $sql);

$conn->close();
?>