<?php
session_start();
require_once __DIR__ . "/app/models/Ticket.php";

// Initialize cart
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add' && isset($_POST['ticket_id'])) {
        $id = (int)$_POST['ticket_id'];
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    } elseif ($_POST['action'] === 'update' && isset($_POST['ticket_id'], $_POST['quantity'])) {
        $id  = (int)$_POST['ticket_id'];
        $qty = max(0, (int)$_POST['quantity']);
        if ($qty === 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    } elseif ($_POST['action'] === 'clear') {
        $_SESSION['cart'] = [];
    }
    header('Location: cart.php');
    exit;
}

// Get cart items
$cartItems = [];
$total = 0;
if (!empty($_SESSION['cart'])) {
    $tickets = Ticket::all();
    foreach ($tickets as $ticket) {
        if (isset($_SESSION['cart'][$ticket['id']])) {
            $qty = $_SESSION['cart'][$ticket['id']];
            $cartItems[] = [
                'ticket' => $ticket,
                'quantity' => $qty,
                'subtotal' => $ticket['price'] * $qty
            ];
            $total += $ticket['price'] * $qty;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600;800;900&display=swap" rel="stylesheet">
    <title>Your Cart — LoudnProud Festival</title>
    <meta name="robots" content="noindex">
    <meta property="og:title" content="Secure Checkout — LoudnProud">
</head>
<body>

<nav>
    <div class="logo"><a href="index.php" style="text-decoration:none;color:inherit;">LOUD<span>N</span>PROUD</a></div>
    <ul>
        <li><a href="lineup.php">Lineup</a></li>
        <li><a href="news.php">News</a></li>
        <li><a href="index.php#tickets">Tickets</a></li>
        <li><a href="cart.php" class="active">Cart (<?= array_sum($_SESSION['cart'] ?? []) ?>)</a></li>
    </ul>
</nav>

<div class="cart-container">
    <h1>Your Cart</h1>

    <?php if (empty($cartItems)): ?>
        <div class="empty-cart">
            <p>Your cart is empty</p>
            <a href="index.php#tickets" class="btn">Browse Tickets</a>
        </div>
    <?php else: ?>
        <div class="cart-content">
            <!-- CART ITEMS -->
            <div class="cart-items">
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <div class="item-info">
                            <h3><?= htmlspecialchars($item['ticket']['name']) ?></h3>
                            <p><?= htmlspecialchars($item['ticket']['description']) ?></p>
                        </div>
                        <div class="item-price">€<?= $item['ticket']['price'] ?></div>
                        <form method="POST" class="item-quantity">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="ticket_id" value="<?= $item['ticket']['id'] ?>">
                            <button type="submit" name="quantity" value="<?= $item['quantity'] - 1 ?>">−</button>
                            <span><?= $item['quantity'] ?></span>
                            <button type="submit" name="quantity" value="<?= $item['quantity'] + 1 ?>">+</button>
                        </form>
                        <div class="item-subtotal">€<?= $item['subtotal'] ?></div>
                    </div>
                <?php endforeach; ?>

                <form method="POST" class="clear-cart">
                    <input type="hidden" name="action" value="clear">
                    <button type="submit">Clear Cart</button>
                </form>
            </div>

            <!-- CHECKOUT FORM -->
            <div class="checkout-form">
                <h2>Checkout</h2>
                <div class="order-summary">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>€<?= $total ?></span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span>€<?= $total ?></span>
                    </div>
                </div>

                <form id="checkoutForm" action="process_order.php" method="POST">
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" name="name" required>
                    </div>

                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" id="email" required>
                        <span class="error" id="emailError"></span>
                    </div>

                    <div class="form-group">
                        <label>Phone Number *</label>
                        <div class="phone-input">
                            <select name="country_code" id="countryCode">
                                <option value="+421">🇸🇰 +421</option>
                                <option value="+420">🇨🇿 +420</option>
                                <option value="+1">🇺🇸 +1</option>
                                <option value="+44">🇬🇧 +44</option>
                                <option value="+49">🇩🇪 +49</option>
                                <option value="+33">🇫🇷 +33</option>
                                <option value="+39">🇮🇹 +39</option>
                                <option value="+34">🇪🇸 +34</option>
                                <option value="+31">🇳🇱 +31</option>
                                <option value="+48">🇵🇱 +48</option>
                                <option value="+43">🇦🇹 +43</option>
                            </select>
                            <input type="tel" name="phone" id="phone" placeholder="123 456 789" required>
                        </div>
                        <span class="error" id="phoneError"></span>
                    </div>

                    <div class="form-group">
                        <label>Address *</label>
                        <input type="text" name="address" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>City *</label>
                            <input type="text" name="city" required>
                        </div>
                        <div class="form-group">
                            <label>Postal Code *</label>
                            <input type="text" name="postal" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Country *</label>
                        <select name="country" required>
                            <option value="">Select country</option>
                            <option value="SK">Slovakia</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="US">United States</option>
                            <option value="UK">United Kingdom</option>
                            <option value="DE">Germany</option>
                            <option value="FR">France</option>
                            <option value="IT">Italy</option>
                            <option value="ES">Spain</option>
                            <option value="NL">Netherlands</option>
                            <option value="PL">Poland</option>
                            <option value="AT">Austria</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-checkout">Complete Purchase — €<?= $total ?></button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>

<footer>
    &copy; 2026 LoudnProud Festival
</footer>

<script src="public/js/cart.js"></script>
</body>
</html>
