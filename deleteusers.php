<?php
require_once "config.php";
session_start();

if ( isset($_POST['confirm']) && isset($_POST['id']) ) {
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':id' => $_POST['id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: admin_users.php' ) ;
    return;
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['id']) ) {
  $_SESSION['error'] = "Missing user_id";
  header('Location: admin_users.php');
  return;
}

$stmt = $db->prepare("SELECT name,id from users where id = :xyz");
$stmt->execute(array(":xyz" => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for user_id';
    header( 'Location: admin_users.php' ) ;
    return;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Delete User</title>
    <link rel="stylesheet" type="text/css" href="adminstyle.css">
  </head>
  <body>
    <div class="dia">
    <p>Confirm: Deleting <b> <?= htmlentities($row['name']) ?> </b></p>
    <form method="post">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <input type="submit" value="confirm" name="confirm">
    <a href="admin_users.php">Cancel</a>
    </form>
  </div>

  </body>
</html>
