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
	<div class="wrapper">
		<h1>Your Shopping Cart</h1>
		<form action="checkout.php" method="post" class="form-cart">
			<table class="table-no-hover">
				<tr><th>Product(s)</th><th></th><th>Quantity</th><th>Price</th></tr>
				<tr>
					<td><img src="images/cc.png" alt="C+C Music Factory" width="100vw"></td>
					<td>C+C Music Factory - <br>Gonna Make You Sweat Vinyl LP New</td>
					<td><input type="number" name="quantity" value ="1" min="1" max="10"></td>
					<td>$49.98</td>
				</tr>
				<tr><td colspan=2></td><td>Shipping: </td><td>$11.00</td></tr>
				<tr><td colspan=2></td><th>Total: </th><th>$60.98</th></tr>
				<tr><td colspan=3></td><td><a href='checkout.php'><input type='button' name='checkout' value='Checkout' class="btn-lg"></a></td></tr>
			</table>
		</form>

	<!-- Toggle accodion -->
		<div id="accordion">
			<button class='accordion'>Shipping Options</button>
				<div class='panel'>
					<ul>
						<li>Pick up from our store</li>
						<li>1 LP, 12', or 10' Shipped priority mail in the USA $11.00, $1.00 for each additional</li>
						<li>1 LP, 12', or 10' Shipped media mail in the USA $6.00, $1.00 for each additional</li>
						<li>1 CD, DVD, Cassette, 45, or T-Shirt Shipped priority mail within the USA - $10.00, $1.00 each additional</li>
						<li>1 CD, DVD, Cassette, 45, or T-Shirt Shipped media mail within the USA - $5.00, $1.00 each additional</li>
						<li>1 LP, 12', or 10' Shipped Air Mail to Canada or Mexico $20.00, $10.00 each additional</li>
						<li>1 LP, 12', or 10' Shipped Air Mail to Rest Of The World $25.00, $10.00 each additional</li>
						<li>1 CD, DVD, Cassette, 45, or T-Shirt Shipped Air Mail to Canada or Mexico $15.00, $5.00 each additional</li>
						<li>1 CD, DVD, Cassette, 45, or T-Shirt Shipped Air Mail to Rest Of The World $17.00, $5.00 each additional We strive to offer our customers a high level of expertise and quality treating each buyer with respect and appreciation.</li>
					</ul>
				</div>
			<button class='accordion'>Return Policy</button>
				<div class='panel'>
					<p>If your order is lost, stolen or never arrives we cannot be held responsible and recommend adding the surcharge for registration or insurance.</p>
					<p>If your order is damaged in transit we will replace the order or refund your money 100% upon confirmation of the damaged goods, we package well.</p>
					<p>We accept returns in the same condition we sent them to you. Buyer pays all return shipping costs and a small restocking fee will be applied for buyers who change their mind.</p>
					<p>If we make a mistake we will pay all return shipping costs and correct the order or refund you.</p>
				</div>
			<button class='accordion'>Product Grading - Goldmine Grading Standard</button>
				<div class='panel'>
					<h4>Mint [M]</h4>
						<p>Vinyl: Absolutely perfect in every way - certainly never played, possibly even still sealed. (More on still sealed below). Should be used sparingly as a grade, if at all.</p>
						<p>CD: Perfect. No scuffs/scratches, unplayed - possibly still sealed. Insert/Inlay/Booklet/Sleeve/Digipak: Perfect. No wear, marks, or any other imperfections - possibly still sealed.</p>
					<h4>Near Mint [NM or M-]</h4>
						<p>Vinyl: A nearly perfect record. Many dealers won't give a grade higher than this implying (perhaps correctly) that no record is ever truly perfect. The record shows no obvious sign of wear. A 45 rpm sleeve has no more than the most minor defects, such as almost invisible ring wear or other signs of slight handling. An LP jacket has no creases, folds, seam splits or any other noticeable similar defect. No cut-out holes, either. And of course, the same is true of any other inserts, such as posters, lyric sleeves, and the like. Basically, Near Mint looks as if you just got it home from a new record store and removed the shrink wrap.</p>
						<p>CD: Near perfect. No obvious signs of use, it may have been played - but it has been handled very carefully. Insert/Inlay/Booklet/Sleeve/Digipak: Near Perfect. No obvious wear, it may have only the slightest of marks from handling.</p>
					<h4>Very Good Plus [VG+]</h4>
						<p>Vinyl: Shows some signs that it was played and otherwise handled by a previous owner who took good care of it. Record surfaces may show some slight signs of wear and may have slight scuffs or very light scratches that don't affect one's listening experience. Slight warps that do not affect the sound are OK. The label may have some ring wear or discoloration, but is should be barely noticeable. The center hole is not misshapen by repeated play. Picture sleeves and LP inner sleeves will have some slight wear, lightly turn-up corners, or a slight seam-split. An LP jacket my have slight signs of wear also and may be marred by a cut-out hole, indentation or corner indicating it was taken out of print and sold at a discount. In general, if not for a couple of minor things wrong with it, this would be Near Mint. All but the most mint-crazy collectors will find a Very Good Plus record highly acceptable.</p>
						<p>CD: A few minor scuffs/scratches. This has been played, but handled with good care - and certainly not abused. Insert/Inlay/Booklet/Sleeve/Digipak: Slight wear, marks, indentations, it may possibly have a cut-out hole (or similar).</p>
					<h4>Very Good [VG]</h4>
						<p>Vinyl: Many of the defects found in a VG+ record are more pronounced in a VG disc. Surface noise is evident upon playing, especially in soft passages and during the song's intro and fade, but will not overpower the music otherwise. Groove wear will start to be noticeable, as will light scratches deep enough to feel with a fingernail) that will affect the sound. Labels may be marred by writing, or have tape or stickers (or their residue) attached. The same will be true of picture sleeves or LP covers. However, it will not have all of these problems at the same time, only two or three of them.</p>
						<p>CD: Quite a few light scuffs/scratches, or several more-pronounced scratches. This has obviously been played, but not handled as carefully as a VG+. Insert/Inlay/Booklet/Sleeve/Digipak: More wear, marks, indentations than a VG+. May have slight fading, a small tear/rip, or some writing.</p>
					<h4>Good [G], Good Plus [G+]</h4>
						<p>Vinyl: Good does not mean bad! A record in Good or Good Plus condition can be put onto a turntable and will play through without skipping. But it will have significant surface noise and scratches and visible groove wear. A jacket or sleeve has seam splits, especially at the bottom or on the spine. Tape, writing, ring wear or other defects will start to overwhelm the object. If it's a common item, you'll probably find another copy in better shape eventually. Pass it up. But if it's something you have been seeking for years, and the price is right, get it.</p>
						<p>CD: There are a lot of scuffs/scratches. However it will still play through without problems. This has not been handled with much care at all. Insert/Inlay/Booklet/Sleeve/Digipak: Well worn, marked, more obvious indentations, fading, writing, than a VG - possibly a more significant tear/rip</p>
					<h4>Poor [P], Fair [F]:</h4>
						<p>Vinyl: The record is cracked, badly warped, and won't play through without skipping or repeating. The picture sleeve is water damaged, split on all three seams and heavily marred by wear and/or writing. The LP jacket barely keeps the LP inside it. Inner sleeves are fully seam split, and written upon. Except for impossibly rare records otherwise unattainable, records in this condition should be bought or sold for no more than a few cents each.</p>
						<p>CD: The CD (if it is included) may or may not play some or all of the tracks. See the seller's comments for details. Insert/Inlay/Booklet/Sleeve/Digipak: Very worn. It may have obvious writing on it, it may be ripped/torn, or significantly faded, or water damaged.</p>
						<p>Standard Jewel Cases: Standard Jewel Cases are not graded as they are replaceable.</p>
				</div>
		</div>
	</div>

<?php print $PageFooter; ?>

<!--FAQ Toggle is adapted from a tanzTalks.tech Youtube video: https://www.youtube.com/watch?v=XfLMhmlGvEs -->
<script type='text/javascript'>
var acc = document.getElementsByClassName('accordion');
var i;

for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener('click', function() {
		this.classList.toggle('active');
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight){
			panel.style.maxHeight = null;
		} else {
			panel.style.maxHeight = panel.scrollHeight + 'px';
		}
	});
}
</script>

</body>
</html>
