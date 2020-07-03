<?php
 session_start();
if ( ! isset($_SESSION['user']) ) {
  die('Access Denied');
}
if ( isset($_POST['cancel']) ) {
  header("Location: admin_users.php");
  return;
}

require_once "config.php";
$count = 0;
if ( isset($_POST['name'])  && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['nsu_id']) && isset($_POST['address']) && isset($_POST['c_number']) ) {

  if( is_numeric($_POST['nsu_id'])) {
   $count++;
  }
  else{
     $_SESSION['error'] = "NSU ID must be an integer";
     header("Location: edituser.php");
     return;
  }
   if (is_numeric($_POST['c_number']) ) {
    $count++;
  }
  else {
    $_SESSION['error'] = "COntact Number must be an integer";
    header("Location: edituser.php");
    return;
  }


  if ($count==2)  {
    $sql = "UPDATE users SET name = :name,
            email = :email, password = :password, nsu_id = :nsu_id, address = :address,
            c_number = :c_number,gender = :gender
            WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':nsu_id' => $_POST['nsu_id'],
        ':address' => $_POST['address'],
        ':c_number' => $_POST['c_number'],
        ':gender' => $_POST['gender'],
        ':id' => $_POST['id']));

        echo "<script>
          var r = confirm('Successfully Edited');
          if(r == true){
            window.location.href='admin_users.php';
          }
          </script>";
    return;
}
}
// Guardian: Make sure that user_id is present
if ( ! isset($_GET['id']) ) {
  $_SESSION['error'] = "Missing user_id";
  header('Location: admin_users.php');
  return;
}

$stmt = $db->prepare("SELECT * FROM users where id = :xyz");
$stmt->execute(array(":xyz" => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for user_id';
    header( 'Location: admin_contents.php' ) ;
    return;
}

 $n = htmlentities($row['name']);
 $e = htmlentities($row['email']);
 $p = htmlentities($row['password']);
 $i = htmlentities($row['nsu_id']);
 $a = htmlentities($row['address']);
 $c = htmlentities($row['c_number']);
 $g = htmlentities($row['gender']);
 $uid = $row['id'];
?>



<!DOCTYPE html>
<html>
  <head>
    <title>User</title>
    <link rel="stylesheet" type="text/css" href="adminstyle.css">
  </head>
  <body>
    <div class="main">
    <h1>Editing User</h1>
    <?php
    if ( isset($_SESSION['error']) ) {
        echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
        unset($_SESSION['error']);
    } ?>
    <div class="dia">

    <form method="post">
        <p>Name:
        <input type="text"  name="name" value="<?=$n?>" ></p>
        <p>Email:
        <input type="email"  name="email" value=" <?=$e?>" ></p>
        <p>Password:
        <input type="text" name="password" value="<?=$p?>" ></p>
        <p>ID:
        <input type="text" name="nsu_id" value="<?=$i?>" ></p>
        <p>Address:
        <input type="text"  name="address" value=" <?=$a?>" ></p>
        <p>Contact Number:
        <input type="text"  name="c_number" value=" <?=$c?>" ></p>
        <b>Gender:</b> <br>
        <input type="radio" name="gender" value="female" required>Female
        <input type="radio" name="gender" value="male" required>Male
        <input type="hidden" name="id" value="<?= $uid ?>">
  <p><input type="submit" value="Save">
  <input type="submit" name="cancel" value="Cancel">
    </form>
  </div>

    </div>
    </body>
    </html>
