<?php
session_start();
require_once __DIR__ . "/app/models/Artist.php";

$all  = Artist::all();
$days = Artist::days();

// Fetch Wikipedia images for all artists
foreach ($all as &$artist) {
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
    <title>Full Lineup — LoudnProud Festival</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/lineup.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600;800;900&display=swap" rel="stylesheet">
    <meta name="description" content="Check out the full 2027 lineup featuring 20+ artists across 3 stages.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://localhost/loudnproud/lineup.php">
    <meta property="og:title" content="LoudnProud 2027: Full Lineup">
    <meta property="og:description" content="From Kendrick Lamar to local legends like Separ and Kontrafakt. View the full schedule.">
    <meta property="og:image" content="/public/images/loudnproudlogo.png">
</head>
<body>

<nav>
    <div class="logo">
        <a href="index.php" style="text-decoration:none;color:inherit;">LOUD<span>N</span>PROUD</a>
    </div>
    <ul>
        <li><a href="lineup.php" class="active">Lineup</a></li>
        <li><a href="news.php">News</a></li>
        <li><a href="index.php#tickets">Tickets</a></li>
        <li><a href="cart.php">Cart (<?= array_sum($_SESSION['cart'] ?? []) ?>)</a></li>
    </ul>
</nav>

<section class="lineup-hero">
    <p class="lineup-eyebrow">May 28–29, 2027 &bull; Prague</p>
    <h1>Full <span>Lineup</span></h1>
    <p class="lineup-sub"><?= count($all) ?> artists &bull; 3 stages &bull; 2 days</p>
</section>

<div class="filter-bar">
    <button class="filter-btn active" data-filter="all">All</button>
    <?php foreach ($days as $day): ?>
        <button class="filter-btn" data-filter="<?= htmlspecialchars($day) ?>">
            <?= htmlspecialchars($day) ?>
        </button>
    <?php endforeach; ?>
    <button class="filter-btn" data-filter="US">🇺🇸 US</button>
    <button class="filter-btn" data-filter="UK">🇬🇧 UK</button>
    <button class="filter-btn" data-filter="CZ">🇨🇿 CZ</button>
    <button class="filter-btn" data-filter="SK">🇸🇰 SK</button>
</div>

<section class="lineup-section">
    <div class="lineup-grid">
        <?php foreach ($all as $artist): ?>
            <div class="lineup-card <?= $artist['is_headliner'] ? 'headliner' : '' ?>"
                 data-day="<?= htmlspecialchars($artist['performance_day']) ?>"
                 data-origin="<?= htmlspecialchars($artist['origin']) ?>">

                <?php if ($artist['is_headliner']): ?>
                    <div class="headliner-badge">HEADLINER</div>
                <?php endif; ?>

                <div class="lineup-card-img">
                    <?php if (!empty($artist['image_url'])): ?>
                        <img src="<?= htmlspecialchars($artist['image_url']) ?>"
                             alt="<?= htmlspecialchars($artist['name']) ?>"
                             loading="lazy"
                             onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                        <div class="img-fallback" style="display:none">
                            <?= strtoupper($artist['name'][0]) ?>
                        </div>
                    <?php else: ?>
                        <div class="img-fallback"><?= strtoupper($artist['name'][0]) ?></div>
                    <?php endif; ?>
                </div>

                <div class="lineup-card-body">
                    <div class="lineup-origin">
                        <?= originFlag($artist['origin']) ?> <?= htmlspecialchars($artist['origin']) ?>
                    </div>
                    <h3><?= htmlspecialchars($artist['name']) ?></h3>
                    <div class="lineup-meta">
                        <span class="lineup-stage"><?= htmlspecialchars($artist['stage']) ?></span>
                        <span class="lineup-day"><?= htmlspecialchars($artist['performance_day']) ?></span>
                    </div>
                    <div class="popularity-bar">
                        <div class="popularity-fill" style="width:<?= (int)$artist['popularity'] ?>%"></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<footer>
    &copy; 2026 LoudnProud Festival &mdash;
    <a href="index.php" style="color:var(--red)">Back to Home</a>
</footer>

<script>
const btns  = document.querySelectorAll('.filter-btn');
const cards = document.querySelectorAll('.lineup-card');

btns.forEach(btn => {
    btn.addEventListener('click', () => {
        btns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const f = btn.dataset.filter;
        cards.forEach(card => {
            card.style.display =
                (f === 'all' || card.dataset.day === f || card.dataset.origin === f)
                ? '' : 'none';
        });
    });
});
</script>

</body>
</html>
