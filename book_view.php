<?php
SESSION_START();

include('dbhinc.php');

$selectedId = mysqli_real_escape_string($conn, $_GET['product']);

$sql = "SELECT * FROM books WHERE bid = '$selectedId'";
$result = mysqli_query($conn,$sql);


if($result){
  while ($row = mysqli_fetch_assoc($result)){
    $title =$row['title'];
    $author =$row['author'];
    $type = $row['type'];
    $edition =$row['edition'];
    $status = $row['status'];
    $price = $row['price'];
    $comments =$row['comments'];
    $owner = $row['owner'];
    $lend =$row['lend'];
    $dp = $row['dp'];
  }

}

else {
  echo "not connected";
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Book</title>
    <link rel="stylesheet" type="text/css" href="style4.css">
  </head>

  <body>

    <div class="container_view">
    <h1> <?php
      if (isset($_SESSION['user'])){
        echo "Hey ".$_SESSION['name']."!";
        }
     else{
       echo 'Hello there!';
        }
     ?> </h1>

      <div class="pic">
       <?php echo "<img src='uploads/".$dp."'/>"; ?>
      </div>

      <div class="details">
        <p> <b>Book Name: </b><?php echo $title ?></p>
        <p> <b>Author:</b> <?php echo $author ?> </p>
        <p><b>Type:</b> <?php echo $type ?> </p>
        <p><b>Cost:</b> <?php echo $price ?> </p>
        <p><b>Edition:</b> <?php echo $edition ?> </p>
        <p><b>Availiblity:</b> <?php echo $status ?> </p>
        <p><b>Comments of the owner:</b> <?php echo $comments ?> </p>
        <p><b>Contact owner:</b> </p>
        <p>  <?php
         if (isset($_SESSION['user'])){
           echo $owner;}
        else {echo '<a href="login.php">(Login to view)</a> ';}
        ?>  </p>
      </div>

    </div>



  </body>
</html>
