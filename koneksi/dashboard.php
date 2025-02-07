<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Menghitung total pengguna
$sql_total_users = "SELECT COUNT(*) AS count FROM users";
$result_total_users = $conn->query($sql_total_users);
$row_total_users = $result_total_users->fetch_assoc();
$total_users = $row_total_users['count'];

// Menghitung jumlah pengguna hadir dan tidak hadir
$sql_present = "SELECT COUNT(DISTINCT user_id) AS count FROM attendance WHERE status = 'Present'";
$result_present = $conn->query($sql_present);
$row_present = $result_present->fetch_assoc();
$present_count = $row_present['count'];

$absent_count = $total_users - $present_count;

// Mendapatkan daftar nama pengguna
$sql_users = "SELECT username FROM users";
$result_users = $conn->query($sql_users);
$usernames = [];
if ($result_users->num_rows > 0) {
    while($row_users = $result_users->fetch_assoc()) {
        $usernames[] = $row_users['username'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>responsive ui Dashboard</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<header class="header">
	<div class="header-content responsive-wrapper">
		<div class="header-logo">
			<a href="#">
				<div>
					<img src="https://img.icons8.com/ios/50/r.png" />
				</div>
				<img src="https://assets.codepen.io/285131/untitled-ui.svg" />
			</a>
		</div>
		<div class="header-navigation">
			<nav class="header-navigation-links">
				<a href="../index.php"> Home </a>
				<a href="dashboard.php"> Dashboard </a>
					<a href="../public/project.html"> Projects </a>
				<a href="users.php"> Users </a>
			</nav>
            <div class="header-navigation-actions">
				<a href="../logout.php" class="button">
					<span>login now</span>
				</a>
				<a href="#" class="avatar">
					<img src="../images/favicon.gif" alt="icon" />
				</a>
			</div>
		</div>
	</div>
</header>
<main class="main">
	<div class="responsive-wrapper">
		<div class="main-header">
			<h1>Dashboard</h1>
			<div class="search">
				<input type="text" placeholder="Search" />
				<button type="submit">
					<i class="ph-magnifying-glass-bold"></i>
				</button>
			</div>
		</div>
    <style>
        .container {
            margin: 50px auto;
            width: 80%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
        }
        .chart {
            width: 45%;
        }
        .user-list {
            width: 45%;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            text-align: left;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        .user-list h2 {
            color: #333;
            margin-bottom: 15px;
        }
        .user-list .card {
            background-color: #fff;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .user-list .card p {
            margin: 0;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Status', 'Jumlah', { role: 'style' }],
                ['Total Pengguna', <?php echo $total_users; ?>, 'color: #4CAF50'],
                ['Pengguna Hadir', <?php echo $present_count; ?>, 'color: #2196F3'],
                ['Pengguna Tidak Hadir', <?php echo $absent_count; ?>, 'color: #F44336']
            ]);

            var options = {
                title: 'Statistik Pengguna',
                hAxis: {
                    title: 'Status',
                },
                vAxis: {
                    title: 'Jumlah',
                },
                legend: 'none',
                bar: {groupWidth: '75%'},
                isStacked: true
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('barchart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="chart" id="barchart_div" style="height: 500px;"></div>
        <div class="user-list">
            <h2>Daftar Pengguna</h2>
            <?php foreach ($usernames as $username) { ?>
                <div class="card">
                    <p><?php echo $username; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
