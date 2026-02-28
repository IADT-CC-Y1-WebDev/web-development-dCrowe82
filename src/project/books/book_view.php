<?php
require_once __DIR__ . '/php/lib/config.php';
require_once __DIR__ . '/php/lib/utils.php';

try {
    $book = Book::findById($_GET["id"]);

    $publisher = Publisher::findById($book->id);

    $formats = Format::findByBook($book->id);
    $formatNames = [];
    foreach ($formats as $format) {
        $formatNames[] = h($format->name);
    }
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>book view</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container" style="margin:auto;">
    <div class="width-3">
        <img src="images/<?= h($book->cover_filename) ?>" alt="Image for <?= h($book->title) ?>" />
        
    </div>

    <div class="width-9">
        <div class="view">
            
            <div class="content">
                <h2><span>Title:</span> <?= h($book->title) ?></h2>
                <p><span>Author:</span> <?= h($book->author) ?></p>
                <p><span>Release Year:</span> <?= h($book->year) ?></p>
                <p><span>Publisher:</span> <?= h($publisher->name) ?></p>
                <p><span>Formats:</span> <?= implode(', ', $formatNames) ?></p>
                <p><span>Description:</span> <?= h($book->description) ?></p>
                <p><span>ISBN:</span> <?= h($book->isbn) ?></p>
                <p><span>Cover file name:</span> <?= h($book->cover_filename) ?></p>
            </div>
            
            <div class="actions">
                <a href="index.php">Return</a> | 
                <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a> |
                <a href="book_delete.php?id=<?= h($book->id) ?>">Delete</a>
            </div>

        </div>
    </div>
</div>


</body>
</html>