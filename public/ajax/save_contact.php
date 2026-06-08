<?php
header('Content-Type: application/json');

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (!$data) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid data format.']);
    exit;
}

$name    = trim($data['name']    ?? '');
$email   = trim($data['email']   ?? '');
$message = trim($data['message'] ?? '');
$subject = trim($data['subject'] ?? 'Contact Form Message');

if (!$name || !$email || !$message) {
    echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['status' => 'error', 'message' => 'Please enter a valid email address.']);
    exit;
}

$conn = new mysqli('127.0.0.1', 'root', '', '20222_wp2_412024033', 3307);

if ($conn->connect_errno) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit;
}

$stmt = $conn->prepare('INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)');
$stmt->bind_param('ssss', $name, $email, $subject, $message);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Thank you! Your message has been sent successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to save message. Please try again.']);
}

$stmt->close();
$conn->close();
