<?php
include '../includes/functions/db.php';
include '../includes/functions/auth.php';

redirect_if_not_logged_in();

$con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}

$payload = get_jwt_payload($_COOKIE['token']);
$sql = "SELECT * FROM users WHERE username = '$payload->name'";
$result = $con->query($sql);
$user = $result->fetch_assoc();
$user_id = $user['id'];

$tickets = [];
$sql = "SELECT t.id, tf.seat_number, t.campus, ms.start_datetime, ms.end_datetime, m.pic_url, m.name FROM ticket_forms tf 
		JOIN tickets t ON tf.ticket_id = t.id 
		JOIN movie_showtimes ms ON tf.movie_showtime_id = ms.id 
		JOIN movies m ON ms.movie_id = m.id
		WHERE tf.user_id = $user_id";
$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
	array_push($tickets, $row);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ticket - Silver Screen Club</title>
	<link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
	<?php include "../includes/styles.php"; ?>
	<style>
		@import url("https://fonts.googleapis.com/css2?family=Staatliches&display=swap");
		@import url("https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap");

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body,
		html {
			height: 100vh;
			display: grid;
			font-family: "Staatliches", cursive;
			color: black;
			font-size: 14px;
			letter-spacing: 0.1em;
		}

		.ticket {
			margin: auto;
			display: flex;
			background: white;
			box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
		}

		.left {
			display: flex;
		}

		.image {
			height: 250px;
			width: 250px;
			background-size: contain;
			opacity: 0.85;
		}

		.admit-one {
			position: absolute;
			color: darkgray;
			height: 250px;
			padding: 0 10px;
			letter-spacing: 0.15em;
			display: flex;
			text-align: center;
			justify-content: space-around;
			writing-mode: vertical-rl;
			transform: rotate(-180deg);
		}

		.admit-one span:nth-child(2) {
			color: white;
			font-weight: 700;
		}

		.left .ticket-number {
			height: 250px;
			width: 250px;
			display: flex;
			justify-content: flex-end;
			align-items: flex-end;
			padding: 5px;
		}

		.ticket-info {
			padding: 10px 30px;
			display: flex;
			flex-direction: column;
			text-align: center;
			justify-content: space-between;
			align-items: center;
		}

		.date {
			border-top: 1px solid gray;
			border-bottom: 1px solid gray;
			padding: 5px 0;
			font-weight: 700;
			display: flex;
			align-items: center;
			justify-content: space-around;
		}

		.date span {
			width: 100px;
		}

		.date span:first-child {
			text-align: left;
		}

		.date span:last-child {
			text-align: right;
		}

		.date .june-29 {
			color: #d83565;
			font-size: 20px;
		}

		.show-name {
			font-size: 32px;
			font-family: "Nanum Pen Script", cursive;
			color: #d83565;
		}

		.show-name h1 {
			font-size: 48px;
			font-weight: 700;
			letter-spacing: 0.1em;
			color: #4a437e;
		}

		.time {
			padding: 10px 0;
			color: #4a437e;
			text-align: center;
			display: flex;
			flex-direction: column;
			gap: 10px;
			font-weight: 700;
		}

		.time span {
			font-weight: 400;
			color: gray;
		}

		.left .time {
			font-size: 16px;
		}


		.location {
			display: flex;
			justify-content: space-around;
			align-items: center;
			width: 100%;
			padding-top: 8px;
			border-top: 1px solid gray;
		}

		.location .separator {
			font-size: 20px;
		}

		.right {
			width: 180px;
			border-left: 1px dashed #404040;
		}

		.right .admit-one {
			color: darkgray;
		}

		.right .admit-one span:nth-child(2) {
			color: gray;
		}

		.right .right-info-container {
			height: 250px;
			padding: 10px 10px 10px 35px;
			display: flex;
			flex-direction: column;
			justify-content: space-around;
			align-items: center;
		}

		.right .show-name h1 {
			font-size: 18px;
		}

		.barcode {
			height: 100px;
		}

		.barcode img {
			height: 100%;
		}

		.right .ticket-number {
			color: gray;
		}
	</style>
</head>

<body class="overflow-hidden">
	<?php include "../includes/header.php"; ?>

	<main class="max-w-screen max-h-screen overflow-auto scroll-smooth">
		<div class="container mx-auto py-32 px-4">
			<div class="flex flex-col gap-3">
				<?php
				foreach ($tickets as $ticket) {

					$seat_number = json_decode($ticket['seat_number']);
					$start_datetime = date_create($ticket['start_datetime']);
					$end_datetime = date_create($ticket['end_datetime']);

					$qrCodeData = array();
					$qrCodeData['ticket_id'] = $ticket['id'];
					$qrCodeData['seat_number'] = $ticket['seat_number'];
				?>
					<div class="p-5 ticket">
						<div class="left">
							<img src="/assignment/wwwroot/images/movies/<?php echo $ticket['pic_url'] ?>" class="image">
							</img>
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
										echo $ticket['name'];
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
										switch ($ticket['campus']) {
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
										echo $ticket['name'];
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
								<a href="/assignment/ticket/ticket_details_print.php?ticket_id=<?php echo $ticket['id'] ?>" target="_blank" rel="noopener noreferrer" class="font-bold text-blue-600 hover:underline">
									Print
								</a>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php include "../includes/footer.php"; ?>
	</main>

	<?php include "../includes/scripts.php"; ?>
</body>

</html>