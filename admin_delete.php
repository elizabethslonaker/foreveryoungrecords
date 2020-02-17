<?php
include("shared.php");
//include("dbconn.inc.php"); // database connection
// make database connection
//$conn = dbConnect();

$pid = ""; // place holder for product id information

//See if a product id is available from the client side. If yes, then retrieve the info from the database based on the product id.  If not, present the form.
if (isset($_GET['pid'])) { // note that the spelling 'pid' is based on the query string variable name

	// product id available, validate the information, then compose a query accordingly to retrieve information.
	$pid = intval($_GET['pid']); // force all input into an integer.  If the input is a string or empty, it will be converted to 0.

	// validate the product id -- check to see if it is greater than 0
		if ($pid>0 ){
			//compose the query
			$sql = "DELETE from product WHERE PID = ?"; // note that the spelling "PID" is based on the field name in the database product table.

			$stmt = $conn->stmt_init();

			if ($stmt->prepare($sql)){

				$stmt->bind_param('i',$pid);

				if ($stmt->execute()){ // $stmt->execute() will return true (successful) or false
					$output = "<p class='center'>The selected record has been successfully deleted!</p><p class='center'><a href='admin_productList.php'>Return to Product List</a></p>";
				} else {
					$output = "<p>The database operation to delete the record has failed. Please try again or contact the system administrator.</p><p class='center'><a href='admin_productList.php'>Return to Product List</a></p>";
				}
			}
		} else {
			$pid = "";
			// error message
			$output = "<p>An error has occured trying to delete an exiting item. The product you selected is not recognizable. Please contact the webmaster. Thank you!</p><p class='center'><a href='admin_productList.php'>Return to Product List</a></p>";
		}
} else {
	$output = "<p class='center'>Please go to the <a href='admin_login'>admin page</a> to manage the product catalog.</p>";
}
?>

<?php
print $HTMLHeader;
print $banner;
// call the php function 'makeMenu' to generate the intelligent navigation menu. 'admin' is the value of $page
print makeMenu('admin');
print $SubTitle_Admin;
?>

<main>
    <div class="wrapper">
        <?= $output ?>
    </div>
</main>

<?php print $PageFooter; ?>

</body>
</html>
