<?php 
include 'db_connect.php';

$sql = "SELECT * FROM staff_info";
$result = $conn->query($sql);


// Initialize variables to store the total and individual counts for each grade
$total = 0;
$count_dg = 0;
$count_n = 0;
$count_f = 0;
$count_j = 0;

// Loop through the query result to calculate the total and individual counts for each grade
while ($row = $result->fetch_assoc()) {
  $total += $row['edu'] + $row['adm'] + $row['it'] + $row['eng']; // Calculate the overall total

  // Update the respective count for each grade
  $count_dg += $row['edu'];
  $count_n += $row['adm'];
  $count_f += $row['it'];
  $count_j += $row['eng'];
}

// Calculate the percentages
$percentage_dg = ($count_dg / $total) * 100;
$percentage_n = ($count_n / $total) * 100;
$percentage_f = ($count_f / $total) * 100;
$percentage_j = ($count_j / $total) * 100;

// Create an associative array with grade as key and percentage as value
$grades_percentage = array(
  'DG' => $percentage_dg,
  'N' => $percentage_n,
  'F' => $percentage_f,
  'J' => $percentage_j
);

// Encode the $grades_percentage array into JSON
$grades_percentage_json = json_encode($grades_percentage);



?>