

    
<?php echo '
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Lobster+Two" rel="stylesheet" type="text/css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 
<script> 
    $(document).ready(function(){   
    $("#fullSearch").click(function(){
        $("#sideBar").slideToggle("fast");  
    }); 
});

$(function(){$("#fullSearch").click(function(){$("html,body").animate({scrollTop:$("#top").offset().top},"500");return false})})
</script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <title>LibProj</title>
</head>
<body>
<div class="wrapper">
  <div class="header">
  <div id="logo" class="noselect">public<span class="noselect">LiB</span></div>
  
  	<div class="container">
  		<ul>
  			<li><a href="index.php?page=home"><div id="first" class="button"><p>Home</p></div></a></li>
  			<li><a href="index.php?page=profile"><div id="second" class="button"><p>Profile</p></div></a></li>
  			<li><a href="index.php?page=about"><div id="third" class="button"><p>About us</p></div></a></li>
                         <li><a href="index.php?page=insert"><div id="fourth" class="button"><p>Insert New</p></div></a></li>
                       
  		</ul>
        <div class ="searchDiv"><form class="navbar-form navbar-left" role="search" method="post" action="index.php?go&page=Searching&offset=0" id="searchform">
        <div class="form-group">    
          <input type="text" name="name" class="form-control" placeholder="Search" size="30">
        </div>
        <button type="submit" name="submit" class="btn btn-default"> GO!</button>
      </form></div>
     
      <a href="#top"> <div id="fullSearch"><p>Extended Searching</p></div></a>
</div>
  </div>
  
  <div class="left"></div>
  <div class="main-plate" >
  	<!--<div class="inner">
        <div class="record">
        new
        </div>-->
        <p id="top"></p>
        ' ?>

<?php

$p = $_GET['page'];
$page = "Search \"Engine\"/" . $p . ".php";
$page2 = $p . ".php";
if (file_exists($page)) {
    include($page);
} elseif (file_exists($page2)) {
    include($page2);
} elseif ($p == "") {
    $page = "home.php";
    include($page);
} else {
    echo 'nice';
}
?>

<?php echo '
  	</div>
        
           <div id="sideBar">
             <p style="font-size: 18px; text-decoration: underline; margin-top: 5px;"> Explore more accurate with Side Bar Search!</p>
             
             <div class="form-container">
                <form class="navbar-form navbar-left" role="search" method="post" action="index.php?go&page=Searching" id="searchform">
                 <div class="form-group">    
          <input type="text" name="name" class="form-control" placeholder="Author\'s name" size="30">
        <button type="submit" name="authorSearch" class="btn btn-default">GO!</button>
         </div>
         </form>
         <form class="navbar-form navbar-left" role="search" method="post" action="index.php?go&page=yearSearch" id="searchform">
         <div class="search">
        <input type="text" name="year" class="form-control" placeholder="Year" size="30">
        <button type="submit" name="yearSearch" class="btn btn-default">GO!</button>
        </div>
                </form>
                
<form class="navbar-form navbar-left" role="search" method="post" action="index.php?go&page=journalSearch" id="searchform">
         <div class="search">
        <input type="text" name="journal" class="form-control" placeholder="Journal" size="30">
        <button type="submit" name="journalSearch" class="btn btn-default">GO!</button>
        </div>
                </form>
                
<form class="navbar-form navbar-left" role="search" method="post" action="index.php?go&page=confSearch" id="searchform">
         <div class="search">
        <input type="text" name="conf" class="form-control" placeholder="Conference" size="30">
        <button type="submit" name="confSearch" class="btn btn-default">GO!</button>
        </div>
                </form>
                

<form class="navbar-form navbar-left" role="search" method="post" action="index.php?go&page=titleSearch" id="searchform">
         <div class="search">
        <input type="text" name="title" class="form-control" placeholder="Title" size="30">
        <button type="submit" name="titleSearch" class="btn btn-default">GO!</button>
        </div>
                </form>
                

                
<form class="navbar-form navbar-left" role="search" method="post" action="index.php?go&page=keyWordSearch" id="searchform">
         <div class="search">
        <input type="text" name="keyWord" class="form-control" placeholder="Keyword" size="30">
        <button type="submit" name="keyWordSearch" class="btn btn-default">GO!</button>
        </div>
                </form>
                
<form class="navbar-form navbar-left" role="search" method="post" action="index.php?go&page=paperTypeSearch" id="searchform">
         <div class="search">
        <input type="text" name="paper" class="form-control" placeholder="Type of paper" size="30">
        <button type="submit" name="paperTypeSearch" class="btn btn-default">GO!</button>
        </div>
                </form>
                
<form class="navbar-form navbar-left" role="search" method="post" action="index.php?go&page=instituteSearch" id="searchform">
         <div class="search">
        <input type="text" name="institute" class="form-control" placeholder="Institute" size="30">
        <button type="submit" name="instituteSearch" class="btn btn-default">GO!</button>
        </div>
                </form>
                
                

             </div>
            </div>
        
   </div>
    
  <div class="footer">
  	<div class="container">
  		<ul>
  			<li>Created by Makaev Boris. BS1-3.</li>
  			<li><a href="sandman96@mail.ru">E-mail Me</a></li>
  		</ul>
  	</div>
  </div>

</body>
</html> ' ?>
 
