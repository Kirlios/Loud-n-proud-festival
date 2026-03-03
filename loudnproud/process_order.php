<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// Validate email
$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
if (!$email) {
    die('Invalid email address');
}

// Validate phone (basic check - numbers only after removing spaces/dashes)
$phone = preg_replace('/[^0-9]/', '', $_POST['phone'] ?? '');
if (strlen($phone) < 6 || strlen($phone) > 15) {
    die('Invalid phone number');
}

// In a real app, you'd:
// 1. Save order to database
// 2. Process payment
// 3. Send confirmation email

// For now, just clear cart and show success
$orderData = [
    'name'     => htmlspecialchars($_POST['name']),
    'email'    => $email,
    'phone'    => htmlspecialchars($_POST['country_code'] . ' ' . $_POST['phone']),
    'address'  => htmlspecialchars($_POST['address']),
    'city'     => htmlspecialchars($_POST['city']),
    'postal'   => htmlspecialchars($_POST['postal']),
    'country'  => htmlspecialchars($_POST['country']),
    'cart'     => $_SESSION['cart'],
    'timestamp' => date('Y-m-d H:i:s')
];

$_SESSION['last_order'] = $orderData;
$_SESSION['cart'] = [];

header('Location: confirmation.php');
exit;
