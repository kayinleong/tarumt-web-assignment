<?php
include "../includes/functions/db.php";
include "../includes/functions/utils.php";
include "../includes/functions/auth.php";

redirect_if_not_logged_in();

if (isset($_GET['ticket_id'])) {
	$ticket_id = $_GET['ticket_id'];

	$con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
	if ($con->connect_error) {
		die("Connection failed: " . $con->connect_error);
	}

	$sql = "SELECT * FROM tickets t
			JOIN ticket_forms tf ON t.id = tf.ticket_id
			JOIN movie_showtimes ms ON tf.movie_showtime_id = ms.id
			JOIN movies m ON ms.movie_id = m.id
			WHERE t.id = '$ticket_id'";

	$result = $con->query($sql);
	$result_data = $result->fetch_assoc();

	$seat_number = json_decode($result_data['seat_number']);
	$start_datetime = date_create($result_data['start_datetime']);
	$end_datetime = date_create($result_data['end_datetime']);

	$qrCodeData = array();
	$qrCodeData['ticket_id'] = $ticket_id;
	$qrCodeData['seat_number'] = $seat_number;
} else {
	header("Location: /assignment");
	die();
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Print Ticket - Silver Screen Club</title>
	<link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
	<?php include "../includes/styles.php"; ?>
	<link rel="stylesheet" href="/assignment/wwwroot/css/ticket.css">
	<style>
		.right {
			width: 180px;
			border-left: 0px;
		}

		.right .right-info-container {
			padding: 10px 10px 10px 10px;
		}
	</style>
</head>

<body class="overflow-hidden">
	<main class="max-w-screen max-h-screen h-screen overflow-auto scroll-smooth">
		<div class="h-screen flex items-start justify-start px-4">
			<div class="p-10 ticket">
				<div class="right">
					<div class="right-info-container">
						<div class="show-name">
							<h1>
								<?php
								echo $result_data['name'];
								?>
							</h1>
						</div>
						<div class="time">
							<p>
								<?php
								echo date_format($start_datetime, "l");
								?>
								<span>TO</span>
								<?php
								echo date_format($start_datetime, "Y");
								?>
							</p>
							<p>
								SEAT
								<?php
								$seat_number_text = implode(", ", $seat_number);
								echo $seat_number_text;
								?>
							</p>
						</div>
						<div class="barcode">
							<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo base64_url_encode(json_encode($qrCodeData)); ?>" alt="QR code">
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<?php include "../includes/scripts.php"; ?>
</body>

</html>

<?php
$con->close();
?>