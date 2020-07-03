<?php
 session_start();
if ( !isset($_SESSION['user']) ) {
  die('Access Denied');
}
if ( isset($_POST['cancel']) ) {
  header("Location: profile.php");
  return;
}

require_once "config.php";
if ( isset($_POST['title'])  && isset($_POST['author']) && isset($_POST['type']) && isset($_POST['edition'])
  && isset($_POST['genre']) && isset($_POST['price'])  && isset($_POST['comments'])) {

    $sql = "UPDATE books SET title = :title,
            author = :author, type = :type, edition = :edition, genre = :genre,
            status = :status, price = :price, comments = :comments, owner = :owner,
            lend = :lend
            WHERE bid = :bid";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
        ':title' => $_POST['title'],
        ':author' => $_POST['author'],
        ':type' => $_POST['type'],
        ':edition' => $_POST['edition'],
        ':genre' => $_POST['genre'],
        ':status' => $_POST['status'],
        ':price' => $_POST['price'],
        ':comments' => $_POST['comments'],
        ':owner' => $_POST['owner'],
        ':lend' => $_POST['lend'],
        ':bid' => $_POST['bid']));
        echo "<script>
          var r = confirm('Successfully Edited');
          if(r == true){
            window.location.href='profile.php';
          }
          </script>";
    return;
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['bid']) ) {
  $_SESSION['error'] = "Missing Bood_ID";
  header('Location: admin_books.php');
  return;
}

$stmt = $db->prepare("SELECT * FROM books where bid = :xyz");
$stmt->execute(array(":xyz" => $_GET['bid']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for user_id';
    header( 'Location: admin_contents.php' ) ;
    return;
}


$ti = htmlentities($row['title']);
$au = htmlentities($row['author']);
$ty = htmlentities($row['type']);
$ed = htmlentities($row['edition']);
$ge = htmlentities($row['genre']);
$st = htmlentities($row['status']);
$pr = htmlentities($row['price']);
$co = htmlentities($row['comments']);
$ow = htmlentities($row['owner']);
$le = htmlentities($row['lend']);
$bid = $row['bid'];
?>



<!DOCTYPE html>
<html>
  <head>
    <title>Edit Books</title>
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
        <label for="title"><b>Title</b></label> <br>
        <input type="text"  name="title"  value="<?=$ti?>"> <br><br>

        <label for="author"><b>Author</b></label> <br>
        <input type="text"  name="author"  value="<?=$au?>"> <br><br>

        <b>Type:</b> <br>
        <input type="radio" name="type"  value="academic" checked>Academic
        <input type="radio" name="type"  value="nonacademic">Non-academic

        <br><br> <label for="edition"><b>Edition</b></label> <br>
        <input type="text" name="edition"  value="<?=$ed?>"> <br><br>

        <label for="genre"><b>Genre</b></label> <br>
        <input type="text" name="genre"  value="<?=$ge?>"> <br><br>

        <label for="price"><b>Pricing</b></label> <br>
        <input type="text" name="price"  value="<?=$pr?>"> <br><br>

        <label for="price"><b>Status</b></label> <br>
        <input type="text" name="status"  value="<?=$st?>"> <br><br>

        <label for="price"><b>Owner</b></label> <br>
        <input type="text" name="owner"  value="<?=$ow?>"> <br><br>

        <label for="price"><b>Lend</b></label> <br>
        <input type="text" name="lend"  value="<?=$le?>"> <br><br>

        <label for="comments"><b>Comments</b></label> <br>
        <textarea id="comments" name="comments" value="<?=$co?>"> </textarea>

        <input type="hidden" name="bid" value="<?=$bid?>">
        <p><input type="submit" value="Save">
        <input type="submit" name="cancel" value="Cancel">
    </form>
  </div>
</div>

    </body>
    </html>
