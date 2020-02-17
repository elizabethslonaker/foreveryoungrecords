<?php
include("shared.php");
//include("dbconn.inc.php"); // database connection
// make database connection
//$conn = dbConnect();
?>
<?php
	print $HTMLHeader;
	print $banner;
	// call the php function 'makeMenu' to generate the intelligent navigation menu. 'admin' is the value of $page
	print makeMenu('admin');
	print $SubTitle_Admin;
	print $admin_nav;
?>

<script>
function confirmDel(Artist, pid) {
// javascript function to ask for deletion confirmation

	url = "admin_delete.php?pid="+pid;
	var agree = confirm("Delete this item: <" + Artist + "> ? ");
	if (agree) {
		// redirect to the deletion script
		location.href = url;
	}
	else {
		// do nothing
		return;
	}
}
</script>

<main>
<?php
// Retrieve the product & category info
	$sql = "SELECT PID, Artist, Title, Barcode FROM product order by Artist ASC";

	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)){

		$stmt->execute();
		$stmt->bind_result($PID, $Artist, $Title, $Barcode);

		$tblRows = "";
		while($stmt->fetch()){
			$Artist_js = htmlspecialchars($Artist, ENT_QUOTES); // convert quotation marks in the product title to html entity code.  This way, the quotation marks won't cause trouble in the javascript function call ( href='javascript:confirmDel ...' ) below.

			$tblRows = $tblRows."<tr><td>$Artist</td>
								 <td>$Title</td>
								 <td>$Barcode</td>
							     <td><a href='admin_form.php?pid=$PID'>Edit</a> | <a href='javascript:confirmDel(\"$Artist_js\",$PID)'>Delete</a> </td></tr>";
		}

		$output = "
    <table>\n
		<tr><th>Artist</th><th>Title</th><th>Barcode</th><th>Options</th></tr>\n".$tblRows.
		"</table>\n";

		$stmt->close();
	} else {

		$output = "<p class='error'>Query to retrieve product information failed.</p>";
	}
	$conn->close();
?>

<?php echo $output ?>

</main>

<?php print $PageFooter; ?>

</body>
</html>
