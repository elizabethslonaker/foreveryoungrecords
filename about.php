<?php
include("shared.php");
//include("dbconn.inc.php"); // database connection
?>
<?php
	print $HTMLHeader;
	print $banner;
	// call the php function 'makeMenu' to generate the intelligent navigation menu. 'about' is the value of $page
	print makeMenu('about');
?>

<body>
	<div class="wrapper about">
		<h1>Our History</h1>
		<div class="flex">
			<div class="col">
				<img src="images/building-sq.png" alt="Forever Young Records - Outside of Building">
			</div>
			<div class="col">
				<p>Forever Young Records is a family owned and operated record store in the DFW metroplex. Opened in 1984, our goal is to house a large selection of music at reasonable costs. We are settled in a large 11,000 square foot building located in Grand Prairie Texas, 30 minutes west of downtown Dallas. As one of the few independent record stores still in business in the DFW area, Forever Young has managed to expand not only the size of the store, but the store inventory as well. We carry your hot new releases as well as classic Vinyl from the age of the 30's and 40's!</p>
			</div>
		</div>

		<h1>Our Records</h1>
		<div class="flex">
			<div class="col">
				<img src="images/records-1-sq.jpg" alt="Inside Forever Young Records Store">
				<img src="images/records-2-sq.jpg" alt="Inside Forever Young Records Store" style="margin-top:1em;">
			</div>
			<div class="col">
				<p>250,000 New & Used Items<br> CDS, LPs, Cassettes, 45s, Music posters, Reel to Reel Tapes, DVDs, and many original unique music memorabilia <br> Punk, Pop, Metal, Classic Rock, Jazz, Country, Reggae, African, Latino, Soundtracks, Easy Listening, Techno, and more (not including most foreign languages, classical, or karaoke)</p>
				<p>Original music memorabilia from the 1950's, 1960’s and 1970’s Pop Culture era<br> Large selection of specialty items: RIAA Gold & Platinum Record Awards, Limited Edition LP & CD Box Sets, a selection of Beatle Mania memorabilia, Posters, Promotional Items, magazines and many music books such as Record Collectors Guide and special limited edition collectors books</p>
			</div>
		</div>

		<h1>Our Press</h1>
		<div class="flex">
			<div class="col">
				<img src="images/building-2-sq.jpg" alt="Inside Forever Young Records Store" /><br>
				<p class="caption">Taylor Eckstrom (left) and owner David Eckstrom stand in front of Forever Young Records in Grand Prairie, Texas.</p>
			</div>
			<div class="col">
					<p><a href="http://voyagedallas.com/interview/meet-david-eckstrom-forever-young-records-south-grand-prairie/" target="_blank">Voyage Dallas: Meet David Eckstrom of Forever Young Records</a></p>
					<p><a href="http://www.texasmonthly.com/the-daily-post/379386/" target="_blank">Texas Monthly: For Sale: One of the World’s Rarest Bob Dylan Albums</a></p>
					<p><a href="http://dfw.cbslocal.com/2015/04/21/forever-young-records/" target="_blank">CBS Local: Forever Young Records</a></p>
					<p><a href="http://www.goldminemag.com/collector-resources/for-the-record-forever-young-records" target="_blank">Gold Mine Mag: For the Record: Forever Young Records</a></p>
					<p><a href="https://www.youtube.com/watch?v=TwTwD0rqGag" target="_blank">Youtube: </a></p>
					<p><a href="http://www.dallasobserver.com/music/shop-till-you-bop-at-forever-young-records-6375345" target="_blank">Dallas Observer: Shop Till You Bop at Forever Young Records</a></p>
					<p><a href="http://www.nbcdfw.com/the-scene/shopping/In-a-Digital-World-Forever-Young-Keeps-Analog-For-Sale-89401647.html" target="_blank">NBCDFW: In a Digital World, Forever Young Keeps Analog For Sale</a></p>
			</div>
		</div>
	</div>

<?php print $PageFooter; ?>

</body>
</html>
