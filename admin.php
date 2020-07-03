<?php
  SESSION_START();

if ($_SESSION['id']==1) {
  header ('Location:admin_contents.php');
}
else {
  echo "Nice Try Hacker! ";
}
 ?>
