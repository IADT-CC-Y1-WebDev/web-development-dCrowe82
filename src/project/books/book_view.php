<?php
require_once __DIR__ . '/php/lib/config.php';
require_once __DIR__ . '/php/lib/utils.php';

try {
    $book = Book::findById($_GET["id"]);
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>book view</title>
</head>
<body>

<?php 

print_r($book ?? "book not found");

?>

<br>
<a href="book_list.php">return to list</a>
<a href="book_edit.php?id=<?= h($book->id) ?>">edit</a>
<a href="book_delete.php?id=<?= h($book->id) ?>">delete</a>

</body>
</html>