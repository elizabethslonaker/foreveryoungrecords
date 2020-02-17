<?php
include("shared.php");
// to show the GName instead of the GID on edit page: store genre, format, and quality in a session variable so both form and edit pages can access it. write session code on form page and recall it on edit page. make sure to include "session starts" at the beginning. Set up 3 arrays - format, genre, quality. key is ID and value is the name. on the edit page, use a foreach loop to access the 3 arrays: "session genre $GID"
//include("dbconn.inc.php"); // database connection
// make database connection
//$conn = dbConnect();

// This form is used for both adding or updating a record.
// When adding a new record, the form should be an empty one.  When editing an existing item, information of that item should be preloaded onto the form.  How do we know whether it is for adding or editing? Check whether a product id is available -- the form needs to know which item to edit.

$pid = ""; // place holder for product id information.  Set it as empty initally.  You may want to change its name to something more fitting for your application.  However, please note this variable is used in several places later in the script. You need to replace it with the new name through out the script.

// Set all values for the form as empty.  To prepare for the "adding a new item" scenario.
$Artist = "";
$Title = "";
$GID_fk = "";
$FID_fk = "";
$QID_fk = "";
$Barcode = "";
$Price = "";
$Image = "";
$Description = "";
$Tracks = "";

$errMsg = "";

// check to see if a product id available via the query string
if (isset($_GET['pid'])) { // spelling 'pid' is based on the query string variable name. When linking to this form (form.php), if a query string is attached, ex. form.php?pid=3 , then that information will be detected here and used below.

	$pid = intval($_GET['pid']); // get the integer value from $_GET['pid'] (ensure $pid contains an integer before use it for the query).  If $_GET['pid'] contains a string or is empty, intval will return zero.

	// validate the product id -- $pid should be greater than zero.
	if ($pid > 0){

		//compose a select query
		$sql = "SELECT Artist, Title, GID_fk, FID_fk, QID_fk, Barcode, Price, Image, Description, Tracks from product WHERE PID = ?"; // note that the spelling "PID" is based on the field name in my product table (database).

		$stmt = $conn->stmt_init();

		if($stmt->prepare($sql)){
			$stmt->bind_param('i',$pid);
			$stmt->execute();

			$stmt->bind_result($Artist, $Title, $GID_fk, $FID_fk, $QID_fk, $Barcode, $Price, $Image, $Description, $Tracks); // bind the five pieces of information necessary for the form.

			$stmt->store_result();

			// proceed only if a match is found -- there should be only one row returned in the result
			if($stmt->num_rows == 1){
				$stmt->fetch();
			} else {
				$errMsg = "<div class='center'>Information on the record you requested is not available.  If it is an error, please contact the webmaster. Thank you.</div>";
				$pid = ""; // reset $pid
			}
		} else {
			// reset $pid
			$pid = "";
			// error message
			$errMsg = "<div class='center'> If you are expecting to edit an exiting item, there are some error occured in the process -- the selected product is not recognizable. Please follow the link below to the product adminstration interface or contact the webmaster. Thank you.</div>";
		}
		$stmt->close();
	} // close if(is_int($pid))
}

// function to create the options for the genre drop-down list.
//  -- the value of parameter $selectedCID comes from the function call

function CategoryOptionList($selectedGID){

	$list = ""; //placeholder for the CD category option list

	global $conn;
	// retrieve category info from the database to compose a drop down list

	// combining the 3 functions below for the drop down lists: make one function and pass the variables. then make if statements for different drop down lists. if genre = selectedgenre then use this SQL statement


	$sql = "SELECT GID, GName FROM genre order by GName";

	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)){

		$stmt->execute();
		$stmt->bind_result($GID, $GName);

		while ($stmt->fetch()) {

			// set up the $_SESSION['GName'] array element
			$_SESSION['genre'][$GID] = $GName;


			if ($GID == $selectedGID){
				$selected = "Selected";
			} else {
				$selected = "";
			}
			// create an option based on the current row
			$list = $list."<option value='$GID' $selected>$GName</option>";
		}
	}
	$stmt->close();
	return $list;
}

// function to display format drop down list
function FormatOptionList($selectedFID){

	$flist = ""; //placeholder for the CD category option list

	global $conn;
	// retrieve category info from the database to compose a drop down list
	$sql = "SELECT FID, FName FROM format order by FID ASC";

	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)){

		$stmt->execute();
		$stmt->bind_result($FID, $FName);

		while ($stmt->fetch()) {

			$_SESSION['format'][$FID] = $FName;

			if ($FID == $selectedFID){
				$selected = "Selected";
			} else {
				$selected = "";
			}
			// create an option based on the current row
			$flist = $flist."<option value='$FID' $selected>$FName</option>";
		}
	}
	$stmt->close();
	return $flist;
}

// function to display quality drop down list
function QualityOptionList($selectedQID){

	$qlist = ""; //placeholder for the CD category option list

	global $conn;
	// retrieve category info from the database to compose a drop down list
	$sql = "SELECT QID, QName FROM quality order by QID";

	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)){

		$stmt->execute();
		$stmt->bind_result($QID, $QName);

		while ($stmt->fetch()) {

			$_SESSION['quality'][$QID] = $QName;

			// while going through the rows in the results, check if the category id of the current row matches the parameter ($CID) provided by the function call
			if ($QID == $selectedQID){
				$selected = "Selected";
			} else {
				$selected = "";
			}
			// create an option based on the current row
			$qlist = $qlist."<option value='$QID' $selected>$QName</option>";
		}
	}
	$stmt->close();
	return $qlist;
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
    <p><?= $errMsg ?></p>

<form action="admin_edit.php" method="POST">
<p class="center">* Required Fields</p>
	<!-- pass the pid information using a hidden field -->
	<input type="hidden" name="pid" value="<?=$pid?>">
	<table class="table-no-hover">
		<tr><th>*Artist</th><td><input type="text" name="artist" size="100%" value="<?= $Artist ?>"></td></tr>
		<tr><th>Title</th><td><input type="text" name="title" size="100%" value="<?= $Title ?>"></td></tr>
		<tr><th>Genre</th><td><select name="genre"><?= CategoryOptionList($GID)?></select></td></tr>
		<tr><th>*Format</th><td><select name="format"><?= FormatOptionList($FID)?></select></td></tr>
		<tr><th>*Quality</th><td><select name="quality"><?= QualityOptionList($QID)?></select></td></tr>
		<tr><th>Barcode</th><td><input type="text" name="barcode" size="100%" value="<?= $Barcode ?>"></td></tr>
		<tr><th>*Price</th><td><input type="text" name="price" size="20" value="<?= $Price ?>"></td></tr>
		<tr><th>Image</th><td><img src='upload/storage/<?= $Image ?>' width="120vw"/><a href='upload/upload.php?pid=<?= $pid ?>'>Change</a></td></tr>
		<tr><th>*Description</th><td><input type="text" name="description" size="100%" value="<?= $Description ?>"></td></tr>
		<tr><th>Tracks</th><td><input type="text" name="tracks" size="100%" value="<?= $Tracks ?>"></td></tr>
		<tr><td colspan=2><input type=submit name="Submit" value="Submit" class="btn-lg"></td></tr>
	</table>
</form>
</div>
</main>

<?php print $PageFooter; ?>

</body>
</html>
