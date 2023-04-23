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
			background-image: url("/assignment/wwwroot/public/images/Titanic.jpg");
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
            <div class="p-5 ticket">
				<div class="left">
					<div class="image">
						<div class="ticket-number">
							<p>
								#20030220
							</p>
						</div>
					</div>
					<div class="ticket-info">
						<p class="date">
							<span>TUESDAY</span>
							<span class="june-29">JUNE 29TH</span>
							<span>2023</span>
						</p>
						<div class="show-name">
							<h1>Titanic</h1>
							<h2></h2>
						</div>
						<div class="time">
							<p>8:00 PM <span>TO</span> 11:00 PM</p>
							<p>ROOM 1 <span>@</span> SEAT A10</p>
						</div>
						<p class="location">
							<span>Silver Screen Club</span>
							<span class="mx-2">|</span> 
							<span>TARUMT Main Campus</span>
						</p>
					</div>
				</div>
				<div class="right">
					<div class="right-info-container">
						<div class="show-name">
							<h1>TITANIC</h1>
						</div>
						<div class="time">
							<p>8:00 PM <span>TO</span> 11:00 PM</p>
							<p>ROOM 1 <span>@</span> SEAT A10</p>
						</div>
						<div class="barcode">
							<img src="https://external-preview.redd.it/cg8k976AV52mDvDb5jDVJABPrSZ3tpi1aXhPjgcDTbw.png?auto=webp&s=1c205ba303c1fa0370b813ea83b9e1bddb7215eb" alt="QR code">
						</div>
						<p class="ticket-number">
							#20030220
						</p>
					</div>
				</div>
			</div>

            <div class="p-5 ticket">
				<div class="left">
					<div class="image">
						<div class="ticket-number">
							<p>
								#20030220
							</p>
						</div>
					</div>
					<div class="ticket-info">
						<p class="date">
							<span>TUESDAY</span>
							<span class="june-29">JUNE 29TH</span>
							<span>2023</span>
						</p>
						<div class="show-name">
							<h1>Titanic</h1>
							<h2></h2>
						</div>
						<div class="time">
							<p>8:00 PM <span>TO</span> 11:00 PM</p>
							<p>ROOM 1 <span>@</span> SEAT A10</p>
						</div>
						<p class="location">
							<span>Silver Screen Club</span>
							<span class="mx-2">|</span> 
							<span>TARUMT Main Campus</span>
						</p>
					</div>
				</div>
				<div class="right">
					<div class="right-info-container">
						<div class="show-name">
							<h1>TITANIC</h1>
						</div>
						<div class="time">
							<p>8:00 PM <span>TO</span> 11:00 PM</p>
							<p>ROOM 1 <span>@</span> SEAT A10</p>
						</div>
						<div class="barcode">
							<img src="https://external-preview.redd.it/cg8k976AV52mDvDb5jDVJABPrSZ3tpi1aXhPjgcDTbw.png?auto=webp&s=1c205ba303c1fa0370b813ea83b9e1bddb7215eb" alt="QR code">
						</div>
						<p class="ticket-number">
							#20030220
						</p>
					</div>
				</div>
			</div>

            <div class="p-5 ticket">
				<div class="left">
					<div class="image">
						<div class="ticket-number">
							<p>
								#20030220
							</p>
						</div>
					</div>
					<div class="ticket-info">
						<p class="date">
							<span>TUESDAY</span>
							<span class="june-29">JUNE 29TH</span>
							<span>2023</span>
						</p>
						<div class="show-name">
							<h1>Titanic</h1>
							<h2></h2>
						</div>
						<div class="time">
							<p>8:00 PM <span>TO</span> 11:00 PM</p>
							<p>ROOM 1 <span>@</span> SEAT A10</p>
						</div>
						<p class="location">
							<span>Silver Screen Club</span>
							<span class="mx-2">|</span> 
							<span>TARUMT Main Campus</span>
						</p>
					</div>
				</div>
				<div class="right">
					<div class="right-info-container">
						<div class="show-name">
							<h1>TITANIC</h1>
						</div>
						<div class="time">
							<p>8:00 PM <span>TO</span> 11:00 PM</p>
							<p>ROOM 1 <span>@</span> SEAT A10</p>
						</div>
						<div class="barcode">
							<img src="https://external-preview.redd.it/cg8k976AV52mDvDb5jDVJABPrSZ3tpi1aXhPjgcDTbw.png?auto=webp&s=1c205ba303c1fa0370b813ea83b9e1bddb7215eb" alt="QR code">
						</div>
						<p class="ticket-number">
							#20030220
						</p>
					</div>
				</div>
			</div>
            </div>
        </div>

        <?php include "../includes/footer.php"; ?>
    </main>

    <?php include "../includes/scripts.php"; ?>
</body>
</html>
