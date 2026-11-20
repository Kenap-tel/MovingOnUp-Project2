
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
$movingInfo = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $movingID = trim($_POST['MovingID'] ?? '');

    if ($movingID === '' || !ctype_digit($movingID) || (int)$movingID <= 0) {

        $message = "Please enter a valid Moving ID.";
        $messageType = "error";

    } else {

        try {

            $movingID = (int)$movingID;

            // Search moving event and its special instructions
            $sql = "SELECT
                        m.MovingID,
                        m.ClientID,
                        s.Instructions
                    FROM clientmovinginfo m
                    LEFT JOIN specialinstructions s
                    ON m.MovingID = s.MovingID
                    WHERE m.MovingID = ?";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("i", $movingID);

            $stmt->execute();

            $stmt->bind_result(
                $resultMovingID,
                $resultClientID,
                $resultInstructions
            );

            if ($stmt->fetch()) {

                $movingInfo = [
                    'MovingID' => $resultMovingID,
                    'ClientID' => $resultClientID,
                    'Instructions' => $resultInstructions
                ];

            } else {

                $message = "Moving event not found.";
                $messageType = "error";

            }

            $stmt->close();

        } catch (Throwable $e) {

            $message = "Search failed: " . $e->getMessage();
            $messageType = "error";

        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Special Instructions for Move</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<header>

    <h1>MovingOnUp</h1>

    <p>Special Instructions for Move</p>

</header>

<main>

    <h2>Search Special Instructions</h2>

    <p>
        Representative:
        <?php echo htmlspecialchars($_SESSION['RepName'] ?? ''); ?>
    </p>

    <?php if (!empty($message)) { ?>

        <p class="<?php echo htmlspecialchars($messageType); ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>

    <?php } ?>

    <form method="POST" action="instructions.php">

        <label>Moving ID:</label>

        <input
            type="number"
            name="MovingID"
            min="1"
            required
        >

        <button type="submit">
            Search Instructions
        </button>

    </form>

    <?php if ($movingInfo !== null) { ?>

        <h3>Moving Event Details</h3>

        <p>
            <strong>Moving ID:</strong>
            <?php echo htmlspecialchars((string)$movingInfo['MovingID']); ?>
        </p>

        <p>
            <strong>Client ID:</strong>
            <?php echo htmlspecialchars((string)$movingInfo['ClientID']); ?>
        </p>

        <p>
            <strong>Special Instructions:</strong>
        </p>

        <p>
            <?php
            echo nl2br(htmlspecialchars(
                $movingInfo['Instructions'] ?? 'No special instructions available.'
            ));
            ?>
        </p>

    <?php } ?>

    <br>

    <a href="index.php">Back to Home</a>

</main>

<footer>

    <p>MovingOnUp Management System</p>

</footer>

</body>

</html>
