<?php

if (isset($_GET['id'])) {
  $id = is_numeric(trim($_GET['id'])) ? trim($_GET['id']) : '';
}

if ($id) {

  // try/catch for db connection and to handle exceptions
  try {
    $DBH = new PDO('sqlite:nissan_im_tour.db');
    // Set errormode to exceptions
    $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $ex) {
    echo "DB Connection Issue - " . $ex->getMessage();
    exit();
  } catch (Exception $e) {
    echo "Exception encountered - " . $e->getMessage();
    exit();
  }

  // database query for the ID entered
  $query = "SELECT * FROM users WHERE id = :id";
  try {

      // prepare, bind vars, and execute query
      $stmt = $DBH->prepare($query);
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      // cycle through data and assign vars to be used later
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $user_id = $row['id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $address = $row['address'];
        $apt = $row['apt'];
        $city = $row['city'];
        $state = $row['st'];
        $zip = $row['zip'];
        $email = $row['email'];
        $q1 = $row['q1'];
        $q2 = $row['q2'];
        $q3 = $row['q3'];
        $q4 = $row['q4'];
        $q5 = $row['q5'];
        $agree = $row['agree'];
        $agree_minor = $row['agree_minor'];
        $minors = $row['minors'];
        $signature = $row['signature'];
        $optin1 = $row['optin1'];
        $optin2 = $row['optin2'];
        $date = $row['date'];
        $time = $row['time'];
        $datetime = $row['datetime'];
        $ipaddress = $row['ipaddress'];
        $ua = $row['ua'];
      }
  // exception handling
  } catch (Exception $ex) {
      include_once 'index.php';
      echo '<script type="text/javascript">alert("There was a problem. Please re-enter your information. Error - ' . $ex->getMessage() . ' ");</script>';
      exit();
  } catch (PDOException $e) {
      include_once 'index.php';
      echo '<script type="text/javascript">alert("There was a problem. Please re-enter your information.  Error - ' . $e->getMessage() . ' ");</script>';
      exit();
  }
}

?>



<?php require_once 'head.php'; ?>

   </head>
   <body>

     <div class="container">
        <!-- header row including Nissan logo and event title -->
       	<div class="row" id="header">
           <div class="col-3 nissan-logo"><img src="assets/img/nissan-logo.png" alt="Nissan Innovation that Excites" /></div>
           <div class="col-9 nissan-title">
             <h2 class="right"><strong>Nissan Intelligent Mobility Tour</strong></h2>
             <h4 class="right gray"><strong>Fillmore Jazz Festival</strong></h4>
           </div>
         </div>

         <!-- hero image -->
         <div class="row" id="hero-img">
           <img src="assets/img/header.png" alt="Experience tomorrow's technology today behind the wheel of an all-new Nissan" class="img-fluid" />
         </div>

         <!-- make sure that there is data for the id that is in the URL -->
         <?php if($id) { ?>

         <!-- thank you messaging -->
         <h2>Thank you for entering!</h2>

         <p>Please see the information that you entered, displayed below.</p>

         <!-- display inserted data -->
         <table class="table table-striped">
           <thead><th>Column</th><th>Value</th></thead>
           <tbody>
             <tr><td>User ID</td><td><?php echo $user_id; ?></td></tr>
             <tr><td>First Name</td><td><?php echo $fname; ?></td></tr>
             <tr><td>Last Name</td><td><?php echo $lname; ?></td></tr>
             <tr><td>Address</td><td><?php echo $address; ?></td></tr>
             <tr><td>Apt</td><td><?php echo $apt; ?></td></tr>
             <tr><td>City</td><td><?php echo $city; ?></td></tr>
             <tr><td>State</td><td><?php echo $state; ?></td></tr>
             <tr><td>Zip</td><td><?php echo $zip; ?></td></tr>
             <tr><td>Email</td><td><?php echo $email; ?></td></tr>
             <tr><td>I plan on purchasing my next vehicle within</td><td><?php echo $q1; ?></td></tr>
             <tr><td>I am interested in the following vehicles</td><td><?php echo $q2; ?></td></tr>
             <tr><td>How likely would you be to consider Nissan for your next new vehicle purchase?</td><td><?php echo $q3; ?></td></tr>
             <tr><td>What is your overall opinion of Nissan?</td><td><?php echo $q4; ?> / 10</td></tr>
             <tr><td>How would you like to participate in today's experience?</td><td><?php echo $q5; ?></td></tr>
             <tr><td>I have read and understood this entire agreement</td><td><?php echo $agree; ?></td></tr>
             <tr><td>I have requested that the minor(s) listed below be allowed to accompany me as a passenger in the Event</td><td><?php echo (empty($agree_minor) ? "n/a" : $agree_minor); ?></td></tr>
             <tr><td>Names of Minors</td><td><?php echo (empty($minors) ? "n/a" : $minors); ?></td></tr>
             <tr><td>Signature</td><td><img src="<?php echo $signature; ?>" class="img-fluid" /></td></tr>
             <tr><td>I would like to receive exciting product and event news from Nissan</td><td><?php echo (empty($optin1) ? "No thank you" : $optin1); ?></td></tr>
             <tr><td>I would like to be contacted by a Nissan dealer for more vehicle information</td><td><?php echo (empty($optin2) ? "No thank you" : $optin2); ?></td></tr>
             <tr><td>Entry Date</td><td><?php echo $date; ?></td></tr>
             <tr><td>Entry Time</td><td><?php echo $time; ?></td></tr>
             <tr><td>Entry Timestamp</td><td><?php echo $datetime; ?></td></tr>
             <tr><td>User IP Address (reported)</td><td><?php echo $ipaddress; ?></td></tr>
             <tr><td>User Agent (reported)</td><td><?php echo $ua; ?></td></tr>
           </tbody>
         </table>

         <!-- option to add another entry for testing purposes -->
         <div class="row">
           <div class="col-sm-12 form-group">
             <a href="index.php">Submit another entry</a>
           </div>
         </div>

        <!-- if the id entered isn't valid / has no data, chances are that the id passed in the url was messed with during testing -->
        <?php } else { ?>
        <h2>Sorry, there appears to be an issue with this user entry. Did you try to guess an entry ID? Naughty!</h2>
        <?php } ?>

     </div>

     <?php require_once 'foot.php'; ?>
  </body>
</html>
