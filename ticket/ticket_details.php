<?php
include "../includes/functions/db.php";
include "../includes/enum.php";
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
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ticket - Silver Screen Club</title>
	<link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
	<?php include "../includes/styles.php"; ?>
	<link rel="stylesheet" href="/assignment/wwwroot/css/ticket.css">
	<style>
		.image {
			height: 250px;
			width: 250px;
			background-image: url("/assignment/wwwroot/images/movies/<?php echo $result_data['pic_url'] ?>");
			background-size: contain;
			opacity: 0.85;
		}
	</style>
</head>

<body class="overflow-hidden">
	<?php include "../includes/header.php"; ?>

	<main class="max-w-screen max-h-screen h-screen overflow-auto scroll-smooth">
		<div class="h-screen flex items-center justify-center container mx-auto px-4">
			<div class="p-5 ticket">
				<div class="left">
					<div class="image">
					</div>
					<div class="ticket-info">
						<p class="date">
							<span>
								<?php
								echo date_format($start_datetime, "l");
								?>
							</span>
							<span class="june-29">
								<?php
								echo date_format($start_datetime, "F jS");
								?>
							</span>
							<span>
								<?php
								echo date_format($start_datetime, "Y");
								?>
							</span>
						</p>
						<div class="show-name">
							<h1>
								<?php
								echo $result_data['name'];
								?>
							</h1>
							<h2></h2>
						</div>
						<div class="time">
							<p>
								<?php
								echo date_format($start_datetime, "g:i A");
								?>
								<span>TO</span>
								<?php
								echo date_format($end_datetime, "g:i A");
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
						<p class="location">
							<span>Silver Screen Club</span>
							<span class="mx-2">|</span>
							<span>
								<?php
								switch ($result_data['campus']) {
									case 'KL':
										echo "Kuala Lumpur Main Campus";
										break;

									case 'PG':
										echo 'Penang Brunch Campus';
										break;

									case 'PK':
										echo 'Perak Brunch Campus';
										break;

									case 'JH':
										echo 'Johor Brunch Campus';
										break;

									case 'PH':
										echo 'Pahang Brunch Campus';
										break;

									case 'SB':
										echo 'Sabah Brunch Campus';
										break;
								}
								?>
							</span>
						</p>
					</div>
				</div>
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
							<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=
							<?php
							$obj = array();
							$obj['ticket_id'] = $ticket_id;
							$obj['seat_number'] = $seat_number;
							echo base64_url_encode(json_encode($obj));
							?>" alt="QR code">
						</div>
						<a href="/assignment/ticket/ticket_details_print.php?ticket_id=<?php echo $_GET['ticket_id'] ?>" target="_blank" rel="noopener noreferrer" class="font-bold text-blue-600 hover:underline">
							Print
						</a>
					</div>
				</div>
			</div>
		</div>

		<?php include "../includes/footer.php"; ?>
	</main>

	<?php include "../includes/scripts.php"; ?>
</body>

</html>