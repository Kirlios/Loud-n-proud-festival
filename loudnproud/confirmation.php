<?php
session_start();
require_once __DIR__ . "/app/models/Ticket.php";

if (!isset($_SESSION['last_order'])) {
    header('Location: index.php');
    exit;
}

$order = $_SESSION['last_order'];
$tickets = Ticket::all();
$ticketMap = [];
foreach ($tickets as $t) {
    $ticketMap[$t['id']] = $t;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed — LoudnProud Festival</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600;800;900&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex">
    <meta property="og:title" content="Order Confirmed — LoudnProud Festival">
</head>
<body>

<nav>
    <div class="logo"><a href="index.php" style="text-decoration:none;color:inherit;">LOUD<span>N</span>PROUD</a></div>
    <ul>
        <li><a href="lineup.php">Lineup</a></li>
        <li><a href="news.php">News</a></li>
        <li><a href="index.php#tickets">Tickets</a></li>
    </ul>
</nav>

<div class="confirmation-container">
    <div class="success-icon">✓</div>
    <h1>Order Confirmed!</h1>
    <p class="confirmation-text">Your tickets have been ordered. A confirmation email has been sent to <strong><?= htmlspecialchars($order['email']) ?></strong></p>

    <div class="order-details">
        <h2>Order Details</h2>
        
        <div class="detail-section">
            <h3>Contact Information</h3>
            <p><?= $order['name'] ?></p>
            <p><?= $order['email'] ?></p>
            <p><?= $order['phone'] ?></p>
        </div>

        <div class="detail-section">
            <h3>Shipping Address</h3>
            <p><?= $order['address'] ?></p>
            <p><?= $order['city'] ?>, <?= $order['postal'] ?></p>
            <p><?= $order['country'] ?></p>
        </div>

        <div class="detail-section">
            <h3>Tickets</h3>
            <?php
            $total = 0;
            foreach ($order['cart'] as $ticketId => $qty):
                if (!isset($ticketMap[$ticketId])) continue;
                $ticket = $ticketMap[$ticketId];
                $subtotal = $ticket['price'] * $qty;
                $total += $subtotal;
            ?>
                <div class="order-item">
                    <span><?= $qty ?>x <?= htmlspecialchars($ticket['name']) ?></span>
                    <span>€<?= $subtotal ?></span>
                </div>
            <?php endforeach; ?>
            <div class="order-total">
                <span>Total</span>
                <span>€<?= $total ?></span>
            </div>
        </div>
    </div>

    <a href="index.php" class="btn">Back to Home</a>
</div>

<footer>
    &copy; 2026 LoudnProud Festival
</footer>

</body>
</html>
