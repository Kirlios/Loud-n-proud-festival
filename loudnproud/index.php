<?php
require_once __DIR__ . "/app/models/Artist.php";
require_once __DIR__ . "/app/models/Ticket.php";

$artists = Artist::getMainLineup();
$tickets = Ticket::all();

// Fetch Wikipedia images for headliners
foreach ($artists as &$artist) {
    if (empty(trim($artist['image_url']))) {
        $artist['image_url'] = Artist::getWikipediaImage($artist['name']);
    }
}
unset($artist);

function originFlag(string $o): string {
    return match($o) {
        'US' => '🇺🇸', 'UK' => '🇬🇧',
        'CZ' => '🇨🇿', 'SK' => '🇸🇰',
        default => '🌍'
    };
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoudnProud Festival</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600;800;900&display=swap" rel="stylesheet">
</head>
<body>

<nav>
    <div class="logo">LOUD<span>N</span>PROUD</div>
    <ul>
        <li><a href="lineup.php">Lineup</a></li>
        <li><a href="#tickets">Tickets</a></li>
    </ul>
</nav>

<section class="hero">
    <h1>The Loudest Festival in <span>Europe</span></h1>
    <p>CZ/SK &bull; USA &bull; UK Hip-Hop Scene</p>
    <div id="countdown"></div>
    <a class="btn" href="#tickets">Buy Tickets</a>
</section>

<section class="lineup" id="lineup">
    <h2 class="section-title">Headliners</h2>

    <div class="artists">
        <?php foreach ($artists as $artist): ?>
            <div class="artist-card">
                <?php if (!empty($artist['image_url'])): ?>
                    <img src="<?= htmlspecialchars($artist['image_url']) ?>"
                         alt="<?= htmlspecialchars($artist['name']) ?>"
                         loading="lazy">
                <?php else: ?>
                    <div class="img-fallback"><?= strtoupper($artist['name'][0]) ?></div>
                <?php endif; ?>
                <div class="artist-card-body">
                    <h3><?= htmlspecialchars($artist['name']) ?></h3>
                    <p class="meta">
                        <?= originFlag($artist['origin']) ?>
                        <span><?= htmlspecialchars($artist['stage']) ?></span>
                        &bull; <?= htmlspecialchars($artist['performance_day']) ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div style="text-align:center; margin-top:50px;">
        <a class="btn" href="lineup.php">Full Lineup &rarr;</a>
    </div>
</section>

<section class="tickets" id="tickets">
    <h2 class="section-title">Tickets</h2>

    <div class="ticket-wrapper">
        <?php foreach ($tickets as $ticket): ?>
            <div class="ticket">
                <h2><?= htmlspecialchars($ticket['name']) ?></h2>
                <div class="price"><?= (int)$ticket['price'] ?></div>
                <p><?= htmlspecialchars($ticket['description']) ?></p>
                <a class="btn" href="#">Buy Now</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<footer>
    &copy; 2026 LoudnProud Festival
</footer>

<script src="public/js/script.js"></script>
</body>
</html>
