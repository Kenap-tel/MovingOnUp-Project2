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

    $movingID = trim($_POST['MovingID'] ?? '');

    // Validate Moving ID
    if ($movingID === '' || !ctype_digit($movingID) || (int)$movingID <= 0) {

        $message = "Please enter a valid Moving ID.";
        $messageType = "error";

    } else {

        $movingID = (int)$movingID;
        $transactionStarted = false;

        try {

            // Start transaction
            $conn->begin_transaction();
            $transactionStarted = true;

            // Check whether moving event exists
            $check = $conn->prepare(
                "SELECT MovingID
                 FROM clientmovinginfo
                 WHERE MovingID = ?
                 FOR UPDATE"
            );

            $check->bind_param("i", $movingID);
            $check->execute();
            $check->store_result();

            $eventExists = ($check->num_rows > 0);

            $check->close();

            if (!$eventExists) {

                $conn->rollback();
                $transactionStarted = false;

                $message = "Moving event not found. Please check the Moving ID.";
                $messageType = "error";

            } else {

                // Delete special instructions first
                $sql1 = "DELETE FROM specialinstructions
                         WHERE MovingID = ?";

                $stmt1 = $conn->prepare($sql1);

                $stmt1->bind_param("i", $movingID);
                $stmt1->execute();

                $stmt1->close();

                // Delete moving event
                $sql2 = "DELETE FROM clientmovinginfo
                         WHERE MovingID = ?";

                $stmt2 = $conn->prepare($sql2);

                $stmt2->bind_param("i", $movingID);
                $stmt2->execute();

                $deletedRows = $stmt2->affected_rows;

                $stmt2->close();

                if ($deletedRows != 1) {
                    throw new Exception("Moving event could not be deleted.");
                }

                // Save changes
                $conn->commit();
                $transactionStarted = false;

                $message = "Moving event " . $movingID . " cancelled successfully!";
                $messageType = "success";
            }

        } catch (Throwable $e) {

            if ($transactionStarted) {
                $conn->rollback();
            }

            $message = "Cancellation failed: " . $e->getMessage();
            $messageType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Cancel Moving Event</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>

    <h1>MovingOnUp</h1>

    <p>Cancel a Client's Moving Event</p>

</header>

<main>

    <h2>Cancel Moving Event</h2>

    <p>
        Representative:
        <?php
        echo htmlspecialchars($_SESSION['RepName'] ?? '');
        ?>
    </p>

    <?php if (!empty($message)) { ?>

        <p class="<?php echo htmlspecialchars($messageType); ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>

    <?php } ?>

    <form method="POST" action="cancel.php"
          onsubmit="return confirm('Are you sure you want to cancel this moving event?');">

        <label>Moving ID:</label>

        <input
            type="number"
            name="MovingID"
            min="1"
            required
        >

        <button type="submit">
            Cancel Moving Event
        </button>

    </form>

    <br>

    <a href="index.php">Back to Home</a>

</main>

<footer>

    <p>MovingOnUp Management System</p>

</footer>

</body>

</html>
