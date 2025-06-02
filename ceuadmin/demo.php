<!DOCTYPE html>
<html>
<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = date('F j, Y', strtotime($_POST['date']));
    echo $date;
}
?>


<form method="post">
E-mail: <input type="date" name="date"><br>
<input type="submit">
</form>

</body>
</html>
