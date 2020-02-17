<?php
include("shared.php");

//include("dbconn.inc.php"); // database connection

?>

<?php
	print $HTMLHeader;
	print $banner;
	// call the php function 'makeMenu' to generate the intelligent navigation menu. 'cart' is the value of $page
	print makeMenu('cart');
?>

<body>

	<!-- This is a mock-up page of the checkout success message upon a successful checkout. -->

	<div class="wrapper">
		<h1>Success! Your order was placed.</h1>
		<p class="center">The following items will be shipped to you within 5 business days.</p>
		<table class="table-checkout-success table-no-hover">
			<tr><th>Product(s)</th><th></th><th>Quantity</th><th>Price</th></tr>
			<tr>
				<td><img src="images/cc.png" alt="C+C Music Factory" width="100vw"></td>
				<td>C+C Music Factory - <br>Gonna Make You Sweat Vinyl LP New</td>
				<td><input type="number" name="quantity" value ="1" min="1" max="10"></td>
				<td>$49.98</td>
			</tr>
			<tr><td colspan=2></td><td>Shipping: </td><td>$11.00</td></tr>
			<tr><td colspan=2></td><th>Total: </th><th>$60.98</th></tr>
		</table>
		<p class="center">Your tracking number is 76827493. To check your order status, please go to the <a href="#">Order Tracking Page.</a></p>
	</div>

<?php print $PageFooter; ?>

</body>
</html>
