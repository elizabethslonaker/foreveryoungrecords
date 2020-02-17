<?php
	include ("shared.php");
//include("dbconn.inc.php"); // database connection
?>

<?php
	print $HTMLHeader;
	print $banner;
	// call the php function 'makeMenu' to generate the intelligent navigation menu. 'cart' is the value of $page
	print makeMenu('cart');
?>

<body>
	<!-- This is a mock-up page of the checkout feature. -->
	<div class="wrapper">
		<h1>Checkout</h1>
		<div class="flex">
			<div class="col-sm">
				<table class="table-checkout table-no-hover">
					<tr colspan="2"><td><h2>Cart</h2></td></tr>
					<tr><td colspan="2">C+C Music Factory - <br>Gonna Make You Sweat Vinyl LP New</td></tr>
					<tr><td><img src="images/cc.png" alt="C+C Music Factory"></td> <td>(1) $49.98</td></tr>
					<tr><th>Shipping</th> <td>$11.00</td></tr>
					<tr><th>Total</th> <th>$60.98</th></tr>
				</table>
			</div>

			<div class="col-lg">
				<div class="inline">
					<div class="col-2">
						<h3>Contact Details</h3>
						<form class="form-billing" action="checkout_script.php" method="post" id="form">
							<div class="inline">
								<div class="form-row">
									<label>First Name</label>
									<input type="text" name="firstName">
								</div>
								<div class="form-row">
									<label>Last Name</label>
									<input type="text" name="lastName" class="form-row-2">
								</div>
							</div>
							<label>Address</label><br>
							<input type="text" name="address"><br>
							<div class="inline">
								<div class="form-row">
									<label>City</label><br>
									<input type="text" name="city"><br>
								</div>
								<div class="form-row">
									<label>State</label>
									<input type="text" name="state">
								</div>
								<div class="form-row">
									<label>Zip</label><br>
									<input type="text" name="zip" class="form-row-2">
								</div>
							</div>
						</form>

						<h3>Billing Details</h3>
						<form class="form-billing" action="checkout_script.php" method="post" id="form">
							<label>Cardholder Name</label>
							<input type="text" name="ccn"><br>

							<div class="inline">
								<div class="form-row">
									<label>Card Type</label>
									<input type="text" name="cct"><br>
								</div>
								<div class="form-row">
									<label>Card Number</label>
									<input type="text" name="ccn"><br>
								</div>
							</div>
							<div class="inline">
								<div class="form-row">
									<label>CVV</label>
									<input type="text" name="ccv"><br>
								</div>
								<div class="form-row">
									<label>Expiration Date</label>
									<input type="text" name="cce" class="form-row-2">
								</div>
							</div>
						</form>
						<a href="checkout_success.php"><input type='button' name='purchase' value='Purchase' class="btn-lg"></a>
					</div>
			</div>
		</div>
	</div>
</div>

<?php print $PageFooter; ?>

</body>
</html>
