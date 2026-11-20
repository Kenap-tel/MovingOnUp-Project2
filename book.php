
<?php
session_start();
include 'db_connect.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Check representative login
if (!isset($_SESSION['RepID'])) {
    header("Location: index.php");
    exit();
}

$message = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $clientID = trim($_POST['ClientID'] ?? '');
    $streetNumber = trim($_POST['NewStreetNumber'] ?? '');
    $streetName = trim($_POST['NewStreetName'] ?? '');
    $city = trim($_POST['NewCity'] ?? '');
    $state = trim($_POST['NewState'] ?? '');
    $zipCode = trim($_POST['NewZipCode'] ?? '');
    $movingDate = $_POST['MovingDate'] ?? '';

    $weightInput = $_POST['TotalWeight'] ?? '';
    $milesInput = $_POST['MilesForMove'] ?? '';
    $costInput = $_POST['TotalCost'] ?? '';

    $instructions = trim($_POST['Instructions'] ?? '');

    if (
        $clientID === '' ||
        $streetNumber === '' ||
        $streetName === '' ||
        $city === '' ||
        $state === '' ||
        $zipCode === '' ||
        $movingDate === '' ||
        $instructions === '' ||
        $weightInput === '' ||
        $milesInput === '' ||
        $costInput === ''
    ) {

        $message = "Please fill in all required fields.";
        $messageType = "error";

    } elseif (!ctype_digit($clientID) || (int)$clientID <= 0) {

        $message = "Please enter a valid Client ID.";
        $messageType = "error";

    } elseif (
        !is_numeric($weightInput) ||
        !is_numeric($milesInput) ||
        !is_numeric($costInput) ||
        !is_finite((float)$weightInput) ||
        !is_finite((float)$milesInput) ||
        !is_finite((float)$costInput) ||
        (float)$weightInput < 0 ||
        (float)$milesInput < 0 ||
        (float)$costInput < 0
    ) {

        $message = "Please enter valid non-negative numbers.";
        $messageType = "error";

    } else {

        $date = DateTime::createFromFormat('!Y-m-d', $movingDate);

        if (!$date || $date->format('Y-m-d') !== $movingDate) {

            $message = "Please enter a valid moving date.";
            $messageType = "error";

        } else {

            $clientID = (int)$clientID;
            $weight = (float)$weightInput;
            $miles = (float)$milesInput;
            $cost = (float)$costInput;

            $transactionStarted = false;

            try {

                // Confirm the database connection
                $databaseResult = $conn->query("SELECT DATABASE()");
                $databaseRow = $databaseResult->fetch_row();

                if ($databaseRow[0] !== 'movingonup') {
                    throw new Exception(
                        "Connected to the wrong database: " . $databaseRow[0]
                    );
                }

                // Check ClientID in clients table
                $check = $conn->prepare(
                    "SELECT ClientID FROM movingonup.clients
                     WHERE ClientID = ? LIMIT 1"
                );

                $check->bind_param("i", $clientID);
                $check->execute();
                $check->store_result();

                $clientExists = ($check->num_rows === 1);

                $check->close();

                if (!$clientExists) {

                    $message = "Client ID does not exist. Please check the Client ID.";
                    $messageType = "error";

                } else {

                    // Start transaction
                    $conn->begin_transaction();
                    $transactionStarted = true;

                    // Insert moving information
                    $sql = "INSERT INTO clientmovinginfo
                    (
                        ClientID,
                        NewStreetNumber,
                        NewStreetName,
                        NewCity,
                        NewState,
                        NewZipCode,
                        MovingDate,
                        TotalWeight,
                        MilesForMove,
                        TotalCost
                    )
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                    $stmt = $conn->prepare($sql);

                    $stmt->bind_param(
                        "issssssddd",
                        $clientID,
                        $streetNumber,
                        $streetName,
                        $city,
                        $state,
                        $zipCode,
                        $movingDate,
                        $weight,
                        $miles,
                        $cost
                    );

                    $stmt->execute();

                    $movingID = $conn->insert_id;

                    $stmt->close();

                    if ($movingID <= 0) {
                        throw new Exception("Could not generate Moving ID.");
                    }

                    // Insert special instructions
                    $sql2 = "INSERT INTO specialinstructions
                    (
                        MovingID,
                        Instructions
                    )
                    VALUES (?, ?)";

                    $stmt2 = $conn->prepare($sql2);

                    $stmt2->bind_param(
                        "is",
                        $movingID,
                        $instructions
                    );

                    $stmt2->execute();
                    $stmt2->close();

                    // Save both records
                    $conn->commit();
                    $transactionStarted = false;

                    $message = "Moving event booked successfully! Moving ID: " . $movingID;
                    $messageType = "success";
                }

            } catch (Throwable $e) {

                if ($transactionStarted) {
                    $conn->rollback();
                }

                $message = "Booking failed: " . $e->getMessage();
                $messageType = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Book Moving Event</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>MovingOnUp</h1>
    <p>Book a Client's Moving Event</p>
</header>

<main>

    <h2>Moving Event Booking</h2>

    <p>
        Representative:
        <?php echo htmlspecialchars($_SESSION['RepName'] ?? ''); ?>
    </p>

    <?php if (!empty($message)) { ?>
        <p class="<?php echo htmlspecialchars($messageType); ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php } ?>

    <form method="POST" action="book.php">

        <label>Client ID:</label>
        <input type="number" name="ClientID" min="1" required>

        <label>New Street Number:</label>
        <input type="text" name="NewStreetNumber" required>

        <label>New Street Name:</label>
        <input type="text" name="NewStreetName" required>

        <label>New City:</label>
        <input type="text" name="NewCity" required>

        <label>New State:</label>
        <input type="text" name="NewState" required>

        <label>New Zip Code:</label>
        <input type="text" name="NewZipCode" required>

        <label>Moving Date:</label>
        <input type="date" name="MovingDate" required>

        <label>Total Weight:</label>
        <input type="number" step="0.01" min="0"
               name="TotalWeight" required>

        <label>Miles For Move:</label>
        <input type="number" step="0.01" min="0"
               name="MilesForMove" required>

        <label>Total Cost:</label>
        <input type="number" step="0.01" min="0"
               name="TotalCost" required>

        <label>Special Instructions:</label>
        <textarea name="Instructions" required></textarea>

        <button type="submit">Book Moving Event</button>

    </form>

    <br>

    <a href="index.php">Back to Home</a>

</main>

<footer>
    <p>MovingOnUp Management System</p>
</footer>

</body>
</html>
