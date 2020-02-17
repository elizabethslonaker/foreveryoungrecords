<?php
include("shared.php");

//include("dbconn.inc.php"); // database connection

?>

<?php
	print $HTMLHeader;
	print $banner;
	// call the php function 'makeMenu' to generate the intelligent navigation menu. 'faq' is the value of $page
	print makeMenu('faq');
?>

<body>
	<div class="wrapper">
		<h1>FAQ</h1>
		<div id="accordion">
		<button class="accordion">Buying & Tradding Policies</button>
			<div class="panel">
				<p>We buy and trade CDs, Music DVDs, and cassette tapes during store hours. The exception is during the first and last half hour. Please note that it may take around a half hour for us to process these buys. <br>If you have a high volume of items, please visit us during weekdays between 12PM - 8PM. <br>Please do not leave your items with us, unless you have arranged to do so with an employee or manager.</p>
			</div>
			<button class="accordion">Vinyl Buying Hours</button>
				<div class="panel">
					<p>Monday 10am-1pm<br>Wednesday 10am-1pm<br>Friday 10am-1pm</p>
				</div>
			<button class="accordion">Buying Memorabilia Policy</button>
					<div class="panel">
						<p>We don't usually buy Autographs, as this is not our business and they're aren't easy to authenticate. However, we would be more than happy to give you our evaluation on whether we will buy or not. Please bring your best proof of authenticity.</p>
					</div>
			<button class="accordion">Do you ship items in the USA and/or overseas?</button>
				<div class="panel">
					<p>Yes! We ship all our items internationally.</p>
				</div>
			<button class="accordion">How do I place a mail order item?</button>
				<div class="panel">
					<p>We like to process all mail orders over the phone with a credit card (Visa/Mastercard only). This will guarantee your item. If you prefer to mail us a payment, let us know over the phone when placing the order. We accept personal checks and US Postal money orders.</p>
					<p>Please send mail order payments to:</p>
					<p>Forever Young Records<br>P.O. Box 535005<br>Grand Prairie, Texas 75053</p>
				</div>
			</div>
		</div>

<?php print $PageFooter; ?>

<!--FAQ Toggle is taken from a tanzTalks.tech Youtube video: https://www.youtube.com/watch?v=XfLMhmlGvEs -->

<script type="text/javascript">
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
	acc[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight){
			panel.style.maxHeight = null;
		} else {
			panel.style.maxHeight = panel.scrollHeight + "px";
		}
	});
}
</script>

</body>
</html>
