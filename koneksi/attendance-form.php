<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO attendance (user_id, date, status) VALUES ('$user_id', '$date', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "Data absensi berhasil ditambahkan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<form method="post" action="">
    User: 
    <select name="user_id" required>
        <?php while($row = $result->fetch_assoc()) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
        <?php } ?>
    </select><br>
    Date: <input type="date" name="date" required><br>
    Status: 
    <select name="status" required>
        <option value="Present">Present</option>
        <option value="Absent">Absent</option>
    </select><br>
    <button type="submit">Submit</button>
</form>
