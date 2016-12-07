<?php
   header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
   header("Cache-Control: post-check=0, pre-check=0", false);
   header("Pragma: no-cache");
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="Art website by Shek!">
      <meta name="author" content="shek">
      <title>Art Mart</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="mycss.css">
      <link href="https://fonts.googleapis.com/css?family=Lobster+Two|Pacifico|Satisfy" rel="stylesheet">
   </head>
   <body>
      <div class="container">
         <nav class="navbar navbar-default navibar">
            <div class="container-fluid">
               <!-- Brand and toggle get grouped for better mobile display -->
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/shek/default.php">Art Mart</a>
               </div>
               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                     <li><a href="/shek/default.php">Home<span class="sr-only">(current)</span></a></li>
                     <li><a href="/shek/about.php">About us</a></li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="/shek/Part01_ArtistsDataList.php">Artists Data List (Part 1)</a></li>
                           <li><a href="/shek/Part02_SingleArtist.php?id=19">Single Artist (Part 2)</a></li>
                           <li><a href="/shek/Part03_SingleWork.php?id=394">Single Work (Part 3)</a></li>
                           <li><a href="/shek/Part04_Search.php">Search (Part 4)</a></li>
                        </ul>
                     </li>
                  </ul>
                  <form action="/shek/Part04_Search.php" class="navbar-form search-navbar">
                     <div class="form-group">
                        <label class="shek">Shek!</label><input type="text" class="form-control" name="query" placeholder="Search paintings">
                     </div>
                     <button type="submit" class="btn btn-default">Search</button>
                  </form>
               </div>
               <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
         </nav>
         <div class= "single-artist">
            <?php 
               if (isset($_GET['id'])) {
                   $id = $_GET['id'];
               }else{
                   header("Location: http://localhost/shek/error.php");
               }
               
               $servername = "localhost";
               $username = "root";
               $password = "";
               $dbname = "shek";
               
               // Create connection
               $conn = new mysqli($servername, $username, $password, $dbname);
               // Check connection
               if ($conn->connect_error) {
                   die("Connection failed: " . $conn->connect_error);
               } 
               
               $sql = "SELECT ArtistID, ImageFileName, Description, Title, YearOfWork, Medium, Width, Height, ArtWorkType, OriginalHome, Cost FROM artworks where ArtWorkID =".$id;
               $result = $conn->query($sql);
               $row = $result->fetch_assoc();
               $image = $row["ImageFileName"];
               $artist_id = $row["ArtistID"];
               $title = $row["Title"];
               $year = $row["YearOfWork"];
               $home = $row["OriginalHome"];
               $cost = $row["Cost"];
               $medium = $row["Medium"];
               $w = $row["Width"];
               $h = $row["Height"];
               
               $sql2 = "SELECT FirstName, LastName FROM artists where ArtistID =".$artist_id;
               $result2 = $conn->query($sql2);
               $row2 = $result2->fetch_assoc();
               $name = $row2["FirstName"]. " " . $row2["LastName"];
               
               if ($result->num_rows > 0) {
                   // output data of each row
                       echo "<h1>" . $title . "</h1>";
                       echo "<h4>By <a href=\"/shek/Part02_SingleArtist?id=" . $artist_id. "\">".$name. " </a></h4>";
                       echo "<img src=\"./images/art/works/medium/" . $image . ".jpg\" data-toggle=\"modal\" data-target=\"#myModal\"/>";
                       echo "<div id=\"artist-deets\">";
                       echo "<p>" . $row["Description"] . "</p>";
                       echo "<h3>$" . $cost . "</h3>";
                       echo "<button class=\"btn btn-success\"><span class=\"glyphicon glyphicon-gift\"></span>Add to Wishlist</button>
                               <button class=\"btn btn-warning\"><span class=\"glyphicon glyphicon-shopping-cart\"></span>Add to Shopping Cart</button>";
               
                       echo "<table class=\"table sales-table\"><thead><tr><th>Sales details</th></tr></thead><tbody>";
               
               
               $sql5 = "SELECT o.DateCompleted as cdate FROM orders o, orderdetails od WHERE od.ArtWorkID = ".$id. " AND o.OrderID=od.OrderID";
                       $result5 = $conn->query($sql5);
                       
                       while($row5 = $result5->fetch_assoc()) {
                       $cdate = substr($row5["cdate"],0, 10);
                       echo "<tr><td><a href=\"#\">" . $cdate. "</a><td /><tr />";
                   }
               
                       echo "</tr></tbody></table>";
               
               
               
                       echo "<table class=\"table\"><thead><tr><th>Product details</th></tr></thead><tbody><tr><td>Date:</td>";
                       echo "<td>" . $year ."</td>";
                       echo "</tr><tr><td>Medium:</td>";
                       echo  "<td>" . $medium . "</td>";
                       echo "</tr><tr><td>Dimensions:</td>";
                       echo  "<td>" . $h . "cmX" .$w. "cm</td>";
                       echo "</tr><tr><td>Home:</td>";
                       echo  "<td>" . $home . "</td>";
                       echo "</tr><tr><td>Genres:</td><td>";
                       $sql3 = "SELECT g.GenreName as gname, g.Link as glink FROM genres g, artworkgenres ag WHERE ag.ArtWorkID = ".$id. " AND g.GenreID=ag.GenreID";
                       $result3 = $conn->query($sql3);
                       
                       while($row3 = $result3->fetch_assoc()) {
                       echo "<a href=\"" . $row3["glink"]. "\">" . $row3["gname"]. "</a><br />";
                   }       
                       echo  "</td>";              
                       echo "</tr><tr><td>Subjects:</td><td>";
                       $sql4 = "SELECT s.SubjectName as gname FROM subjects s, artworksubjects ts WHERE ts.ArtWorkID = ".$id. " AND s.SubjectID=ts.SubjectID";
                       $result4 = $conn->query($sql4);
                       
                       while($row4 = $result4->fetch_assoc()) {
                       echo "<a href=\"#\">" . $row4["gname"]. "</a><br />";
                   }             
                       echo  "</td>";              
                       echo   "</tr></tbody></table></div></div>";              
                   } 
               
               else {
                   header("Location: http://localhost/shek/error.php");
               }
               
               
               ?>
            <div class="modal fade" id="myModal" role="dialog">
               <div class="modal-dialog">
                  
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                     </div>
                     <div class="modal-body">
                        <?php echo "<img src=\"./images/art/works/medium/" .$image. ".jpg\" />" ?>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <footer class="footer" >
            <div class="container">
               <p class="text-muted">Made with <span class="glyphicon glyphicon-heart" style="color:red"></span> in Espoo, FI.</p>
            </div>
         </footer>
      </div>
      <script
         src="https://code.jquery.com/jquery-3.1.1.min.js"
         integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
         crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   </body>
</html>