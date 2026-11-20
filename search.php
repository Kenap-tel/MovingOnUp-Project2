<?php
session_start();
include 'db_connect.php';

// Check if representative is logged in
if (!isset($_SESSION['RepID'])) {
    header("Location: index.php");
    exit();
}

$repID = $_SESSION['RepID'];

// Get representative and associated client information
$sql = "SELECT
            mr.FirstName AS RepFirstName,
            mr.LastName AS RepLastName,
            mr.RepNumber,
            mr.PhoneNumber AS RepPhone,
            mr.Email AS RepEmail,

            c.ClientID,
            c.FirstName AS ClientFirstName,
            c.LastName AS ClientLastName,

            pi.StreetNumber,
            pi.StreetName,
            pi.City,
            pi.State,
            pi.ZipCode,
            pi.PhoneNumber AS ClientPhone,

            mi.MovingID,
            mi.NewStreetNumber,
            mi.NewStreetName,
            mi.NewCity,
            mi.NewState,
            mi.NewZipCode,
            mi.MovingDate,
            mi.TotalWeight,
            mi.TotalCost,

            si.Instructions

        FROM movingrepresentatives mr

        INNER JOIN representativeclients rc
            ON mr.RepID = rc.RepID

        INNER JOIN clients c
            ON rc.ClientID = c.ClientID

        INNER JOIN clientpersonalinfo pi
            ON c.ClientID = pi.ClientID

        INNER JOIN clientmovinginfo mi
            ON c.ClientID = mi.ClientID

        LEFT JOIN specialinstructions si
            ON mi.MovingID = si.MovingID

        WHERE mr.RepID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $repID);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Representative Account</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>MovingOnUp</h1>
    <p>Representative Account Information</p>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="clients.php">Clients</a>
    <a href="representatives.php">Representatives</a>
    <a href="add_client.php">Add Client</a>
</nav>

<main>

    <h2>Representative Information</h2>

    <?php if ($result->num_rows > 0): ?>

        <p>
            Welcome,
            <?php
            $row = $result->fetch_assoc();

            echo htmlspecialchars(
                $row['RepFirstName'] . " " . $row['RepLastName']
            );
            ?>
        </p>

        <h2>Client Information</h2>

        <table border="1" cellpadding="8">

            <tr>
                <th>Representative Name</th>
                <th>Representative ID</th>
                <th>Representative Phone</th>
                <th>Representative Email</th>
                <th>Client Name</th>
                <th>Client ID</th>
                <th>Street Number</th>
                <th>Street Name</th>
                <th>City</th>
                <th>State</th>
                <th>Zip Code</th>
                <th>Client Phone</th>
                <th>New Street Number</th>
                <th>New Street Name</th>
                <th>New City</th>
                <th>New State</th>
                <th>New Zip Code</th>
                <th>Moving Date</th>
                <th>Weight</th>
                <th>Total Cost</th>
                <th>Special Instructions</th>
            </tr>

            <?php
            // Display first client
            do {
            ?>

            <tr>
                <td><?php echo htmlspecialchars($row['RepFirstName'] . " " . $row['RepLastName']); ?></td>

                <td><?php echo htmlspecialchars($row['RepNumber']); ?></td>

                <td><?php echo htmlspecialchars($row['RepPhone']); ?></td>

                <td><?php echo htmlspecialchars($row['RepEmail']); ?></td>

                <td><?php echo htmlspecialchars($row['ClientFirstName'] . " " . $row['ClientLastName']); ?></td>

                <td><?php echo htmlspecialchars($row['ClientID']); ?></td>

                <td><?php echo htmlspecialchars($row['StreetNumber']); ?></td>

                <td><?php echo htmlspecialchars($row['StreetName']); ?></td>

                <td><?php echo htmlspecialchars($row['City']); ?></td>

                <td><?php echo htmlspecialchars($row['State']); ?></td>

                <td><?php echo htmlspecialchars($row['ZipCode']); ?></td>

                <td><?php echo htmlspecialchars($row['ClientPhone']); ?></td>

                <td><?php echo htmlspecialchars($row['NewStreetNumber']); ?></td>

                <td><?php echo htmlspecialchars($row['NewStreetName']); ?></td>

                <td><?php echo htmlspecialchars($row['NewCity']); ?></td>

                <td><?php echo htmlspecialchars($row['NewState']); ?></td>

                <td><?php echo htmlspecialchars($row['NewZipCode']); ?></td>

                <td><?php echo htmlspecialchars($row['MovingDate']); ?></td>

                <td><?php echo htmlspecialchars($row['TotalWeight']); ?></td>

                <td><?php echo htmlspecialchars($row['TotalCost']); ?></td>

                <td><?php echo htmlspecialchars($row['Instructions'] ?? 'None'); ?></td>
            </tr>

            <?php
            } while ($row = $result->fetch_assoc());
            ?>

        </table>

    <?php else: ?>

        <p>No client records were found for this representative.</p>

    <?php endif; ?>

</main>

<footer>
    <p>MovingOnUp Management System</p>
</footer>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

