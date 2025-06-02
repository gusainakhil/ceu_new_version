<?php
include "connect.php";

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $categories = $_POST['title'];

//     $data = array();

//     $sql1=mysqli_query($con,"SELECT * FROM `selling_category` ");
//     while($row1=mysqli_fetch_assoc($sql1)){
//         // echo $row1['name'];
//         $key='key'.$row1['id'];
//         // print_r($_POST[$key]);
//         $value='value'.$row1['id'];
//         // print_r($_POST[$value]);

//         // Assuming you want to store the data in the desired format
//         $categoryData = array();
//         for ($i = 0; $i < count($_POST[$key]); $i++) {
//             $categoryData[$_POST[$key][$i]] = $_POST[$value][$i];
//         }

//         $data[$row1['name']] = $categoryData;
//     }

// print_r($data);
$data = array(
    "Live Options" =>
    array("1 Attendee" => "$199", "2 Attendee (Save $69)" => "$329", "3 Attendee (Save $140)" => "$457", "4 Attendee (Save $180)" => "$616", "5 Attendee (Save $220)" => "$775"),
    "Super Saver Options" =>
    array("6 Attendee (Save $300)" => "$894", "7 Attendee (Save $393)" => "$1000", "8 Attendee (Save $492)" => "$1100", "9 Attendee (Save $591)" => "$1200", "10 Attendee (Save $690)" => "$1300"),
    "Recording & Combos" =>
    array("1 Recording (Save $300)" => "$894", "2 Recordings (Save $393)" => "$1000", "3 Recordings (Save $492)" => "$1100", "e-Transcript (Save $591)" => "$1200", "Live + Recording (Save $690)" => "$1300", "Live + e-Transcript (Save $690)" => "$1300", "Recording + e-Transcript (Save $690)" => "$1300", "Live + Recording + e-Transcript (Save $690)" => "$1300")
);
print_r($data);

// $data['Live Options']['2 Attendee (Save $69)'] = "3000";
$data['Live Options'] = ['sdfhdfh' => $data['Live Options']['1 Attendee']] + $data['Live Options'];
unset($data['Live Options']['1 Attendee']);
echo "<br><br>";
foreach ($data as $key => $innerArray) {
    echo "$key: <br>";

    foreach ($innerArray as $name => $amount) {
        echo "$name = $amount<br>";
    }

    echo "<br>";
}



// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <?php
        $sql = mysqli_query($con, "SELECT * FROM `selling_category` ");
        $keyCount = 2; // Change this value based on the number of key-value pairs per category

        while ($row = mysqli_fetch_assoc($sql)) {
        ?>
            <h2><?php echo $row['name'] ?></h2>
            <input type="hidden" name="title[]" value="<?php echo $row['name'] ?>">

            <!-- Key-Value Pairs for the current category -->
            <?php for ($i = 0; $i < $keyCount; $i++) { ?>
                <input type="text" name="key<?php echo $row['id'] ?>[]" placeholder="Key">
                <input type="text" name="value<?php echo $row['id'] ?>[]" placeholder="Value">
            <?php } ?>
        <?php } ?>
        <input type="submit" name="submit">
    </form>
</body>

</html>

<!-- 
Array ( 
    [Live Options] => 
        Array ( [1 Attendee] => $199 [2 Attendee (Save $69)] => $329 [3 Attendee (Save $140)] => $457 [4 Attendee (Save $180)] => $616 [5 Attendee (Save $220)] => $775 ) 
    [Super Saver Options] => 
        Array ( [6 Attendee (Save $300)] => $894 [7 Attendee (Save $393)] => $1000 [8 Attendee (Save $492)] => $1100 [9 Attendee (Save $591)] => $1200 [10 Attendee (Save $690)] => $1300 ) 
    [Recording & Combos] => 
        Array ( [1 Recording (Save $300)] => $894 [2 Recordings (Save $393)] => $1000 [3 Recordings (Save $492)] => $1100 [e-Transcript (Save $591)] => $1200 [Live + Recording (Save $690)] => $1300 [Live + e-Transcript (Save $690)] => $1300 [Recording + e-Transcript (Save $690)] => $1300 [Live + Recording + e-Transcript (Save $690)] => $1300 )  
) -->