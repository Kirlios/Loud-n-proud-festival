<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News — LoudnProud Festival</title>
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/news.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;600;800;900&display=swap" rel="stylesheet">
    <meta name="description" content="Stay updated on venue changes, sustainability initiatives, and headliner announcements.">
    
    <meta property="og:type" content="article">
    <meta property="og:url" content="http://localhost/loudnproud/news.php">
    <meta property="og:title" content="Festival News & Announcements">
    <meta property="og:description" content="Read about our move to Letňany and our new sustainability goals for 2027.">
</head>
<body>

<nav>
    <div class="logo"><a href="index.php" style="text-decoration:none;color:inherit;">LOUD<span>N</span>PROUD</a></div>
    <ul>
        <li><a href="lineup.php">Lineup</a></li>
        <li><a href="news.php" class="active">News</a></li>
        <li><a href="index.php#tickets">Tickets</a></li>
        <li><a href="cart.php">Cart (<?= array_sum($_SESSION['cart'] ?? []) ?>)</a></li>
    </ul>
</nav>

<div class="news-hero">
    <h1>Festival <span>News</span></h1>
    <p>Stay updated with the latest announcements</p>
</div>

<div class="news-container">
    <article class="news-article">
        <div class="article-meta">
            <span class="article-date">March 1, 2026</span>
            <span class="article-tag">Venue Update</span>
        </div>
        <h2>New Main Stage Location Announced</h2>
        <div class="article-image" style="background: linear-gradient(135deg, #ff2e63 0%, #7b2fff 100%); height: 300px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 48px; font-weight: 900; color: white; opacity: 0.15;">
            🎪
        </div>
        <div class="article-content">
            <p>We're thrilled to announce that LoudnProud Festival 2027 will be moving to a brand new, purpose-built venue in Prague's Letňany district. The new site will feature three state-of-the-art stages with upgraded sound systems and improved sightlines for all attendees.</p>
            
            <p>The Main Stage has been relocated to accommodate larger crowds, with a capacity increase of 40%. This means more space, better views, and an enhanced festival experience for everyone. The new location is easily accessible via Metro Line C (Letňany station), with dedicated shuttle buses running throughout the festival.</p>
            
            <h3>What This Means For You:</h3>
            <ul>
                <li>Improved sound quality across all stages</li>
                <li>More food and beverage options with 15 new vendors</li>
                <li>Enhanced camping facilities with better amenities</li>
                <li>Easier access via public transport</li>
                <li>Additional restroom facilities (we heard you!)</li>
            </ul>

            <p>All previously purchased tickets remain valid. If you have any questions about the venue change, please check our FAQ or contact support.</p>
        </div>
    </article>

    <article class="news-article">
        <div class="article-meta">
            <span class="article-date">February 15, 2026</span>
            <span class="article-tag">Lineup</span>
        </div>
        <h2>J. Cole Joins as Headliner</h2>
        <div class="article-image" style="background: linear-gradient(135deg, #00ff88 0%, #0088ff 100%); height: 300px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 48px; font-weight: 900; color: white; opacity: 0.15;">
            🎤
        </div>
        <div class="article-content">
            <p>In an exciting development, we're proud to announce that J. Cole will be joining LoudnProud Festival 2027 as one of our headliners. The Grammy-winning artist will perform on the Black Stage on Day 1, bringing his critically acclaimed discography to Prague.</p>

            <p>J. Cole's addition to the lineup represents our commitment to bringing the absolute best in hip-hop to Central Europe. With hits spanning over a decade and a reputation for electrifying live performances, this is a show you won't want to miss.</p>

            <blockquote>
                "LoudnProud has always been about celebrating authentic hip-hop culture. Having J. Cole headline is a dream come true for us and for fans across CZ/SK and beyond."
                <cite>— Festival Director, Tomáš Novák</cite>
            </blockquote>

            <p>This brings our total headliner count to four incredible artists: Kendrick Lamar, Skepta, J. Cole, and EsDeeKid. Full day-by-day stage times will be announced in April 2027.</p>
        </div>
    </article>

    <article class="news-article">
        <div class="article-meta">
            <span class="article-date">January 28, 2026</span>
            <span class="article-tag">Sustainability</span>
        </div>
        <h2>Going Green: Our Sustainability Initiative</h2>
        <div class="article-image" style="background: linear-gradient(135deg, #00ff88 0%, #00cc66 100%); height: 300px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 48px; font-weight: 900; color: white; opacity: 0.15;">
            ♻️
        </div>
        <div class="article-content">
            <p>LoudnProud Festival is taking major steps toward becoming carbon-neutral by 2028. Starting with our 2027 edition, we're implementing comprehensive sustainability measures to reduce our environmental impact.</p>

            <h3>Our Green Commitments:</h3>
            <ul>
                <li><strong>Zero Single-Use Plastic:</strong> All food and beverage vendors will use compostable or reusable containers</li>
                <li><strong>Renewable Energy:</strong> 60% of stage power will come from solar panels and biodiesel generators</li>
                <li><strong>Waste Reduction:</strong> Comprehensive recycling stations with trained staff throughout the venue</li>
                <li><strong>Water Conservation:</strong> Low-flow fixtures and water refill stations to eliminate bottled water</li>
                <li><strong>Public Transport Incentives:</strong> Discounted tickets for attendees who arrive via train or bus</li>
            </ul>

            <p>We're also partnering with local environmental organizations to offset our carbon footprint through tree-planting initiatives in the Bohemian Forest. Every ticket purchased contributes to planting one tree.</p>

            <p>Festival-goers can expect clearly marked recycling zones, reusable cup deposits, and a dedicated "Green Team" to help ensure we leave the venue cleaner than we found it. Together, we can prove that massive music festivals and environmental responsibility can go hand in hand.</p>
        </div>
    </article>
</div>

<footer>
    &copy; 2026 LoudnProud Festival &mdash; <a href="index.php" style="color:var(--red)">Back to Home</a>
</footer>

</body>
</html>
