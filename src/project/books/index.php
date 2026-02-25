<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

try {
    $books = Book::findAll();
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
    <title>Books</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">
    <div class="width-12 cards">

        <?php foreach ($books as $book): ?>
        <div class="card">
            <div class="top-content">
                <h2>Title: <?= h($book->title) ?></h2>
                <p>Release Year: <?= h($book->year) ?></p>
            </div>
            <div class="bottom-content">
                <img src="images/<?= h($book->cover_filename) ?>" alt="Image for <?= h($book->title) ?>" />
                <div class="actions">
                    <a href="book_view.php?id=<?= h($book->id) ?>">View</a>/ 
                    <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a>/ 
                    <a href="book_delete.php?id=<?= h($book->id) ?>">Delete</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>

</body>
</html>