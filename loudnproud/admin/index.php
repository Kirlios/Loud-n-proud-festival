<?php
require_once __DIR__ . "/../config/database.php";

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db   = Database::connect();
    $stmt = $db->prepare("
        INSERT INTO artists (name, image_url, origin, stage, performance_day, popularity, is_headliner)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        trim($_POST['name']        ?? ''),
        trim($_POST['image_url']   ?? ''),
        trim($_POST['origin']      ?? 'US'),
        trim($_POST['stage']       ?? 'Main Stage'),
        trim($_POST['day']         ?? 'Day 1'),
        (int)($_POST['popularity'] ?? 0),
        isset($_POST['headliner']) ? 1 : 0,
    ]);
    $message = 'Artist added!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin — Add Artist</title>
    <style>
        body    { font-family: monospace; background:#111; color:#eee; padding:40px; }
        h1      { color:#ff2e63; margin-bottom:24px; }
        label   { display:block; font-size:12px; color:#888; margin-bottom:4px; margin-top:14px; letter-spacing:1px; text-transform:uppercase; }
        input, select { display:block; width:320px; padding:10px; background:#1a1a1a; border:1px solid #333; color:#eee; border-radius:6px; font-family:monospace; }
        button  { margin-top:20px; padding:12px 30px; background:#ff2e63; color:white; border:none; border-radius:6px; cursor:pointer; font-weight:bold; }
        .msg    { color:#00ff88; margin-bottom:20px; font-weight:bold; }
        .check  { display:flex; align-items:center; gap:10px; margin-top:14px; }
        .check input { width:auto; }
    </style>
</head>
<body>
    <h1>Add Artist</h1>
    <?php if ($message): ?>
        <p class="msg"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Name</label>
        <input name="name" placeholder="Kendrick Lamar" required>

        <label>Image URL (leave blank for Wikipedia auto-fetch)</label>
        <input name="image_url" placeholder="https://...">

        <label>Origin</label>
        <select name="origin">
            <option value="US">🇺🇸 US</option>
            <option value="UK">🇬🇧 UK</option>
            <option value="CZ">🇨🇿 CZ</option>
            <option value="SK">🇸🇰 SK</option>
        </select>

        <label>Stage</label>
        <input name="stage" placeholder="Main Stage">

        <label>Day</label>
        <select name="day">
            <option value="Day 1">Day 1</option>
            <option value="Day 2">Day 2</option>
        </select>

        <label>Popularity (0–100)</label>
        <input name="popularity" type="number" min="0" max="100" value="80">

        <div class="check">
            <input name="headliner" type="checkbox" id="hl">
            <label for="hl" style="margin:0">Headliner (shown on homepage)</label>
        </div>

        <button type="submit">Add Artist</button>
    </form>
</body>
</html>
