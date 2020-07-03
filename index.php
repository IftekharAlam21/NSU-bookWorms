<?php
  SESSION_START();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>NSU Book Worms</title>
    <meta name= viewport content= "width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style3.css">
    <link href="https://fonts.googleapis.com/css?family=Flamenco&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body>
    <header>
      <nav>
        <div class="row clearfix" >
          <img src="img/logo.png" alt="logo" class="logo">
          <ul class="main-nav">
            <li><a href="#">Home</a></li>
            <?php
            if (isset($_SESSION['user'])){
            echo '<li><a href="profile.php">Profile</a></li>';
            echo '<li><a href="logout.php">Logout</a></li>'; }
            else {
              echo '<li><a href="contact.php">Contact Us</a></li>';
              echo '<li><a href="login.php">Sign in/Up</a></li>';}
            ?>
            <?php
            if ((isset($_SESSION['user'])) && ($_SESSION['name']=='Boss')){
              echo '<li><a href="admin.php">Admin</a></li>';
            }
             ?>
          </ul>

        </div>
      </nav>


      <div class="main-head">
        <h1> <b>Welcome<span class="blink">
        <?php
         if (isset($_SESSION['user'])){
           echo $_SESSION['name'];}
        else {echo 'booklovers!';}
        ?>
      </b> </h1>
        <a href="#" class="btn">Lets GO!!</a>
      </div>


      <form class="search" action="" method="get">
        <div class="bk">
         <input type="text" onKeyUp="fx(this.value)" autocomplete="off" name="qu" id="qu" placeholder="Type.." name="searchBar">
         <button type="submit" name="go"  value="">Search</button>
          <div id="livesearch"></div>
        </div>
      </form>


    </header>

    <footer>
      <ul class="foot">
        <li><a class="foot_li" href="http://www.northsouth.edu/" target="_blank"> North South University</a></li>
        <li><a class="foot_li" href="about.html"> About </a></li>
        <li> ©2019-2020</li>
      </ul>

    </footer>

  <script>
    function fx(str)
    {
    var s1=document.getElementById("qu").value;
    var xmlhttp;
    if (str.length==0) {
    		    document.getElementById("livesearch").innerHTML="";
    		    document.getElementById("livesearch").style.border="0px";
    				document.getElementById("livesearch").style.display="block";
    				$('#textbox-clr').text("");
    		    return;
    			}

    	 xmlhttp=new XMLHttpRequest(); //this is mine


    	xmlhttp.onreadystatechange=function()
    	{
    	 if (xmlhttp.readyState==4 && xmlhttp.status==200) //state 4: request finished and response is ready and status	200: "OK"
    		 {
    			  document.getElementById("livesearch").innerHTML=xmlhttp.responseText;

    		 }
    	}
    			xmlhttp.open("GET","call_ajax.php?n="+s1,true);
    			xmlhttp.send();
    }
    </script>


  </body>
</html>
