<?php
include 'db_connect.php';

$sql = "SELECT RepID, FirstName, LastName, RepNumber,
        PhoneNumber, Email FROM movingrepresentatives";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>MovingOnUp - Representatives</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>MovingOnUp</h1>
    <p>Your Moving Management System</p>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="clients.php">Clients</a>
    <a href="representatives.php">Representatives</a>
    <a href="add_client.php">Add Client</a>
</nav>

<main>
    <h2>Moving Representatives</h2>

    <p>Below is the list of registered representatives.</p>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Rep ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Rep Number</th>
            <th>Phone Number</th>
            <th>Email</th>
        </tr>

        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['RepID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
                echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
                echo "<td>" . htmlspecialchars($row['RepNumber']) . "</td>";
                echo "<td>" . htmlspecialchars($row['PhoneNumber']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No representatives found.</td></tr>";
        }
        ?>
    </table>

</main>

<footer>
    <p>MovingOnUp Management System</p>
</footer>

</body>
</html>
