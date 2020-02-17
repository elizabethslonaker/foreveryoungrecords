<?php
include("shared.php");
//session_start();
//include("dbconn.inc.php"); // database connection
// make database connection
//$conn = dbConnect();

// If there's a submission
if (isset($_POST['Submit'])) {

	//validate user input
	$required = array("artist", "format", "quality", "price", "description"); // spelling matches form field names
	$expected = array("artist", "title", "genre", "format", "quality", "barcode", "price", "image", "description", "tracks", "pid");
  // set up label array, field name is key and label is value
  $label = array ('artist'=>'Artist', "title"=>'Title', "genre"=>'Genre', 'format'=>'Format', "quality"=>'Quality', "barcode"=>'Barcode', 'price'=>'Price', "image"=>'Image', "description"=>'Description', "tracks"=>'Tracks', "pid"=>'Product ID');
	$missing = array();

	foreach ($expected as $field){

		if (in_array($field, $required) && (!isset($_POST[$field]) || empty($_POST[$field]))) {
			array_push ($missing, $field);

		} else {
			// Passed the required field test, set up a variable to carry the user input.
			// Note the variable set up here uses the $field value as the veriable name. Notice the syntax ${$field}.  This is a "variable variable". For example, the first $field in the foreach loop here is "title" (the first one in the $expected array) and a $title variable will be created.  The value of this variable will be either "" or $_POST["title"] depending on whether $_POST["title"] is set up.
            // once we run through the whole $expected array, then these variables, $title, $artist, $price, $categoryID, $pDtail, and $pid, will be generated.

			if (!isset($_POST[$field])) {
				//$_POST[$field] is not set, set the value as ""
				${$field} = "";
			} else {

				${$field} = $_POST[$field];
			}
		}
	}

	//print_r ($missing); // for debugging purpose

	/* proceed only if there is no required fields missing and all other data validation rules are satisfied */
	if (empty($missing)){

		//========================
		// processing user input

		$stmt = $conn->stmt_init();

		// compose a query: Insert or Update? Depending on whether there is a $pid.

		if ($pid != "") {
			/* there is an existing pid ==> need to deall with an existing reocrd ==> use an update query */

			// Ensure $pid contains an integer.
			$pid = intval($pid);

			$sql = "Update product SET Artist = ?, Title = ?, GID_fk = ?, FID_fk = ?, QID_fk = ?, Barcode = ?, Price = ?, Image = ?, Description = ?, Tracks = ? WHERE PID = ?";

			if($stmt->prepare($sql)){

				// Note: user input could be an array, the code to deal with array values should be added before the bind_param statment.

				//'ssii' stands for the type of data so string, string, integer, integer
				$stmt->bind_param('ssiiiidsssi', $artist,
				$title, $genre, $format, $quality, $barcode, $price, $image, $description, $tracks, $pid);
				$stmt_prepared = 1;// set up a variable to signal that the query statement is successfully prepared.
			}

		} else {
			// no existing pid ==> this means no existing record to deal with, then it must be a new record ==> use an insert query
			$sql = "Insert Into product (Artist, Title, GID_fk, FID_fk, QID_fk, Barcode, Price, Image, Description, Tracks) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			if($stmt->prepare($sql)){

				// Note: user input could be an array, the code to deal with array values should be added before the bind_param statment.

				$stmt->bind_param('ssiiiidsss',$artist,
				$title, $genre, $format, $quality, $barcode, $price, $image, $description, $tracks);
				$stmt_prepared = 1; // set up a variable to signal that the query statement is successfully prepared.
			}
		}

		if ($stmt_prepared == 1){
			if ($stmt->execute()){
				$output = "<p>Success! The following product information has been saved in the database.</p>";
				foreach($expected as $key){
					$value = $_POST[$key];

					if ($key=='genre'||$key=="format"||$key=="quality"){

						$value = $_SESSION[$key][$_POST[$key]];
						}
					$output .= "<div><b>{$label[$key]}</b>: $value <br></div>";
				}
				$output .= "<p class='center'><a href='admin_productList.php'>Return to Product List</a></p>";
			} else {
				//$stmt->execute() failed.
				$output = "<p class='center'>Database operation failed. Please contact the webmaster.</p>";
			}
		} else {
			// statement is not successfully prepared (issues with the query).
			$output = "<p class='center>Database query failed. Please contact the webmaster.</p>";
		}
	} else {
		// $missing is not empty
		$output = "<p>The following required fields are missing in your form submission. Please fill them out. Thank you! \n<ul>\n";
		foreach($missing as $m){
			$output .= "<li>{$label[$m]}\n";
		}
		$output .= "</ul></p>\n";
	}
} else {
	$output = "<p class='center'>Please begin your product managment operation from the <a href='admin_productList.php'>admin page</a>.</p>";
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
    <div class='wrapper'>
        <?= $output ?>
    </div>
</main>

<?php print $PageFooter; ?>

</body>
</html>
