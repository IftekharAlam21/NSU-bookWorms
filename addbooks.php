<?php
SESSION_START();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Books| BOOKWORMS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

<div class="book-adding">
      <?php
        if(isset($_POST['addbooks'])){

          require_once('config.php');

         $title = $_POST['title'];
          $author = $_POST['author'];
           $type = $_POST['type'];
            $edition = $_POST['edition'];
             $genre = $_POST['genre'];
              $price = $_POST['price'];
               $comments = $_POST['comments'];
                $owner = $_SESSION['user'];

  //FOR IMAGE
        $file = $_FILES['file'];
          $fileName = $_FILES['file']['name'];
            $fileTempName = $_FILES['file']['tmp_name'];
              $fileSize = $_FILES['file']['size'];
                $fileError = $_FILES['file']['error'];
                  $fileType = $_FILES['file']['type'];
                    $fileExt = explode('.',$fileName);
                      $fileActualExt = mb_strtolower(end($fileExt));
                        $allowed = array('jpg','jpeg','png');

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
         $sql = "INSERT INTO books (title,author,type,edition,genre,price,comments,owner) VALUES(?,?,?,?,?,?,?,?)";
          $stmtinsert = $db->prepare($sql);
          $res = $stmtinsert->execute([$title,$author,$type,$edition,$genre,$price,$comments,$owner]);

          $theID = $db->lastInsertId();

          $fileNameNew =  $theID.".".$fileActualExt;
          $fileDestination = 'uploads/'.$fileNameNew;
          move_uploaded_file($fileTempName,$fileDestination);


          $sql2 = "UPDATE books SET dp='$theID.$fileActualExt' WHERE bid='$theID'";

          $stmt = $db->prepare($sql2);
          $res2 = $stmt->execute();

          if ($res2){
          echo "<script>
            var r = confirm('Awesome! Thanks for adding you book');
            if(r == true){
              window.location.href='index.php';
            }
            </script>";
          }
            else {
          echo "Fail";
            }
        }
        else {
          echo "Something wrong with pic upload!";
        }
      }
        else {
          echo "Only jpeg,jpg ,png allowed";
        }

        }
    ?>
</div>

    <div class="addbook_des">

     <form action="addbooks.php" method="post" enctype="multipart/form-data">
       <div class="addbook_container1">
          <h3 style="color:white">Hey <?php echo $_SESSION['name']; ?> !</h3>
          <h1><b><span class="blink">Add your book:</span></b></h1>

         <hr>
         <div class="info">

         <label for="title"><b>Title</b></label> <br>
         <input type="text" placeholder="" name="title" required> <br>

         <label for="author"><b>Author</b></label> <br>
         <input type="text" placeholder="" name="author" required> <br>

         <b>Type:</b> <br>
         <input type="radio" name="type"  value="academic" checked>Academic
         <input type="radio" name="type"  value="nonacademic">Non-academic

         <br><br> <label for="edition"><b>Edition</b></label> <br>
         <input type="text" placeholder="(not mandatory)" name="edition" > <br>

         <label for="genre"><b>Genre</b></label> <br>
         <input type="text" placeholder="Fantacy , Thriller etc" name="genre" required> <br>

         <label for="price"><b>Pricing</b></label> <br>
         <input type="text" placeholder="Example: 100tk / weekly 20tk(if you wanna lend / free)" name="price" required> <br>

         <label for="comments"><b>Comments</b></label> <br>
         <textarea id="comments" name="comments" placeholder="Write something.." style="height:200px"></textarea>

         <div class="uploader">
           <p>Please Enter a photo of the book</p>
           <input type="file" name="file" value="">
         </div>
        <br>


        </div>

         <hr>
         <div class="clearfix">
           <?php
           if ( $_SESSION['id']==1) {
            echo ' <button type="button" class="cancel"> <a href="admin_contents.php" >Cancel</a> </button>';
              }
            else {
            echo '  <button type="button" class="cancel"> <a href="index.php" >Cancel</a> </button>';
            }

            ?>
            <button type="submit" class="addbooks" name="addbooks" value="addbooks">Add</button>
         </div>

       </div>
     </form>
    </div>

  </body>
</html>
