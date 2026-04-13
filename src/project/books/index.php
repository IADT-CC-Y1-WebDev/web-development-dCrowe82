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
<?php include 'php/inc/navbar.php'; ?>
<div class="container">

    <div class="width-12">
        <?php require 'php/inc/flash_message.php'; ?>
    </div>

    <div class="width-12 cards" id="bookCards">

        <?php 
            foreach ($books as $book): 
                $formats = Format::findByBook($book->id);
                $formatIds = [];
                foreach ($formats as $format) {
                    $formatIds[] = h($format->id);
                }
        ?>
        <div class="card" 
            data-title="<?= h($book->title) ?>"
            data-publisher="<?= h($book->publisher_id) ?>"
            data-formats="<?= implode(', ', $formatIds) ?>"
            data-year="<?= h($book->year) ?>">
            
            <div class="top-content">
                <a href="book_view.php?id=<?= h($book->id) ?>"><img src="images/<?= h($book->cover_filename) ?>" alt="Image for <?= h($book->title) ?>" /></a>
            </div>

            <div class="bottom-content">
                <h2><?= h($book->title) ?></h2>
                <p><?= h($book->author) ?>, <?= h($book->year) ?></p>
                <div class="actions">
                    <a href="book_view.php?id=<?= h($book->id) ?>">View</a>|
                    <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a>| 
                    <button onclick="openDelete(<?= h($book->id) ?>)">Delete</button>
                </div>
            </div>
            
        </div>
        <?php endforeach; ?>

    </div>

</div>

<div class="modal-overlay hidden" id="modal">
    <div class="modal-box">
        <h2 id="whatBook">default</h2>
        <div>
            <button onclick="cancelDelete()">Cancel</button>
            <a id="confirm" href="book_delete.php?id=">Delete</a>
        </div>
    </div>
<div>

<script src="js/filters.js"></script>
<script src="js/delete_confirm.js"></script>

</body>    
</html>