<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// Mendapatkan daftar nama pengguna dan email
$sql_users = "SELECT username, email FROM users";
$result_users = $conn->query($sql_users);
$user_data = [];
if ($result_users->num_rows > 0) {
    while($row_users = $result_users->fetch_assoc()) {
        $user_data[] = $row_users;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive UI Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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
				<a href="dashboard.php"> Dashboard  </a>
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
			<h1>Dashboard Users</h1>
			<div class="search">
				<input type="text" placeholder="Search" />
				<button type="submit">
					<i class="ph-magnifying-glass-bold"></i>
				</button>
			</div>
		</div>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat');

        * {
            box-sizing: border-box;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .user-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card-container {
            background-color: #231E39;
            border-radius: 5px;
            box-shadow: 0px 10px 20px -10px rgba(0,0,0,0.75);
            color: #B3B8CD;
            padding: 30px;
            margin: 10px;
            width: 280px;
            text-align: center;
        }

        .card-container h3 {
            margin: 10px 0;
        }

        .card-container .email {
            font-size: 14px;
            line-height: 21px;
        }
    </style>
</head>

    <div class="container">
        <h1>Users</h1>
        <div class="user-list">
            <?php foreach ($user_data as $user) { ?>
                <div class="card-container">
                    <h3><?php echo $user['username']; ?></h3>
                    <p class="email"><?php echo $user['email']; ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
