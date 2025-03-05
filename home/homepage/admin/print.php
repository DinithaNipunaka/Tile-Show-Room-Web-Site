<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
		<script src="script.js"></script>
		<style>
		/* reset */
		*
		{
			border: 0;
			box-sizing: content-box;
			color: inherit;
			font-family: inherit;
			font-size: inherit;
			font-style: inherit;
			font-weight: inherit;
			line-height: inherit;
			list-style: none;
			margin: 0;
			padding: 0;
			text-decoration: none;
			vertical-align: top;
		}

		/* content editable */
		*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }
		*[contenteditable] { cursor: pointer; }
		*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }
		span[contenteditable] { display: inline-block; }

		/* heading */
		h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

		/* table */
		table { font-size: 75%; table-layout: fixed; width: 100%; }
		table { border-collapse: separate; border-spacing: 2px; }
		th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
		th, td { border-radius: 0.25em; border-style: solid; }
		th { background: #EEE; border-color: #BBB; }
		td { border-color: #DDD; }

		/* page */
		html { 
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
			overflow: auto; 
			padding: 0.5in; 
			background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
			cursor: default; 
		}

		body { 
			box-sizing: border-box; 
			height: 11in; 
			margin: 0 auto; 
			overflow: hidden; 
			padding: 0.5in; 
			width: 8.5in; 
			background: #FFF; 
			border-radius: 8px; 
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); 
			transition: all 0.3s ease;
		}

		/* header */
		header { 
			margin: 0 0 3em; 
			background: linear-gradient(to right, #0f2453, #1f3a70);
			border-radius: 8px;
			padding: 1.5em;
			color: white;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
		}
		
		header:after { clear: both; content: ""; display: table; }

		header h1 { 
			background: rgba(255, 255, 255, 0.1); 
			border-radius: 8px; 
			color: #FFF; 
			margin: 0 0 1em; 
			padding: 0.8em 0; 
			letter-spacing: 0.3em;
			text-transform: uppercase;
			font-weight: 700;
			box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
			transition: all 0.3s ease;
		}
		
		header h1:hover {
			transform: translateY(-3px);
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
		}
		
		header address { 
			float: left; 
			font-size: 85%; 
			font-style: normal; 
			line-height: 1.5; 
			margin: 0 1em 1em 0; 
			color: rgba(255, 255, 255, 0.9);
		}
		
		header address p { 
			margin: 0 0 0.5em; 
			display: flex;
			align-items: center;
		}
		
		header address p i {
			margin-right: 0.5em;
			color: #e63946;
		}
		
		header span, header img { display: block; float: right; }
		
		header span { 
			margin: 0 0 1em 1em; 
			max-height: 25%; 
			max-width: 60%; 
			position: relative; 
			background: transparent;
			padding: 0.5em;
			border-radius: 8px;
			box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
			transition: all 0.3s ease;
		}
		
		header span:hover {
			transform: translateY(-3px);
			box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
		}
		
		header img { max-height: 100%; max-width: 100%; }
		header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

		/* article */
		article, article address, table.meta, table.inventory { margin: 0 0 3em; }
		article:after { clear: both; content: ""; display: table; }
		article h1 { 
			clip: rect(0 0 0 0); 
			position: absolute;
		}

		article address { float: left; font-size: 125%; font-weight: bold; }

		/* table meta & balance */
		table.meta, table.balance { float: right; width: 36%; }
		table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

		/* table meta */
		table.meta th { width: 40%; }
		table.meta td { width: 60%; }

		/* table items */
		table.inventory { 
			clear: both; 
			width: 100%; 
			border-collapse: separate;
			border-spacing: 0;
			box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
			border-radius: 8px;
			overflow: hidden;
		}
		
		table.inventory th { 
			font-weight: bold; 
			text-align: center; 
			background: #0f2453; 
			color: white;
			padding: 1em;
			border-color: #0f2453;
			text-transform: uppercase;
			font-size: 90%;
			letter-spacing: 0.05em;
		}

		table.inventory td:nth-child(1) { width: 26%; }
		table.inventory td:nth-child(2) { width: 38%; }
		table.inventory td:nth-child(3) { text-align: right; width: 12%; }
		table.inventory td:nth-child(4) { text-align: right; width: 12%; }
		table.inventory td:nth-child(5) { text-align: right; width: 12%; }
		
		table.inventory tr:nth-child(even) td {
			background-color: #f8f9fa;
		}
		
		table.inventory tr:hover td {
			background-color: #f0f4f8;
			transition: all 0.2s ease;
		}
		
		table.inventory td {
			padding: 0.8em;
			border-bottom: 1px solid #eee;
			border-right: none;
			border-left: none;
			border-radius: 0;
		}
		
		table.inventory tr:last-child td {
			border-bottom: none;
			background-color: #f0f4f8;
			font-weight: bold;
			color: #0f2453;
		}

		/* table balance */
		table.balance th, table.balance td { width: 50%; }
		table.balance td { text-align: right; }

		/* aside */
		aside { 
			margin-top: 2em;
			background: #f8f9fa;
			border-radius: 8px;
			padding: 1.5em;
			box-shadow: 0 3px 15px rgba(0, 0, 0, 0.05);
		}
		
		aside h1 { 
			border: none; 
			border-width: 0 0 1px; 
			margin: 0 0 1em; 
			color: #0f2453;
			font-size: 1.2em;
			text-align: left;
			letter-spacing: 0.1em;
			display: inline-block;
			border-bottom: 2px solid #e63946;
			padding-bottom: 0.5em;
		}
		
		aside div {
			margin-top: 1em;
		}
		
		aside p {
			line-height: 1.6;
			color: #555;
			margin-bottom: 0.8em;
		}

		/* javascript */
		.add, .cut
		{
			border-width: 1px;
			display: block;
			font-size: .8rem;
			padding: 0.25em 0.5em;	
			float: left;
			text-align: center;
			width: 0.6em;
		}

		.add, .cut
		{
			background: #9AF;
			box-shadow: 0 1px 2px rgba(0,0,0,0.2);
			background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
			background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
			border-radius: 0.5em;
			border-color: #0076A3;
			color: #FFF;
			cursor: pointer;
			font-weight: bold;
			text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
		}

		.add { margin: -2.5em 0 0; }
		.add:hover { background: #00ADEE; }
		.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
		.cut { -webkit-transition: opacity 100ms ease-in; }
		tr:hover .cut { opacity: 1; }

		/* Print button */
		.btn.btn-primary { 
			position: fixed;
			bottom: 30px;
			right: 30px;
			background: #0f2453;
			border: none;
			box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
			padding: 0.8em 1.5em;
			border-radius: 50px;
			font-weight: 600;
			display: flex;
			align-items: center;
			gap: 0.5em;
			transition: all 0.3s ease;
			z-index: 100;
		}
		
		.btn.btn-primary:hover {
			background:rgb(54, 219, 8);
			transform: translateY(-3px);
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
		}

		/* Animations */
		@keyframes fadeIn {
			from { opacity: 0; transform: translateY(20px); }
			to { opacity: 1; transform: translateY(0); }
		}

		body {
			animation: fadeIn 0.6s ease-out;
		}

		@media print {
			* { -webkit-print-color-adjust: exact; }
			html { background: none; padding: 0; }
			body { box-shadow: none; margin: 0; animation: none; }
			span:empty { display: none; }
			.add, .cut { display: none; }
			.btn.btn-primary { display: none; }
		}

		@page { margin: 0; }
		</style>
	</head>
	<body>
	<?php
	ob_start();	
	include ('db.php');

	$pid = $_GET['pid'];
	
	$sql ="SELECT * FROM orderdetails where  user_id='$pid'";
	$re = mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($re))
	{
		$oid = $row['order_id'];
		$uid = $row['user_id'];
		$odername = $row['order_name'];
		$price = $row['order_price'];
		$qty = $row['order_quantity'];
		$tot = $row['order_total'];
		$date = $row['order_date'];
	}
	?>
	<script>
        function printPage() {
            var printButton = document.querySelector('.btn.btn-primary');
            if (printButton) {
                printButton.style.display = 'none'; // Hide the button before printing

                window.print(); // Trigger printing

                // Show the button again after printing (use a timeout to ensure it shows after printing)
                setTimeout(function () {
                    printButton.style.display = 'block';
                }, 1000); // Adjust the delay as needed
            }
        }
    </script>

    <button class="btn btn-primary" onclick="printPage()"><i class="fas fa-print"></i> Print Invoice</button>
	
	<header>
		<h1>Invoice</h1>
		
		<address>
			<p><i class="fas fa-calendar-alt"></i> Date: <a href="#" style="color:white; text-decoration:none;"><?php
                        $Today=date('y:m:d');
                        $new=date('l, F d, Y',strtotime($Today));
                        echo $new; ?></a></p>
			<p><i class="fas fa-user"></i> Name: <?php
					 $sql ="SELECT user_firstname, user_lastname FROM users where  user_id='$pid'";
					 $rp = mysqli_query($con,$sql);
					 while($row=mysqli_fetch_array($rp)){
						$ne = $row['user_firstname'];
						$le = $row['user_lastname'];
					 }
					 
					 echo $ne.' ' .$le;
					 
			?></p>
		</address>
		<span><h1 style="font-size:40px;background:white; color:red;border-radius:8px;padding:0.3em;">HERATH <b style="color:#0f2453;">TILE SHOP</b></h1></span>
	</header>
	<article>
		<h1>Recipient</h1>
		
		<table class="display table inventory" id="example" cellspacing="0" width="100%">
		  <thead>
			<tr>
			  <th><i class="fas fa-shopping-cart me-2"></i> Item</th>
			  <th><i class="fas fa-tag me-2"></i> Price</th>
			  <th><i class="fas fa-cubes me-2"></i> Quantity</th>
			  <th><i class="fas fa-money-bill-wave me-2"></i> Total</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		include("config.php");
		 
			$stmt = $DB_con->prepare("SELECT * FROM orderdetails where  user_id='$uid'");
			$stmt->execute();
			
			if($stmt->rowCount() > 0)
			{
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				{
					extract($row);
					
					
					?>
				<tr>
				  
				 <td><?php echo $order_name; ?></td>
				 <td>LKR <?php echo $order_price; ?> </td>
				 <td><?php echo $order_quantity; ?></td>
				 <td>LKR <?php echo $order_total; ?> </td>
				 
				 
				</tr>

		   
		  <?php
			}
			 include("config.php");
			  $stmt_edit = $DB_con->prepare("select sum(order_total) as totalx from orderdetails where user_id=:user_id and order_status='Ordered'");
			$stmt_edit->execute(array(':user_id'=>$user_id));
			$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
			extract($edit_row);
			
			echo "<tr>";
			echo "<td colspan='3' align='right'>"?><b style="font-size:15px;font-weight:bold;">Total Price Ordered<?php
			echo "</td>";
			
			?><?php echo "<td><h6>LKR ".$totalx;
			echo "</h6></td>";?></b><?php
			
			
			
			echo "</tr>";
			echo "<tr>";
		   
			echo "</tbody>";
			echo "</table>";}?>
	</article>
	<aside>
		<h1><i class="fas fa-id-card me-2"></i> Contact us</h1>
		<div>
		<p align="center"><i class="fas fa-map-marker-alt me-2"></i> Address: HERETH TILE SHOP,
			Kandy Road, Walapane, Central Province, Sri Lanka.</p>
			<p align="center"><i class="fas fa-envelope me-2"></i> Email: herathtilesshowroom@gmail.com</p>
			<p align="center"><i class="fas fa-phone me-2"></i> Hotline: 077-6981105  ||  Tel: 077-6981105 </p>
		</div>
	</aside>
	</body>
</html>