<?php
// shared.php stores shared information that will be on EVERY page (headers, menu, footer, etc.)

// Session variable will automatically start on every page. Do NOT include on other pages.
// Session variable stores genre, format, and quality in session variables to create dropdown lists
session_start();

// database connection - don't need this on other pages
include("dbconn.inc.php");

// make database connection - don't need this on other pages
$conn = dbConnect();

/*
1. Create session variables for genre, format, and quality, using if statements. "If the session variable is empty, meaning there's no user selection, call the function."
2. The functions will turn the ID's (GID, FID, and QID) into the names (GName, FName, and QName). This solves the problem where it was displaying "Genre: 1" to the user, instead of "Genre: Pop"
*/
if (!isset($_SESSION['genre'])){
	$_SESSION['genre'] = array();
	// call the function to build the array for Genre
	GenreArr();
}
if (!isset($_SESSION['format'])){
	$_SESSION['format'] = array();
	// call the function to build the array for Format
	FormatArr();
}
if (!isset($_SESSION['quality'])){
	$_SESSION['quality'] = array();
	// call the function to build the array for Quality
	QualityArr();
}

// This is the code to create the functions that converts ID's into the names (Pop, Cassett, Mint, for example)
function GenreArr(){

	global $conn;

	// combining the 3 functions below for the drop down lists: make one function and pass the variables. then make if statements for different drop down lists. if genre = selectedgenre then use this SQL statement

	// retrieve category info from the database to compose a drop down list
	$sql = "SELECT GID, GName FROM genre order by GName";

	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)){

		$stmt->execute();
		$stmt->bind_result($GID, $GName);

		while ($stmt->fetch()) {

			// set up the $_SESSION['GName'] array element
			$_SESSION['genre'][$GID] = $GName;
		}
	}
	$stmt->close();
}

function FormatArr(){

	global $conn;

	// retrieve category info from the database to compose a drop down list
	$sql = "SELECT FID, FName FROM format order by FName";

	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)){

		$stmt->execute();
		$stmt->bind_result($FID, $FName);

		while ($stmt->fetch()) {

			// set up the $_SESSION['GName'] array element
			$_SESSION['format'][$FID] = $FName;
		}
	}
	$stmt->close();
}

function QualityArr(){

	global $conn;

	// retrieve category info from the database to compose a drop down list
	$sql = "SELECT QID, QName FROM quality order by QName";

	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)){

		$stmt->execute();
		$stmt->bind_result($QID, $QName);

		while ($stmt->fetch()) {

			// set up the $_SESSION['GName'] array element
			$_SESSION['quality'][$QID] = $QName;
		}
	}
	$stmt->close();
}

// HTML Header
$HTMLHeader =
"<!DOCTYPE html>
<html>
<head>
	<title>Forever Young Records</title>
	<link rel='stylesheet' href='CSS/styles.css' type='text/css'>
	<script src='https://kit.fontawesome.com/f3697dc76e.js' crossorigin='anonymous'></script>
</head>
";

// Banner
$banner = "
<div class='banner'>
	<p>Redesign concept by <a href='http://www.elizabethslonaker.co' target='_blank'> Elizabeth Slonaker</a> for a university course project</p>
</div>
";

// Intelligent Menu - Highlights Current Page
function makeMenu ($page) {

	// set all CSS classes as a default value
	$class2 = $class3 = $class4 = $class5 = $class6 = "menu";

	// Use multiple else if statements to selectively highlight one of the pages
	if ($page == "shop") {
		$class2 = "menu_highlight";
	} else if ($page == "about") {
		$class3 = "menu_highlight";
	} else if ($page == "faq") {
		$class4 = "menu_highlight";
	} else if ($page == "cart") {
		$class5 = "menu_highlight";
	} else if ($page == "admin") {
		$class6 = "menu_highlight";
	}

	$menu = "
	<nav>
		<ul>
			<li><a href='shop.php'><img src='images/logo.png' class='logo' alt='Forever Young Records Logo'/></a></li>
			<li><a href='shop.php' class='$class2'>Shop</a></li>
			<li><a href='about.php' class='$class3'>About</a></li>
			<li><a href='faq.php' class='$class4'>FAQ</a></li>
			<li><a href='cart.php' class='$class5'><i class='fas fa-shopping-cart'></i>Cart</a></li>
			<li><a href='admin_login.php' class='$class6'><i class='fas fa-unlock-alt'></i>Admin</a></li>
		</ul>
	</nav>
	";
	return $menu;
}

// Admin Page Title
$SubTitle_Admin = "<h1>Product Catalog Management</h1>";

// Admin Page Navigation
$admin_nav = "
<nav id='admin-nav'>
  <ul>
		<li><a href='admin_form.php'> + Add New Product</a></li>
    <li><a href='admin_login.php?logout'>Log out</a></li>
  </ul>
</nav>
";

// Footer
$PageFooter = "
<footer>
	<div class='footer'>
		<div class='col'>
			<h2>Visit</h2>
			<p>Forever Young Records<br>2955 TX-360,<br>Grand Prairie, TX 75052<br><a href='tel:9723526299' class='phone'>(972) 352 - 6299</a></p>
		</div>
		<div class='col'>
			<h2>Hours</h2>
			<p>Monday - Thursday<br>10AM - 8PM</p>
			<p>Friday - Saturday<br>10AM - 9PM</p>
			<p>Sunday<br>12PM - 6PM</p>
		</div>
		<div class='col'>
			<h2>Social</h2>
			<a href='https://www.facebook.com/ForeverYoungRecords?fref=ts' target='_blank'>Facebook</a><br>
			<a href='https://twitter.com/ForeverYoungTX' target='_blank'>Twitter</a><br>
			<a href='https://www.instagram.com/foreveryoungvinyl/' target='_blank'>Instagram</a><br>
			<a href='https://www.youtube.com/channel/UC0_i_ggRHvjTNFIObgpNz-w' target='_blank'>Youtube</a>
		</div>
		<div class='col'>
			<h2>Sitemap</h2>
			<a href='shop.php'>Shop</a><br>
			<a href='about.php'>About</a><br>
			<a href='faq.php'>FAQ</a><br>
			<a href='cart.php'>Cart</a><br>
			<a href='admin_login.php'>Admin Login</a>
		</div>
	</div>
</footer>
";
?>
