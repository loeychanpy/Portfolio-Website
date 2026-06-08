<?php
mysqli_report(MYSQLI_REPORT_OFF);

// Test 1: direct connection
$conn = new mysqli('127.0.0.1', 'root', '', '20222_wp2_412024033', 3307);
echo 'Connection attempt: ';
echo $conn->connect_errno ? 'FAIL — ' . $conn->connect_error : 'OK';
echo '<br><br>';

// Test 2: exact hex of every DB name
$conn2 = new mysqli('127.0.0.1', 'root', '', '', 3307);
$result = $conn2->query('SHOW DATABASES');
echo '<pre>';
while ($row = $result->fetch_row()) {
    $name = $row[0];
    echo str_pad(strlen($name), 3) . ' bytes | hex: ' . bin2hex($name) . ' | "' . htmlspecialchars($name) . '"' . "\n";
}
echo '</pre>';
$conn2->close();
