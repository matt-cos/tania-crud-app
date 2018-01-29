<?php 

session_start();

if (!isset($_SESSION['username'])):
	header('Location: login.php');
endif;

$pageName = "My Dashboard";

require "../config.php";
require "../common.php";

try {
	$connection = new PDO($dsn, $username, $password, $options);

	$username = $_SESSION['username'];

	$sql = "SELECT * FROM runs WHERE username = :username";

	$statement = $connection->prepare($sql);
	$statement->bindParam(':username', $username, PDO::PARAM_STR);
	$statement->execute();

	$result = $statement->fetchAll(PDO::FETCH_ASSOC);

	$jsonResults = json_encode($result);


}

catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}

?>

<?php include "templates/header.php"; ?>


<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
	
	<?php include "templates/layout-header.php"; ?>
	
	<?php include "templates/sidebar.php"; ?>

	<main class="mdl-layout__content mdl-color--grey-100">
		<div class="mdl-grid demo-content">
			
			<div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
				
				<svg id="visualisation" width="1000" height="500"></svg>

			</div>

			<div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
				
				<?php echo $jsonResults; ?>

			</div>

			<?php include "templates/demo-content.php"; ?>
			
			<?php include "templates/cards.php"; ?>

		</div>
	</main>
</div>

<?php include "templates/svg.php"; ?>

<script>
	// https://code.tutsplus.com/tutorials/building-a-multi-line-chart-using-d3js--cms-22935
	// var data = [{
	// 	"sale": "202",
	// 	"year": "2000"
	// }, {
	// 	"sale": "215",
	// 	"year": "2001"
	// }, {
	// 	"sale": "179",
	// 	"year": "2002"
	// }, {
	// 	"sale": "199",
	// 	"year": "2003"
	// }, {
	// 	"sale": "176",
	// 	"year": "2010"
	// }];

	// var data2 = [{
	// 	"sale": "152",
	// 	"year": "2000"
	// }, {
	// 	"sale": "189",
	// 	"year": "2002"
	// }, {
	// 	"sale": "179",
	// 	"year": "2004"
	// }, {
	// 	"sale": "199",
	// 	"year": "2006"
	// }, {
	// 	"sale": "134",
	// 	"year": "2008"
	// }, {
	// 	"sale": "176",
	// 	"year": "2010"
	// }];

	var phpData = <?php echo $jsonResults; ?>;

	// console.log(data);
	console.log(phpData);


	var vis = d3.select("#visualisation"),
	WIDTH = 1000,
	HEIGHT = 500,
	MARGINS = {
		top: 20,
		right: 20,
		bottom: 20,
		left: 50
	},

	xScale = d3.scale.linear().range([MARGINS.left, WIDTH - MARGINS.right]).domain([0,10]),
	yScale = d3.scale.linear().range([HEIGHT - MARGINS.top, MARGINS.bottom]).domain([0,10]),

	xAxis = d3.svg.axis()
		.scale(xScale),

	yAxis = d3.svg.axis()
		.scale(yScale)
		.orient("left");

	vis.append("svg:g")
		.attr("class", "axis")
		.attr("transform", "translate(0," + (HEIGHT - MARGINS.bottom) + ")")
		.call(xAxis);

	vis.append("svg:g")
		.attr("class", "axis")
		.attr("transform", "translate(" + (MARGINS.left) + ",0)")
		.call(yAxis);

	var lineGen = d3.svg.line()
		.x(function(d) {
			return xScale(d.distance);
		})
		.y(function(d) {
			return yScale(d.distance);
		})
		.interpolate("basis");

	vis.append('svg:path')
		.attr('d', lineGen(phpData))
		.attr('stroke', 'green')
		.attr('stroke-width', 2)
		.attr('fill', 'none');

	// vis.append('svg:path')
	// 	.attr('d', lineGen(data))
	// 	.attr('stroke', 'green')
	// 	.attr('stroke-width', 2)
	// 	.attr('fill', 'none');

	// vis.append('svg:path')
	// 	.attr('d', lineGen(data2))
	// 	.attr('stroke', 'blue')
	// 	.attr('stroke-width', 2)
	// 	.attr('fill', 'none');

</script>

<!-- can use wunderground API for historical weather -->
<!-- https://www.wunderground.com/weather/api/d/docs?d=data/history -->

<?php include "templates/footer.php"; ?>