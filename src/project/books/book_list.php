<?php
require_once __DIR__ . '/php/lib/config.php';
require_once __DIR__ . '/php/lib/utils.php';

try {
    $books = Book::findAll();
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>book list</title>
</head>
<body>

<div>

<table>
    <tr>
        <?php foreach ($books[0] as $key => $val): ?>
            <th><?= $key; ?></th>
        <?php endforeach;?>
    </tr>
    
    <?php foreach ($books as $book): ?>
        <tr>
            <?php foreach ($book->toArray() as $key => $val): ?>
                <td><?= $val ?></td>
            <?php endforeach; ?>
            <td><a href="book_view.php?id=<?= h($book->id) ?>">view</a></td>
            <td><a href="book_edit.php?id=<?= h($book->id) ?>">edit</a></td>
            <td><a href="book_delete.php?id=<?= h($book->id) ?>">delete</a></td>
        </tr>
    <?php endforeach; ?>
    
    <tr>
        <td>
            <a href="book_create.php">create new</a>
        </td>
    </tr>

</table>

<div>

</body>
</html>