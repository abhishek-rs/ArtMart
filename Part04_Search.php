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
               
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="/shek/default.php">Art Mart</a>
               </div>
               
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                     <li ><a href="/shek/default.php">Home<span class="sr-only">(current)</span></a></li>
                     <li><a href="/shek/about.php">About us</a></li>
                     <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="/shek/Part01_ArtistsDataList.php">Artists Data List (Part 1)</a></li>
                           <li><a href="/shek/Part02_SingleArtist.php?id=19">Single Artist (Part 2)</a></li>
                           <li><a href="/shek/Part03_SingleWork.php?id=394">Single Work (Part 3)</a></li>
                           <li class="active"><a href="/shek/Part04_Search.php">Search (Part 4)</a></li>
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
               
            </div>
            
         </nav>
         <div class="jumbotron">
            <form method="post" class="search" action="/shek/Part04_Search.php">
               <h3>Search Results</h3>
               <div class="form-group">
                  <input type="radio" name="filter" value="title" onClick="showtitle()" checked> Filter by Title<br>
                  <input type="text" name="query2" class="form-control" id="title-search" placeholder="Search paintings based on title">
                  <input type="radio" name="filter" value="desc" onClick="showdesc()"> Filter by Description<br>
                  <input type="text" name="query3" class="form-control" id="des-search" placeholder="Search paintings based on description">
                  <input type="radio" name="filter" value="nope" onClick="shownope()"> No filter<br>
                  <input type="text" name="query4" class="form-control" id="filterless-search" placeholder="Search paintings without filter">
               </div>
               <button type="submit" name="submit" class="btn btn-default">Filter</button>
            </form>
         </div>
         <?php 
            if (isset($_GET['query'])) {
            $query = $_GET['query'];
            searchTitle($query);
            }
            if(isset($_POST['submit']))
            {
              search();
            } 
            
            
            
            function search(){
                $filter=$_POST["filter"];
                
                if ($filter=="title") {
                  $query2=$_POST["query2"];  
                  searchTitle($query2);
                }
                elseif ($filter=="desc") {
                  $query2=$_POST["query3"];
                  searchDesc($query2);
                }
                else{
                  $query2=$_POST["query4"];
                  noFilter($query2);
                }
            }
            
            function searchTitle($q) {
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shek";
            
           
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            } 
            
              $sql = "SELECT ArtWorkID, ImageFileName, Description, Title FROM artworks where Title LIKE '%" .$q. "%'";
              $result = $conn->query($sql);
              
              
              echo"<div class=\"row\">
                    <div class=\"col-lg-12\">
                        <h2 class=\"page-header\">Searching for " .$q. " in titles</h2></div></div>";
            
                        while($row = $result->fetch_assoc()) {
              $image = $row["ImageFileName"];
              $artwork_id = $row["ArtWorkID"];
              $title = $row["Title"];
              $desc = $row["Description"];
            
            
              echo "<div class=\"row search-results\"><div class=\"col-lg-12\"><a href=\"/shek/Part03_SingleWork?id=" .$artwork_id."\"><img src=\"./images/art/works/square-medium/" . $image . ".jpg\"/></a>";
              echo "<h4><a href=\"/shek/Part03_SingleWork?id=" .$artwork_id."\">" .$title. "</a></h4>";
              echo "<p>" .$desc. "</p></div></div>";     
                
              }
            }
            
            function searchDesc($q){
            
              $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shek";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            } 
            
              $sql = "SELECT ArtWorkID, ImageFileName, Description, Title FROM artworks where Description LIKE '%" .$q. "%'";
              $result = $conn->query($sql);
              
              
              echo"<div class=\"row \">
                    <div class=\"col-lg-12\">
                        <h2 class=\"page-header\">Searching for " .$q. " in description</h2></div></div>";
            
                        while($row = $result->fetch_assoc()) {
              $image = $row["ImageFileName"];
              $artwork_id = $row["ArtWorkID"];
              $title = $row["Title"];
              $desc = $row["Description"];
              $desc2 = highlighter_text($desc,$q);
            
              echo "<div class=\"row search-results\"><div class=\"col-lg-12\"><a href=\"/shek/Part03_SingleWork?id=" .$artwork_id."\"><img src=\"./images/art/works/square-medium/" . $image . ".jpg\"/></a>";
              echo "<h4><a href=\"/shek/Part03_SingleWork?id=" .$artwork_id."\">" .$title. "</a></h4>";
              echo "<p>" .$desc2. "</p></div></div>";     
                
              }
            }
            
            function noFilter($q){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shek";
            
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            } 
            
              $sql = "SELECT ArtWorkID, ImageFileName, Description, Title FROM artworks where Title LIKE '%" .$q. "%' OR Description LIKE '%" .$q. "%'";
              $result = $conn->query($sql);
              
              
              echo"<div class=\"row\">
                    <div class=\"col-lg-12\">
                        <h2 class=\"page-header\">Searching for " .$q. " with no filter</h2></div></div>";
            
                        while($row = $result->fetch_assoc()) {
              $image = $row["ImageFileName"];
              $artwork_id = $row["ArtWorkID"];
              $title = $row["Title"];
              $desc = $row["Description"];
              $desc2 = highlighter_text($desc,$q);
              $title2 = highlighter_text($title,$q);
            
              echo "<div class=\"row search-results\"><div class=\"col-lg-12\"><a href=\"/shek/Part03_SingleWork?id=" .$artwork_id."\"><img src=\"./images/art/works/square-medium/" . $image . ".jpg\"/></a>";
              echo "<h4><a href=\"/shek/Part03_SingleWork?id=" .$artwork_id."\">" .$title2. "</a></h4>";
              echo "<p>" .$desc2. "</p></div></div>";     
                
              }
            }
            
            
            function highlighter_text($text, $words)
            {
            $split_words = explode( " " , $words );
            foreach($split_words as $word)
            {
                $color = "yellow";
                $text = preg_replace("|($word)|Ui" ,
                    "<span style=\"background:".$color.";\"><b>$1</b></span>" , $text );
            }
            return $text;
            }
            
            ?>
         <footer class="footer" >
            <div class="container">
               <p class="text-muted">Made with <span class="glyphicon glyphicon-heart" style="color:red"></span> in Espoo, FI.</p>
            </div>
         </footer>
      </div>
      <script language="Javascript">
         function showtitle()
         {
         
             document.getElementById("des-search").style.display="none";
             document.getElementById("filterless-search").style.display="none";
             document.getElementById("title-search").style.display="block";    
         
         }
         
         function showdesc()
         {
         
             document.getElementById("des-search").style.display="block";
             document.getElementById("filterless-search").style.display="none";
             document.getElementById("title-search").style.display="none";
         }
         
         function shownope()
         {
          
             document.getElementById("des-search").style.display="none";
             document.getElementById("filterless-search").style.display="block";
             document.getElementById("title-search").style.display="none";
         }
      </script>
      <script
         src="https://code.jquery.com/jquery-3.1.1.min.js"
         integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
         crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   </body>
</html>