<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstName = trim($_POST['FirstName'] ?? '');
    $lastName = trim($_POST['LastName'] ?? '');
    $password = $_POST['RepPassword'] ?? '';
    $repNumber = trim($_POST['RepNumber'] ?? '');
    $phoneNumber = trim($_POST['PhoneNumber'] ?? '');
    $option = $_POST['option'] ?? '';

    $emailCheck = isset($_POST['emailCheck']);
    $email = $emailCheck ? trim($_POST['Email'] ?? '') : '';

    if ($emailCheck && empty($email)) {
        echo "<script>
            alert('Please enter your email address.');
            window.location.href = 'index.php';
        </script>";
        exit();
    }

    $sql = "SELECT * FROM movingrepresentatives
            WHERE FirstName = ?
            AND LastName = ?
            AND RepPassword = ?
            AND RepNumber = ?
            AND PhoneNumber = ?";

    if ($emailCheck) {
        $sql .= " AND Email = ?";
    }

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    if ($emailCheck) {
        $stmt->bind_param(
            "ssssss",
            $firstName,
            $lastName,
            $password,
            $repNumber,
            $phoneNumber,
            $email
        );
    } else {
        $stmt->bind_param(
            "sssss",
            $firstName,
            $lastName,
            $password,
            $repNumber,
            $phoneNumber
        );
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $representative = $result->fetch_assoc();

        session_regenerate_id(true);

        $_SESSION['RepID'] = $representative['RepID'];

        $_SESSION['RepName'] =
            $representative['FirstName'] . " " .
            $representative['LastName'];

        $stmt->close();
        $conn->close();

        switch ($option) {

            case "search":
                header("Location: search.php");
                break;

            case "book":
                header("Location: book.php");
                break;

            case "cancel":
                header("Location: cancel.php");
                break;

            case "instructions":
                header("Location: instructions.php");
                break;

            case "update":
                header("Location: update_instructions.php");
                break;

            case "create":
                header("Location: create_client.php");
                break;

            default:
                header("Location: index.php");
                break;
        }

        exit();

    } else {

        $stmt->close();
        $conn->close();

        echo "<script>
            alert('Invalid representative information. Please try again.');
            window.location.href = 'index.php';
        </script>";
        exit();
    }

} else {
    header("Location: index.php");
    exit();
}
?>
