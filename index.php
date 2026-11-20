<?php
session_start();
include 'db_connect.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>MovingOnUp - Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>MovingOnUp</h1>
    <p>Your Moving Management System</p>
</header>

<main>

    <h2>Representative Login</h2>

    <form action="/movingonup/login.php" method="POST">

        <label>First Name:</label>
        <input type="text" name="FirstName" required>

        <label>Last Name:</label>
        <input type="text" name="LastName" required>

        <label>Password:</label>
        <input type="password" name="RepPassword" required>

        <label>Representative ID:</label>
        <input type="text" name="RepNumber" required>

        <label>Phone Number:</label>
        <input type="text" name="PhoneNumber" required>

        <label>
            <input type="checkbox"
                   id="emailCheck"
                   name="emailCheck"
                   value="yes">
            Verify Email Address
        </label>

        <div id="emailSection" style="display:none;">

            <label>Email Address:</label>
            <input type="email" name="Email">

        </div>

        <label>Select an Option:</label>

        <select name="option" required>

            <option value="">Choose an option</option>

            <option value="search">
                Search Representative Account
            </option>

            <option value="book">
                Book a Client's Moving Event
            </option>

            <option value="cancel">
                Cancel a Client's Moving Event
            </option>

            <option value="instructions">
                Special Instructions for Move
            </option>

            <option value="update">
                Update Special Instructions
            </option>

            <option value="create">
                Create a New Client Account
            </option>

        </select>

        <button type="submit">Login</button>

    </form>

</main>

<footer>
    <p>MovingOnUp Management System</p>
</footer>

<script>

document.getElementById("emailCheck").addEventListener("change", function() {

    document.getElementById("emailSection").style.display =
        this.checked ? "block" : "none";

});

</script>

</body>
</html>
