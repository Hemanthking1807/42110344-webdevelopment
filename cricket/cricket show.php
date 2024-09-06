<?php
include 'dbcon.php';

$category = $_GET['category'] ?? '';

if (!in_array($category, ['Batters', 'Bowlers', 'All-rounders'])) {
    $category = '';
}

$sql = "SELECT * FROM players WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

$players = [];
while ($row = $result->fetch_assoc()) {
    $players[] = $row;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cricket Team Players</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cricket Team Players</h1>
        <select id="category" onchange="fetchPlayers()">
            <option value="">Select Category</option>
            <option value="Batters" <?php if ($category == 'Batters') echo 'selected'; ?>>Batters</option>
            <option value="Bowlers" <?php if ($category == 'Bowlers') echo 'selected'; ?>>Bowlers</option>
            <option value="All-rounders" <?php if ($category == 'All-rounders') echo 'selected'; ?>>All-rounders</option>
        </select>
        <div id="player-list">
            <?php if (empty($players)): ?>
                <p>No players found.</p>
            <?php else: ?>
                <?php foreach ($players as $player): ?>
                    <div class="player">
                        <img src="<?php echo htmlspecialchars($player['picture_url']); ?>" alt="<?php echo htmlspecialchars($player['name']); ?>">
                        <h2><?php echo htmlspecialchars($player['name']); ?></h2>
                        <p>Batting Order: <?php echo htmlspecialchars($player['batting_order']) ?: 'N/A'; ?></p>
                        <p>Batting Style: <?php echo htmlspecialchars($player['batting_style']) ?: 'N/A'; ?></p>
                        <p>Bowling Style: <?php echo htmlspecialchars($player['bowling_style']) ?: 'N/A'; ?></p>
                        <p>Additional Responsibility: <?php echo htmlspecialchars($player['additional_responsibility']) ?: 'N/A'; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
S