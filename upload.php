<?php
include("../shared.php");
//include("../dbconn.inc.php"); // database connection
?>

<!DOCTYPE html>
<html>
<head>
	<title>Forever Young Records</title>
	<link rel='stylesheet' href='../CSS/styles.css' type='text/css'>
	<script src='https://kit.fontawesome.com/f3697dc76e.js' crossorigin='anonymous'></script>
</head>
<body>
	<div class='banner'>
		<p>This is a redesign concept by <a href='http://www.elizabethslonaker.co' target='_blank'> Elizabeth Slonaker</a> for a university course project. All trademarks are the property of their respective owners.</p>
	</div>
  <nav>
  	<ul>
  		<li><a href='shop.php'><img src='../images/logo.png' class='logo' alt='Forever Young Records Logo'/></a></li>
			<li><a href='../home.php'>Home</a></li>
			<li><a href='../shop.php'>Shop</a></li>
  		<li><a href='../about.php'>About</a></li>
  		<li><a href='../faq.php'>FAQ</a></li>
  		<li><a href='../cart.php'>Cart</a></li>
  		<li><a href='../admin_login.php' class='menu_highlight'><i class='fas fa-unlock-alt'></i>Admin</a></li>
  	</ul>
  </nav>

  <div class="wrapper">
  <h1>Product Catalog Management</h1>
  <p class='center'>Use this form to upload a product image.</p>
<?php

//$conn = dbConnect(); // database connection
// place script OUTSIDE storage folder on utacloud

// supress the error/warning message.  Disable it to begin with so you see the error message provided by the php engine
error_reporting(0);

if (array_key_exists('upload', $_POST)) {


  // define constant for upload folder
  /* Constant is similar to variable. it's a placeholder for a value but you can only define a constant once! You can't change its vaule, like you can with variables! */

  // Pathway is not the regular web url. It's the physical path for that particular machine. On a pc you would start with c drive... The physical path to the upload folder is taken from the file structure off of utacloud.

  /* Public_html is a web route folder: whether it's public or pirvate depends on if you want the content uploaded to be public or pirvate. */
  define('UPLOAD_DIR', '/home/egsutacl/ctec4321.egs3925.uta.cloud/fyr/upload/storage/');

  // move the file from the temporary location ($_FILES) to the permanent location (upload folder) and rename it

  // UPLOAD_DIR stands for upload directory and is the constant. constants don't have dollar signs

  // 'tmp_name' DOES NOT change. 'image' is whatever the name of the form field is.

  // UPLOAD_DIR is the folder, $_FILES ['image']['name'] is the name of the file and the '.' links the two together

  // Get rid of spaces in file name and replace with underscore. Use string replace and the current file name

  //$newFileName = substr_replace(...)$_FILES['image']['name'];

//str_replace function changes any spaces to an underscore. Store the file name under the new variable $newFileName. Make sure to change the name in the if statement below.
  $newFileName = str_replace(' ', '_', $_FILES['image']['name']);

  //allow only certain types of files to be uploaded
  $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_TIFF_II, IMAGETYPE_TIFF_MM);

  $detectedType = exif_imagetype($_FILES['image']['tmp_name']);

  if (!in_array($detectedType, $allowedTypes)) {
      echo "<p class='error'> We're sorry, but the file does not use an accepted file format. Please upload a png, jpeg, gif, or tiff file.</p>";
  } elseif (move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_DIR.$newFileName)){

    echo "The file was successfully uploaded!";
      // upload successful

      if (isset($_GET['pid'])){
        $pid = intval($_GET['pid']);
          // must change the database: update $newFileName
          $stmt = $conn->stmt_init();

          $sql = "UPDATE product SET Image = '$newFileName' WHERE PID = ?";

          if($stmt->prepare($sql)){

            $stmt->bind_param('i', $pid);
    				$stmt_prepared = 1;
          }

          if ($stmt_prepared == 1){
      			if ($stmt->execute()){
      				$message = "Please click the back arrows to return to the edit form.<br><br><a href='../admin_productList.php'>Return to Product List</a>";
            }
          } else {
          // something is wrong
          $message = "<div class='error'>Please try again later or contact the web master. </div>";
          }
        }
    } else {
      $message = "<div class='error'>We have encountered issues in uploading this file.  Please try again later or contact the web master.</div>";
    }
}
?>

<div style="margin: 1em;"><?=$message?></div>

<form action="" method="post" enctype="multipart/form-data" name="uploadImage" id="uploadImage">
  <input type="file" name="image" id="image" />
  <input type="submit" name="upload" id="upload" value="Upload" class="btn-lg"/>
</form>
</div>

<pre>
<?php

//info about the uploaded files is stored in super global variable $_FILES
// for debugging purpose
/*if (array_key_exists('upload', $_POST)) {
  print_r($_FILES);
}*/
?>
</pre>

<footer>
	<div class='strip-1'></div>
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
			<a href='home.php'>Home</a><br>
			<a href='shop.php'>Shop</a><br>
			<a href='about.php'>About</a><br>
			<a href='faq.php'>FAQ</a><br>
			<a href='cart.php'>Cart</a><br>
			<a href='admin_login.php'>Admin Login</a>
		</div>
	</div>
</footer>

</body>
</html>
