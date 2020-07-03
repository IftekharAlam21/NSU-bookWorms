<?php
require_once "config.php";
session_start();

if ( isset($_POST['confirm']) && isset($_POST['bid']) ) {
    $sql = "DELETE FROM books WHERE bid = :bid";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(':bid' => $_POST['bid']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: admin_books.php' ) ;
    return;
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['bid']) ) {
  $_SESSION['error'] = "Missing user_id";
  header('Location: admin_books.php');
  return;
}

$stmt = $db->prepare("SELECT title,bid from books where bid = :xyz");
$stmt->execute(array(":xyz" => $_GET['bid']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for user_id';
    header( 'Location: admin_books.php' ) ;
    return;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Delete Books</title>
    <link rel="stylesheet" type="text/css" href="adminstyle.css">
  </head>
  <body>
    <div class="dia">
    <p>Confirm: Deleting the book- <b>"<?= htmlentities($row['title']) ?>" </b></p>
    <form method="post">
    <input type="hidden" name="bid" value="<?= $row['bid'] ?>">
    <input type="submit" value="confirm" name="confirm">
    <a href="admin_books.php">Cancel</a>
    </form>
  </div>

  </body>
</html>
