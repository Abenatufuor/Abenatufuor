<?php
include_once "get_menus.php";
$role = $_GET['role'];
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/attend.css">
<title>Dashboard</title>
</head>
<body>

<div class="menu">    
<?php 
echo get_menus($role,"Manage");
?>
</div>
<div id="title" class="title-box">
        <h1 id="title-text">Dashboard: Upcoming Classes</h1>
    </div><div id="upcoming-div" class="form-box">
</div>   
</body>
</html>