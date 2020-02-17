<?php
include("shared.php");
//include("dbconn.inc.php"); // database connection
?>
<?php
	print $HTMLHeader;
	print $banner;
	// call the php function 'makeMenu' to generate the intelligent navigation menu. 'shop' is the value of $page
	print makeMenu('shop');
?>

<body>
	<div class="wrapper">
		<div class="flex">
			<div class="col-sm">
				<form action="" method="post" class="form-filter">
					<input type="submit" name="filter" value="APPLY FILTERS" class="btn-m"><br>

			<?php
			/*
			Radio Buttons for Filters (genre, format, quality)
				1. Genre, format, quality session variables are located in shared.php
				2. Three functions create the radio lists to filter genre, format, quality
				3. Call the function in the form input to display radio buttons
			*/
			function CategoryRadioList($selectedGID){
				$list = "";

				// combining the 3 functions below for the drop down lists: make one function and pass the variables. then make if statements for different drop down lists. if genre = selectedgenre then use this SQL statement

				foreach($_SESSION['genre'] as $GID => $GName){
						if ($GID == $selectedGID){
							$selected = "checked";
						} else {
							$selected = "";
						}
						// create an option based on the current row
						$list = $list."<input type='checkbox' value='$GID' name ='GID[]' $selected>$GName<br></input>";
					}
				//$stmt->close();
				return $list;
			}


			function FormatRadioList($selectedFID){
				$list = "";

				foreach($_SESSION['format'] as $FID => $FName) {
						if ($FID == $selectedFID){
							$selected = "checked";
						} else {
							$selected = "";
						}
						$list = $list."<input type='checkbox' value='$FID' name ='FID[]' $selected>$FName<br></input>";
					}
				//$stmt->close();
				return $list;
			}

			function QualityRadioList($selectedQID){
				$list = "";

				foreach($_SESSION['quality'] as $QID => $QName) {
						if ($QID == $selectedQID){
							$selected = "checked";
						} else {
							$selected = "";
						}
						$list = $list."<input type='checkbox' value='$QID' name ='QID[]' $selected>$QName<br></input>";
					}
				//$stmt->close();
				return $list;
			}
			?>
			<!--Shows genre, format, quality as radio lists -->
			<label><h3>Genre</h3></label><br> <?= CategoryRadioList($GID)?><br>
			<label><h3>Format</h3></label><br> <?= FormatRadioList($FID)?><br>
			<label><h3>Quality</h3></label><br> <?= QualityRadioList($QID)?>
			<br><input type="submit" name="filter" value="APPLY FILTERS" class="btn-m">

		</form>
	</div>




<?php
// Search Bar Function

$keyword = $_POST['keyword'];

if (array_key_exists('submit',$_POST)){

	  $expected = array ("keyword");
	  $required = array ("keyword");
	  $missing = array ();

		foreach($expected as $thisField) {
			$thisUserInput = $_POST[$thisField];

			if (in_array($thisField, $required) && empty($thisUserInput)) {
				array_push($missing, $thisField);
	    } else {
	      ${$thisField} = $thisUserInput;
	    }
		}

	if (empty($missing)){
		$sql = "SELECT product.PID, product.Artist, product.Title, genre.GName, format.FName, quality.QName, product.Barcode, product.Price, product.Image FROM product, genre, format, quality WHERE (product.GID_fk = genre.GID AND product.FID_fk = format.FID AND product.QID_fk = quality.QID) AND ( product.Artist LIKE '%$keyword%' OR product.Title LIKE '%$keyword%' OR product.Barcode = '$keyword') ORDER BY product.Artist ASC";

			$stmt = $conn->stmt_init();

			if ($stmt->prepare($sql)) {

			$stmt->bind_param('isssssiis', $PID, $Artist, $Title, $GName, $FName, $QName, $Barcode, $Price, $Image);

			$stmt->execute();
			$stmt->store_result();

			if (!empty($stmt->num_rows)) {

			$stmt->bind_result($PID, $Artist, $Title, $GName, $FName, $QName, $Barcode, $Price, $Image);

			echo "<div class='col-lg'>";
				echo ("<form action='' method='post' class='form-search'>
					<input type='text' name='keyword' placeholder='Search Artist, Title, or Barcode...'>
	 				<input type='submit' name='submit' value='SEARCH' class='btn-lg'>
				</form>");

			echo "<p>{$stmt->num_rows} record(s) found</p>";
			echo "<a href='shop.php'><i class='fas fa-times'></i>Clear Search</a>";

			print "<div class='flex-shop'>";

					while ($stmt->fetch()) {
						echo "
						<div class='col-xs'>
							<a href='shop_info.php?pid=$PID'><img src='upload/storage/$Image'></a>
							<h2>$Artist</h2>
							<a href='shop_info.php?pid=$PID'><h1>$Title ($FName)</h1></a>
							<h2>\$$Price</h2>
							<p>$GName | $QName</p>
							<a href='shop_info.php?pid=$PID'>Info</a> <a href='cart.php?pid=$PID' class='btn-lg btn-buy'>Buy</a>
						</div>
					";
				}
				print ("</div>"); // .flex-shop
				print ("</div>"); // .col-lg
		$stmt->close();

	} else {
		echo "<div class='col-lg'>";
		echo ("<form action='' method='post' class='form-search'>
			<input type='text' name='keyword' value='Search Artist, Title, or Barcode...'>
			<input type='submit' name='submit' value='SEARCH' class='btn-lg'>
		</form>");
		echo "<p>{$stmt->num_rows} record(s) found. Please try a different search.</p>";
		echo "<a href='shop.php'>Return to All Products</a>";
		echo "</div>"; //.col-lg
	}
		} else {
			print ("<div class='error'>Query failed</div>");
		}

		$conn->close();
	} else {
		echo  "To search, please type in one or more keywords in the search box.\n";
	}



	// If user apply filter(s)
} elseif (array_key_exists('filter',$_POST)) {

	$expected = array ('GID', 'FID', 'QID');
	$required = array ();

	$missing = array ();

	foreach($expected as $thisField) {
		$thisUserInput = $_POST[$thisField];

		if (in_array($thisField, $required) && empty($thisUserInput)) {
			array_push($missing, $thisField);
		} else {
			${$thisField} = $thisUserInput;
		}
	}

	// use session variable to define $GIDselection, $FIDselection, $QIDselection. Use implode to turn IDs from array into a string.
	$GIDarr = array_keys($_SESSION['genre']);
	$GIDselection = implode(',', $GIDarr);

	$FIDarr = array_keys($_SESSION['format']);
	$FIDselection = implode(',', $FIDarr);

	$QIDarr = array_keys($_SESSION['quality']);
	$QIDselection = implode(',', $QIDarr);

	if (!empty($GID)) { // if user filters genre
		$GIDselection = implode(",",$GID);
	}

	if (!empty($FID)) { // if user filters format
		//echo "FID is not empty";
		$FIDselection = implode(",",$FID);
	} //else {echo "FID is empty";}

	if (!empty($QID)) { // if user filters quality
		$QIDselection = implode(",",$QID);
	}

	$sql = "SELECT product.PID, product.Artist, product.Title, genre.GName, format.FName, quality.QName, product.Barcode, product.Price, product.Image FROM product, genre, format, quality WHERE (product.GID_fk = genre.GID AND product.FID_fk = format.FID AND product.QID_fk = quality.QID) AND (product.GID_fk IN ($GIDselection) AND product.FID_fk IN ($FIDselection) AND product.QID_fk IN ($QIDselection)) ORDER BY product.Artist ASC";

	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)) {

	$stmt->execute();

	$stmt->store_result();

	if (!empty($stmt->num_rows)) {

	$stmt->bind_result($PID, $Artist, $Title, $GName, $FName, $QName, $Barcode, $Price, $Image);

	echo "<div class='col-lg'>";
	echo ("<form action='' method='post' class='form-search'>
		<input type='text' name='keyword' placeholder='Search Artist, Title, or Barcode...'>
		<input type='submit' name='submit' value='SEARCH' class='btn-lg'>
	</form>");

	echo "<p>{$stmt->num_rows} record(s) found</p>";
	echo "<a href='shop.php'><i class='fas fa-times'></i>Clear Search</a>";

	print "<div class='flex-shop'>";

			while ($stmt->fetch()) {
				echo "
				<div class='col-xs'>
					<a href='shop_info.php?pid=$PID'><img src='upload/storage/$Image'></a>
					<h2>$Artist</h2>
					<a href='shop_info.php?pid=$PID'><h1>$Title ($FName)</h1></a>
					<h2>\$$Price</h2>
					<p>$GName | $QName</p>
					<a href='shop_info.php?pid=$PID'>Info</a> <a href='cart.php?pid=$PID' class='btn-lg btn-buy'>Buy</a>
				</div>
			";
		}
		print "</div>"; // .flex-shop
	echo "</div>";	// .col-lg

	$stmt->close();

	} else {
		echo "<div class='col-lg'>";
		echo ("<form action='' method='post' class='form-search'>
			<input type='text' name='keyword' placeholder='Search Artist, Title, or Barcode...'>
			<input type='submit' name='submit' value='SEARCH' class='btn-lg'>
		</form>");
		echo "<p>{$stmt->num_rows} record(s) found. Please try a different filter.</p>";
		echo "<a href='shop.php'>Return to All Products</a>";
		echo "</div>"; //.col-lg
	}
	}


// if there's no user search - upon page load
} else {
	$sql = "SELECT product.PID, product.Artist, product.Title, genre.GName, format.FName, quality.QName, product.Barcode, product.Price, product.Image FROM product, genre, format, quality WHERE product.GID_fk = genre.GID AND product.FID_fk = format.FID AND product.QID_fk = quality.QID ORDER BY product.Artist ASC";

	$stmt = $conn->stmt_init();

	if ($stmt->prepare($sql)) {

	// added bind parameters
	$stmt->bind_param('isssssiis', $PID, $Artist, $Title, $GName, $FName, $QName, $Barcode, $Price, $Image);

	$stmt->execute();

	$stmt->store_result();

	if (!empty($stmt->num_rows)) {

	$stmt->bind_result($PID, $Artist, $Title, $GName, $FName, $QName, $Barcode, $Price, $Image);

		print ("<div class='col-lg'>");
		echo ("<form action='' method='post' class='form-search'>
			<input type='text' name='keyword' placeholder='Search Artist, Title, or Barcode...'>
			<input type='submit' name='submit' value='SEARCH' class='btn-lg'>
		</form>");
		print "<div class='flex-shop'>";

				while ($stmt->fetch()) {
					echo "
							<div class='col-xs'>
								<a href='shop_info.php?pid=$PID'><img src='upload/storage/$Image'></a>
								<h2>$Artist</h2>
								<a href='shop_info.php?pid=$PID'><h1>$Title ($FName)</h1></a>
								<h2>\$$Price</h2>
								<p>$GName | $QName</p>
								<a href='shop_info.php?pid=$PID'>Info</a> <a href='cart.php?pid=$PID' class='btn-lg btn-buy'>Buy</a>
							</div>
				";
			}
			print "</div>"; // .flex-shop
		echo "</div>";	// .col-lg
$stmt->close();
}
}
}

?>

		</div> <!-- .flex -->
	</div> <!-- .wrapper -->
<?php print $PageFooter; ?>
</body>
</html>
