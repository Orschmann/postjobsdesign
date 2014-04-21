<?php
    require_once("connect_vars.php");
    require_once("faculty-class.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Faculty</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
		
		<link href="assets/css/styles.css" rel="stylesheet">
		
		<link href='http://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Alike' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 <?php

    $dbc = mysqli_connect(HOST, USER, PASSWORD, DBNAME)
    or die('Error connecting to MySQL server.');
    $faculty_id = $_GET['id'];
    $query = "SELECT * FROM faculty WHERE faculty_id = $faculty_id";
    $result = mysqli_query($dbc, $query);
    $row = mysqli_fetch_array($result);

    $faculty = new Faculty(); 
    $faculty->setFaculty($dbc, $row);

 ?> 

  <body>
	<div class="container">
	<img class="logo" src="assets/img/logo.jpg" alt="post jobs">
	<p class="info">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean comodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis partu
rient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec ped
e justo, fringilla vel, aliquet nec, vulputate eget, arcu. </p><br class="clear">
	<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav nav-pills">
       <li><a href="index_logged-in.html">Home</a></li>
        <li><a href="student.html">Students</a></li>
        <li><a href="employer.html">Employers</a></li>
      	<li class="active"><a href="faculty.html">Faculty</a></li>
      	<li><a href="job.html">Jobs</a></li>
      	<li><a href="search.php">Search</a></li>
      	<li><a href="contact.html">Contact</a></li>
        
      </ul>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="col-md-8 main"><h2>Meet Faculty: <?php echo $faculty->name ?></h2><img src="assets/img/pbhs.jpg" class="pbhs" alt="pbhs" height="100" width="100">
  <?php
      echo '<p class="first">
            Name: ' . $faculty->name . '
            <br>
            Department/Discipline: ' . $faculty->department . '
            <br>
            Contact Email: ' . $faculty->email . '
            <br>
            Contact Phone: ' . $faculty->phone . '
            </p>
            <br class="clear">
            <p class="second">
            Field: ' . $faculty->category . '
            <br>
            Skills Needed: ';
            foreach ($faculty->skills as $skill) {
                        echo $skill . '<br>';
                    }
      echo  'Location Near: ' . $faculty->location . '
            </p>'
  ?>
<h3>Introduction</h3><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis partu
rient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec ped
e justo, fringilla vel, aliquet nec, vulputate eget, arcu. </p>
</div><!-- end col 8 -->

<div class="col-md-4 aside"><div class="btn-group">
  <button type="button" class="btn btn-warning"><a href="index_logged-in.html">Edit My Profile</a></button>
</div>

<h3>Portfolio Albums</h3><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis partu
rient montes, nascetur ridiculus mus. Donec quam felis,</p><h3>Portfolio Videos</h3><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis partu
rient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec ped
e justo, fringilla vel, aliquet nec, vulputate eget, arcu. </p></div><!-- end col 4 -->
<div class="col-md-12 footer">
        <a href="index_logged-in.html">Home</a>
        <a href="student.html">Students</a>
				<a href="employer.html">Employers</a>
				<a href="faculty.html">Faculty</a>
				<a href="job.html">Jobs</a>
				<a href="search.html">Search</a>
				<a href="contact.html">Contact</a></div>
</div><!-- end container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>