<?php
    require_once("connect_vars.php");
    require_once("student-class.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Jobs</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">        
    <link href="assets/css/styles.css" rel="stylesheet">        
    <link href='http://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Alike' rel='stylesheet' type='text/css'>
<body>


<div class="container">
    <img class="logo" src="assets/img/logo.jpg" alt="post jobs">
    <br class="clear">
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
  <li class="active"><a href="student.html">Students</a></li>
  <li><a href="employer.html">Employers</a></li>
    <li><a href="faculty.html">Faculty</a></li>
    <li><a href="job.html">Jobs</a></li>
    <li><a href="search.html">Search</a></li>
    <li><a href="contact.html">Contact</a></li>
        
      </ul>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?php

    $student = new Student();

    if (isset($_POST['submit'])){
        $dbc = mysqli_connect(HOST, USER, PASSWORD, DBNAME)
            or die('Error connecting to MySQL server.');
        $student->name = mysqli_real_escape_string($dbc, trim($_POST['name']));
        $student->email = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $student->phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
        $student->category = mysqli_real_escape_string($dbc, (int)trim($_POST['category']));
        $student->location = mysqli_real_escape_string($dbc, (int)trim($_POST['location']));

        if (!empty($_POST["skills"]) && !empty($_POST["skills"])) {
            $student->skills  = $_POST["skills"];
            $student->occupation = $_POST['occupation'];
        }

        if ($student->isEmpty()) {
                echo '<div class="row alert alert-danger">You must fill out all required fields before submitting the form.</div>';
        }

    }

    if ($student->isEmpty() == false) {
        $query = "INSERT INTO student (student_name, student_email, student_phone, 
                                        student_category, student_location)
                                VALUES ('$student->name', '$student->email', '$student->phone','$student->category', '$student->location')";

        $result = mysqli_query($dbc, $query)
                or die('Error connecting to server.');

        $student_id = mysqli_insert_id($dbc);
        $skills = $student->skills;
        for ($i = 0; $i < count($skills); $i++) {
            $student_skill = "student_skill_" . ($i + 1);
            $array_query = "UPDATE student SET $student_skill = $skills[$i]
                        WHERE student_id = LAST_INSERT_ID()";
            $array_result = mysqli_query($dbc, $array_query)
                or die('Error inserting array values.');
        }

        $occupation = $student->occupation;
        for ($i = 0; $i < count($occupation); $i++) {
            $student_occupation = "student_occupation_" . ($i + 1);
            $array_query = "UPDATE student SET $student_occupation = '$occupation[$i]'
                        WHERE student_id = LAST_INSERT_ID()";
            $array_result = mysqli_query($dbc, $array_query)
                or die('Error inserting array values.');
        }

        echo '<div class="row alert alert-success">Thank you. Here is a link to your profile: ' .
                '<a href="student.php?id=' . $student_id . '">' . $student->name . '\'s profile</a></div>';
        mysqli_close($dbc);
    }

?>

    <main>
        <h2>Sign up as a student - Job Site</h2>
        <section id="student" class="col-md-5 pull-left">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input  class="form-control" type="text" name="name" id="name" value="<?php echo $student->name; ?>">
                </div>

                <div class="form-group">
                <label for="email">Email: </label>
                <input  class="form-control" type="text" name="email" id="email" value="<?php echo $student->email; ?>">
                </div>

                <div class="form-group">
                <label for="phone">Phone Number: </label>
                <input  class="form-control" type="text" name="phone" id="phone" value="<?php echo $student->phone; ?>">
                </div>

                <div class="form-group">
                <label for="category">Select one category:</label>
                <select class="form-control" size="1" name="category" id="category">
                    <option value="01">Database and Information Systems</option>
                    <option value="02">Digital Media Graphics, Design, Film &amp; Audio</option>
                    <option value="03">Networking and Telecommunications</option>
                    <option value="04">Security</option>
                    <option value="05">Software Development and Programming</option>
                    <option value="06">Systems Administrator</option>
                    <option value="07">User Hardware and Support/Help Desk</option>
                    <option value="08">Web Design and Development</option>
                </select>
                </div>

                <div class="form-group">
                <label for="skills">Skills:</label>
                <select multiple size="5" name="skills[]" id="skills" class="form-control">  
                    <option value="0001">.NET</option>
                    <option value="0002">3-D Studio Max</option>
                    <option value="0003">Access</option>
                    <option value="0004">Acrobat</option>
                    <option value="0005">Active Directory</option>
                    <option value="0006">Adobe Creative Suite</option>
                    <option value="0007">After Effects</option>
                    <option value="0008">Ajax</option>
                    <option value="0009">Android</option>
                    <option value="0010">Apache</option>
                    <option value="0011">Apple iOS</option>
                    <option value="0012">Apple OS</option>
                    <option value="0013">Apple SDK</option>
                    <option value="0014">ASP</option>
                    <option value="0015">Audition</option>
                    <option value="0016">AutoCad</option>
                    <option value="0017">Blackberry OS</option>
                    <option value="0018">Bluetooth</option>
                    <option value="0019">Bridge</option>
                    <option value="0020">C</option>
                    <option value="0021">C#</option>
                    <option value="0022">C++</option>
                    <option value="0023">Cisco IOS</option>
                    <option value="0024">Cold Fusion</option>
                    <option value="0025">Contribute</option>
                    <option value="0026">CSS</option>
                    <option value="0027">DB2</option>
                    <option value="0028">Design for Mobile Devices</option>
                    <option value="0029">Device Central</option>
                    <option value="0030">DHCP</option>
                    <option value="0031">DHTML</option>
                    <option value="0032">DOM</option>
                    <option value="0033">DNS</option>
                    <option value="0034">Dreamweaver</option>
                    <option value="0035">Drupal</option>
                    <option value="0036">Encase</option>
                    <option value="0037">Encore</option>
                    <option value="0038">Ethernet</option>
                    <option value="0039">Excel</option>
                    <option value="0040">Exchange Server</option>
                    <option value="0041">FaceBook</option>
                    <option value="0042">Final Cut Pro</option>
                    <option value="0043">Fireworks</option>
                    <option value="0044">Flash</option>
                    <option value="0045">FTK</option>
                    <option value="0046">HTML</option>
                    <option value="0047">HTML 5</option>
                    <option value="0048">HyperV</option>
                    <option value="0049">IIS</option>
                    <option value="0050">Illustrator</option>
                    <option value="0051">InDesign</option>
                    <option value="0052">Inventor</option>
                    <option value="0053">IPv6</option>
                    <option value="0054">JAVA</option>
                    <option value="0055">Javascript</option>
                    <option value="0056">Joomla</option>
                    <option value="0057">JQuery</option>
                    <option value="0058">Junos</option>
                    <option value="0059">Keynote</option>
                    <option value="0060">LinkedIn</option>
                    <option value="0061">Linux</option>
                    <option value="0062">Maya</option>
                    <option value="0063">Media Encoder</option>
                    <option value="0064">Microsoft Project</option>
                    <option value="0065">MySQL</option>
                    <option value="0066">NetFlow</option>
                    <option value="0067">OnLocation</option>
                    <option value="0068">Oracle Database</option>
                    <option value="0069">Orion</option>
                    <option value="0070">Outlook</option>
                    <option value="0071">Perl</option>
                    <option value="0072">Photoshop</option>
                    <option value="0073">PHP</option>
                    <option value="0074">Powerpoint</option>
                    <option value="0075">Premiere Pro</option>
                    <option value="0076">Pro Tools</option>
                    <option value="0077">PowerShell</option>
                    <option value="0078">Python</option>
                    <option value="0079">Quark Xpress</option>
                    <option value="0080">Red Hat</option>
                    <option value="0081">Ruby</option>
                    <option value="0082">Ruby on Rails</option>
                    <option value="0083">Search Engine Marketing</option>
                    <option value="0084">Search Engine Optimization</option>
                    <option value="0085">Sharepoint</option>
                    <option value="0086">Social Media</option>
                    <option value="0087">Soundbooth</option>
                    <option value="0088">SQL</option>
                    <option value="0089">Twitter</option>
                    <option value="0090">UNIX</option>
                    <option value="0091">Visio</option>
                    <option value="0092">Visual Basic</option>
                    <option value="0093">vSphere</option>
                    <option value="0094">Wi-Fi</option>
                    <option value="0095">Windows</option>
                    <option value="0096">Windows Mobile OS</option>
                    <option value="0097">Windows Server</option>
                    <option value="0098">Winhex</option>
                    <option value="0099">Wireshark</option>
                    <option value="0100">Word</option>
                    <option value="0101">WordPress</option>
                    <option value="0102">XenServer</option>
                    <option value="0103">XenDesktop</option>
                    <option value="0104">XHTML</option>
                    <option value="0105">XNA</option>
                    <option value="0106">XML</option>
                    <option value="0107">XNG</option>
                </select>
                </div>

                <div class="form-group">
                <label for="occupation">Looking For: </label>
                <select multiple class="form-control" size="1" name="occupation[]" id="occupation"><!--my selection list-->
                    <option value="01">Internship</option>
                    <option value="02">Contract Work</option>
                    <option value="03">Part Time</option>
                    <option value="04">Full Time</option>
                </select>
                </div>

                <div class="form-group">
                <label for="location">Location Near: </label>
                <select class="form-control" size="1" name="location" id="location">
                    <option value="001">Santa Rosa</option>
                    <option value="002">Napa</option>
                    <option value="003">Sonoma</option>
                </select>
                </div>
                <input class="btn btn-primary" type="submit" name="submit">
            </form>
       </section>
    </main>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>