<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

try {
    $formats = Format::findAll();
    $publishers = Publisher::findAll();
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="navbar">
        <div class="container">
            <div class="width-4 navbarLeft">
                <h1><a href="index.php"> Books </a></h1>
                <a class="button" href="book_create.php">Add Book</a>
            </div>

            <div class="width-8">
                <form class="filterContainer">
                    <div>
                        <label for="title_filter">Title</label>
                        <input type="text" id="title_filter" name="title_filter">
                    </div>
                    <div>
                        <label for="genre_filter">Formats</label>
                        <select id="genre_filter" name="genre_filter">
                            <option value="">All Formats</option>
                            <?php foreach ($formats as $format) { ?>
                                <option value="<?= h($format->id) ?>"><?= h($format->name) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label for="platform_filter">Publisher</label>
                        <select id="platform_filter" name="platform_filter">
                            <option value="">All Publishers</option>
                            <?php foreach ($publishers as $publisher) { ?>
                                <option value="<?= h($publisher->id) ?>"><?= h($publisher->name) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <button type="button" id="apply_filters">Apply Filters</button>
                        <button type="button" id="clear_filters">Clear Filters</button>
                    </div>
                </form>
            </div>

        </div>
        
    </div>
</body>
</html>