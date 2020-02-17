<?php
include("shared.php");
// start the session
//session_start();

// clear out session value
if (isset($_GET['logout'])){
    $_SESSION['access'] = false;
}

// check to see if there's a form submission of user name and password
if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // validate user name and password
    // user name and password is hard-coded because client has small staff

    if ($username == "foreveryoung" && $password == "password") {
        // grant access
        $_SESSION['access'] = true;
        // redirect it to the admin page #1
        header('Location: admin_productList.php');
        exit;
    } else {
        // error message
        $message = "<p class='center'>* The username and password you provided are incorrect. Please try again!</p>";
    }
} else if (isset($_POST['username']) || isset($_POST['password'])){
    $message = "<p class='center'>* Please enter both the username and password</p>";
}else {
    $message = "<h2 class='center'>For Admin Purpose Only</h2>";
}
?>

<?php
	print $HTMLHeader;
  print $banner;
  // call the php function 'makeMenu' to generate the intelligent navigation menu. 'admin' is the value of $page
  print makeMenu('admin');
  print $SubTitle_Admin;
?>

<?= $message ?>

<form action="" method="post" class="form-login">
  <input type='text' name="username" placeholder="Username">
  <input type='text' name="password" placeholder="Password">
  <input type="submit" name="submit" value="Log in" class="btn-lg">
</form>

<?php print $PageFooter; ?>

</body>
</html>
