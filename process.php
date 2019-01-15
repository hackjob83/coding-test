<?php

/**
********************************************************************************
Author: John Hackett
Description: Processor page for Synergy Marketing Partners code test. This page
provides additional validation on top of the js validation on the front end.
Data is stored in a SQLite3 database for the purposes of this example.
********************************************************************************
**/

// during dev and testing
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// for production
// error_reporting(E_ALL);
// ini_set('display_errors', 0);
// ini_set("log_errors", 1);
// ini_set("error_log", "/path/to/error_log.log");

// static vars - date, time, etc
$datetime = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$time = date('H:i:s');
$ipAddress = $_SERVER['REMOTE_ADDR'];
$ua = $_SERVER['HTTP_USER_AGENT'];

// clean and assign post variables
$fname = (isset($_POST['fname']) ? sanitize($_POST['fname']) : '');
$lname = (isset($_POST['lname']) ? sanitize($_POST['lname']) : '');
$address = (isset($_POST['address']) ? sanitize($_POST['address']) : '');
$apt = (isset($_POST['apt']) ? sanitize($_POST['apt']) : '');
$city = (isset($_POST['city']) ? sanitize($_POST['city']) : '');
$state = (isset($_POST['state']) ? sanitize($_POST['state']) : '');
$zip = (isset($_POST['zip']) ? sanitize($_POST['zip']) : '');
$email = (isset($_POST['email']) ? sanitize($_POST['email']) : '');
$c_email = (isset($_POST['c_email']) ? sanitize($_POST['c_email']) : '');
$q1 = (isset($_POST['q1']) ? sanitize($_POST['q1']) : '');
$q2 = (isset($_POST['q2']) ? sanitize($_POST['q2']) : ''); // array?
$q3 = (isset($_POST['q3']) ? sanitize($_POST['q3']) : '');
$q4 = (isset($_POST['q4']) ? sanitize($_POST['q4']) : '');
$q5 = (isset($_POST['q5']) ? sanitize($_POST['q5']) : '');
$agree = (isset($_POST['agree']) ? sanitize($_POST['agree']) : '');
$agree_minor = (isset($_POST['agree_minor']) ? sanitize($_POST['agree_minor']) : '');
$signature = (isset($_POST['signature']) ? $_POST['signature'] : '');
$minor1 = (isset($_POST['minor1']) ? sanitize($_POST['minor1']) : '');
$minor2 = (isset($_POST['minor2']) ? sanitize($_POST['minor2']) : '');
$minor3 = (isset($_POST['minor3']) ? sanitize($_POST['minor3']) : '');
$optin1 = (isset($_POST['optin1']) ? sanitize($_POST['optin1']) : '');
$optin2 = (isset($_POST['optin2']) ? sanitize($_POST['optin2']) : '');
$minors = (!empty($minor1) ? $minor1 . "; " : "") . (!empty($minor2) ? $minor2 . "; " : "") . (!empty($minor3) ? $minor3 . "; " : "");

// regex to test zip code format
$zipCodeReg = '/^\d{5}$/';

// boolean and string builder for errors
$errorExists = false;
$errorString = 'ERROR: The following form fields must be filled out correctly: \n';

// start validating post vars
if ($fname === '' || strlen($fname) < 2) {
    $errorExists = true;
    $errorString .= ' - First Name \n';
}
if ($lname === '' || strlen($lname) < 2) {
    $errorExists = true;
    $errorString .= ' - Last Name \n';
}
if ($address === '' || strlen($address) < 2) {
    $errorExists = true;
    $errorString .= ' - Address \n';
}
if ($city === '' || strlen($city) < 2) {
    $errorExists = true;
    $errorString .= ' - City \n';
}
if ($state === '' || strlen($state) < 2) {
    $errorExists = true;
    $errorString .= ' - State \n';
}
if (preg_match($zipCodeReg, $zip) === 0) {
    $errorExists = true;
    $errorString .= ' - Zip Code \n';
}
if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
    $errorExists = true;
    $errorString .= ' - Email must be valid \n';
}
if (!(filter_var($c_email, FILTER_VALIDATE_EMAIL))) {
    $errorExists = true;
    $errorString .= ' - Email confirmation must be valid \n';
}
if ($c_email != $email) {
    $errorExists = true;
    $errorString .= ' - Emails must match \n';
}
if (empty($q1)){
    $errorExists = true;
    $errorString .= ' - Please answer "I plan on purchasing my next vehicle within" \n';
}
if (empty($q2)){
    $errorExists = true;
    $errorString .= ' - Please answer "I am interested in the following vehicles" \n';
}
if (empty($q3)){
    $errorExists = true;
    $errorString .= ' - Please answer "How likely would you be to consider Nissan for your next new vehicle purchase?" \n';
}
if (empty($q4)){
    $errorExists = true;
    $errorString .= ' - Please answer "What is your overall opinion of Nissan?" \n';
}
if (empty($q5)){
    $errorExists = true;
    $errorString .= ' - Please answer "How would you like to participate in today\'s experience?" \n';
}
if (empty($agree)){
    $errorExists = true;
    $errorString .= ' - Please agree that you have read and understood the entire agreement \n';
}
if (!empty($agree_minor)){
  if (empty($minor1)) {
    $errorExists = true;
    $errorString .= ' - Please enter the name(s) of the minor(s) accompanying you \n';
  }
}
if(empty($signature)) {
    $errorExists = true;
    $errorString .= ' - Please sign in the box \n';
}

// if there are any errors, alert the user
if ($errorExists) {
    include_once("index.php");
    echo '<script type="text/javascript">alert("' . $errorString . '");</script>';
    exit();
}

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

// set up insert statement
$sql = "insert into users (";
$sql .= " fname, lname, address, apt, city, st, zip, email, q1, q2, q3, q4, q5, agree, agree_minor, minors, signature, optin1, optin2, date, time, datetime, ipaddress, ua ";
$sql .= " ) values ( ";
$sql .= " :fname, :lname, :address, :apt, :city, :st, :zip, :email, :q1, :q2, :q3, :q4, :q5, :agree, :agree_minor, :minors, :signature, :optin1, :optin2, :date, :time, :datetime, :ipaddress, :ua";
$sql .= "); ";

// prepare variables
try {
    $stmt = $DBH->prepare($sql);
    $stmt->bindValue(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindValue(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindValue(':address', $address, PDO::PARAM_STR);
    $stmt->bindValue(':apt', $apt, PDO::PARAM_STR);
    $stmt->bindValue(':city', $city, PDO::PARAM_STR);
    $stmt->bindValue(':st', $state, PDO::PARAM_STR);
    $stmt->bindValue(':zip', $zip, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':q1', $q1, PDO::PARAM_STR);
    $stmt->bindValue(':q2', (is_array($q2) ? implode(";", $q2) : $q2), PDO::PARAM_STR);
    $stmt->bindValue(':q3', $q3, PDO::PARAM_STR);
    $stmt->bindValue(':q4', $q4, PDO::PARAM_STR);
    $stmt->bindValue(':q5', $q5, PDO::PARAM_STR);
    $stmt->bindValue(':agree', $agree, PDO::PARAM_STR);
    $stmt->bindValue(':agree_minor', $agree_minor, PDO::PARAM_STR);
    $stmt->bindValue(':minors', $minors, PDO::PARAM_STR);
    $stmt->bindValue(':signature', $signature, PDO::PARAM_STR);
    $stmt->bindValue(':optin1', $optin1, PDO::PARAM_STR);
    $stmt->bindValue(':optin2', $optin2, PDO::PARAM_STR);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->bindValue(':time', $time, PDO::PARAM_STR);
    $stmt->bindValue(':datetime', $datetime, PDO::PARAM_STR);
    $stmt->bindValue(':ipaddress', $ipAddress, PDO::PARAM_STR);
    $stmt->bindValue(':ua', $ua, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // success
        // redirect to thank you page
        // add user id to populate dynamic data on thank you page
        header("Location: thankyou.php?id=".$DBH->lastInsertId());
        exit();
    } else {
        // failed insert
        include_once 'index.php';
        echo '<script type="text/javascript">alert("There was a problem. Please re-enter your information");</script>';
        exit();
    }

// exception handlers
} catch (Exception $ex) {
    include_once 'index.php';
    echo '<script type="text/javascript">alert("There was a problem. Please re-enter your information. Error - ' . $ex->getMessage() . ' ");</script>';
    exit();
} catch (PDOException $e) {
    include_once 'index.php';
    echo '<script type="text/javascript">alert("There was a problem. Please re-enter your information.  Error - ' . $e->getMessage() . ' ");</script>';
    exit();
}








/**
 * part of the sanitize function
 * This part is the blacklist section where we can specify things to be taken out
 * Also purifies() and htmlspecialchars() the input
 *
 * @global HTMLPurifier $purifier
 * @param type $input
 * @return type
 */
function cleanInput($input) {
    $search = array(
        '@<script[^>]*?>.*?</script>@si', // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@', // Strip multi-line comments
        '/onEvent\=+/i', // Strip onEvent calls
        '/\"|<|>|{|}|\[|\]*/'                               // Strip double quotes, left and right brackets, etc
    );

    $input = trim($input);                                  // trim to remove leading and trailing spaces if not already removed
    $blacklist_input = preg_replace($search, '', trim($input));   // perform preg_replace to strip out blacklisted items
    $output = htmlspecialchars($blacklist_input);      // htmlspecialchars as an added precaution
    //$output = $purifier->purify($strip_input);              // run trhough purifier
    return $output;                                         // return cleaned input
}

/**
 * Second half of the sanitize function
 * This one stripslashes() and escapes the input
 *
 * @global Mysql $database
 * @param type $input
 * @return type
 */
function sanitize($input) {
    //global $database;

    if (is_array($input)) {
        foreach ($input as $var => $val) {
            $output[$var] = sanitize($val);
        }
    } else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $output = cleanInput($input);
        //$output = $database->escape($input);
    }
    return $output;
}

?>
