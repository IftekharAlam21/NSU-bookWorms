<?php
SESSION_START();

include('dbhinc.php');
$s1=$_REQUEST["n"];
$select_query="SELECT * FROM books WHERE title LIKE '%".$s1."%' OR author LIKE '%".$s1."%' " ;
$sql= mysqli_query($conn, $select_query);
$res = mysqli_num_rows($sql);
$msg = "Sorry! No books found";
//$s="";

if ($res > 0) {

	while($row = mysqli_fetch_assoc($sql))
	{
		echo "
		<a class='link-p-colr' href='book_view.php?product=".$row['bid']."'>
			<div class='live-outer'>
			<div class='live-im'>
					<img src='uploads/".$row['dp']."'/>
			</div>
	       <div class='livedet'>
	          <div class='livename'>
	          	<p>".$row['title']."</p>
	          </div>
							<div class='liveauthor'><p>".$row['author']."</p></div>
				      <div class='liveprice'><p>".$row['price']."</p></div>
          </div>
	     </div>
		</a>
		";
	}

}

else {
echo "<div class='live-outer'>
	 $msg
	</div>";

}

?>
