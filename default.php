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
      <meta name="description" content="Art website by shek!">
      <meta name="author" content="Shek">
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
                     <li class="active"><a href="/shek/default.php">Home<span class="sr-only">(current)</span></a></li>
                     <li><a href="/shek/about.php">About</a></li>
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
               
            </div>
            
         </nav>
         <div class="jumbotron">
            <div class="container">
               <h1>Welcome to ArtMart!</h1>
               <p></p>
            </div>
         </div>
         <div class="row about-links">
            <div class="test">
               <div class="col-sm-3 cards">
                  <span class="glyphicon glyphicon-info-sign glyph"></span>
                  <h3>About us</h3>
                  <p>What is this about?</p>
                  <a href="/shek/about.php"><button class="btn btn-info"><span class="glyphicon glyphicon-link"></span>Visit page</button></a>
               </div>
               <div class="col-sm-3 cards">
                  <span class="glyphicon glyphicon-th-list  glyph"></span>
                  <h3>Artist List</h3>
                  <p>Displays a list if artist names as links</p>
                  <a href="/shek/Part01_ArtistsDataList.php"><button class="btn btn-info"><span class="glyphicon glyphicon-link"></span>Visit page</button></a>
               </div>
               <div class="col-sm-3 cards">
                  <span class="glyphicon glyphicon-search glyph"></span>
                  <h3>Search</h3>
                  <p>Perform Search on artwork table</p>
                  <a href="/shek/Part04_Search.php"><button class="btn btn-info"><span class="glyphicon glyphicon-link"></span>Visit page</button></a>
               </div>
            </div>
         </div>
         <div class="row about-links">
            <div class="col-sm-5 cards2">
               <span class="glyphicon glyphicon-user glyph"></span>
               <h3>Single Artist</h3>
               <p>Display information for a single artist</p>
               <a href="/shek/Part02_SingleArtist.php?id=19"><button class="btn btn-info"><span class="glyphicon glyphicon-link"></span>Visit page</button></a>
            </div>
            <div class="col-sm-5 cards2">
               <span class="glyphicon glyphicon-picture glyph"></span>
               <h3>Single Work</h3>
               <p>Display information for a single work</p>
               <a href="/shek/Part03_SingleWork.php?id=394"><button class="btn btn-info"><span class="glyphicon glyphicon-link"></span>Visit page</button></a>
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