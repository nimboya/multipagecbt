<?php require_once('Connections/connect.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['studentname'])) {
  $loginUsername=$_POST['studentname'];
  $password=$_POST['studentid'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "ExamList.php";
  $MM_redirectLoginFailed = "studentLogin.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connect, $connect);
  
  $LoginRS__query=sprintf("SELECT email, studentId FROM studentreg WHERE email=%s AND studentId=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connect) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Login</title>
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<style type="text/css">
body {
	margin-right: 0px;
	margin-bottom: 20px;
}
</style>
</head>

<body>
<p>&nbsp;</p>

<div id="wrapper" class="container">
<section class="navbar main-menu">
				<div class="navbar-inner main-menu">
                 <img src="images/logo.jpg" alt="logo" width="1078" height="89" /></div>
  </section>
<div align="right">
  <h5><a href="index.php">Staff Login</a></h5></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
			<table width="1035" height="251" border="0" align="center">
			  
			    <tr>
			      <td width="561" align="center" class="navbar navbar-form"><form action="<?php echo $loginFormAction; ?>" id="login" name="login" method="POST">
			      <p>&nbsp;</p>
			      <p>&nbsp;</p>
			      <h4><strong>Student Login</strong></h4>
			      <table width="413" border="0" cellpadding="3" cellspacing="3">
			        <tr>
			          <td class="form-horizontal">Email Address:</td>
			          <td><input name="studentname" type="text" class="input-xlarge" id="username1" /></td>
		            </tr>
			        <tr>
			          <td>StudentId:</td>
			          <td><input name="studentid" type="text" class="input-xlarge" id="password1" /></td>
		            </tr>
			        <tr>
			          <td>&nbsp;</td>
			          <td><input name="login" type="submit" class="btn btn-large btn-success" id="login" value="Login" /></td>
		            </tr>
		          </table>
			      </form>
			      <h3>&nbsp;</h3></td>
			      <td width="561" align="center">
                  <iframe align="right" width="400" height="300" scrolling="no" frameborder="0" src="images/index.jpg"></iframe>
                  </td>
	          </tr>
</table>
			<p>&nbsp;</p>
            



