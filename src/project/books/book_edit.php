<?php

require_once './php/lib/config.php';
require_once './php/lib/session.php';
require_once './php/lib/forms.php';
require_once './php/lib/utils.php';

// Start the session
startSession();

try {
    $book = Book::findById($_GET["id"]);

    $bookFormats = Format::findByBook($book->id);
    $bookFormatIds = [];
    foreach ($bookFormats as $format) {
        $bookFormatIds[] = $format->id;
    }

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
    <title>Edit Book</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Display form data and errors for debugging purposes                 -->
    <!-- <?php dd(getFormData()); ?>
    <?php dd(getFormErrors()); ?> -->

    <div class="container"><div class="width-12">

    <form action="book_update.php" method="POST" enctype="multipart/form-data">

        

        <div class="form-group">
            <div class="input">
                <input type="hidden" name="id" value="<?= h($book->id) ?>">
            </div>

            <label for="title">Book Title:</label>

            <input type="text" id="title" name="title" value="<?= h(old("title", $book->title)) ?>">

            <?php if (error("title")): ?>
                <p class="error"><?= error("title") ?></p>
            <?php endif;?>

        </div>

        <div class="form-group">
            <label for="author">Author:</label>

            <input type="text" id="author" name="author" value="<?= h(old("author", $book->author)) ?>">

             <?php if (error("author")): ?>
                <p class="error"><?= error("year") ?></p>
            <?php endif;?>

        </div>

        <div class="form-group">
            <label for="publisher_id">Publisher:</label>
            <select id="publisher_id" name="publisher_id">
                <option value="">-- Select Publisher --</option>

                <?php foreach ($publishers as $pub): ?>
                    <option value="<?= $pub->id ?>" <?= chosen("publisher_id", $pub->id, $book->publisher_id) ? "selected" : "" ?>>
                        <?= h($pub->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>

             <?php if (error("publisher_id")): ?>
                <p class="error"><?= error("publisher_id") ?></p>
            <?php endif;?>

        </div>

        <div class="form-group">
            <label for="year">Year:</label>

            <input type="text" id="year" name="year" value="<?= h(old("year", $book->year)) ?>">

            <?php if (error("year")): ?>
                <p class="error"><?= error("year") ?></p>
            <?php endif;?>

        </div>

        <div class="form-group">
            <label for="isbn">ISBN:</label>

            <input type="text" id="isbn" name="isbn" value="<?= h(old("isbn", $book->isbn)) ?>">

             <?php if (error("isbn")): ?>
                <p class="error"><?= error("isbn") ?></p>
            <?php endif;?>

        </div>

        <div class="form-group">
            <label>Available Formats:</label>
            <div class="checkbox-group">

                <?php foreach ($formats as $format): ?>
                    <label class="checkbox-label">
                        <input 
                            type="checkbox" 
                            name="format_ids[]" 
                            value="<?= h($format->id) ?>" 
                            <?= chosen("format_ids", $format->id, $bookFormatIds) ? "checked" : "" ?>
                        >
                        <?= h($format->name) ?>
                    </label>
                <?php endforeach; ?>
            </div>

             <?php if (error("format_ids")): ?>
                <p class="error"><?= error("format_ids") ?></p>
            <?php endif;?>

        </div>

        <div class="form-group">
            <label for="description">Description:</label>

            <textarea id="description" name="description" rows="5"><?= h(old("description", $book->description)) ?></textarea>

             <?php if (error("description")): ?>
                <p class="error"><?= error("description") ?></p>
            <?php endif;?>

        </div>

        <div class="form-group">

            <img src="images/<?= $book->cover_filename ?>">
            
            <label for="cover">Book Cover Image (max 2MB):</label>

            <input type="file" id="cover" name="cover" accept="image/*">

             <?php if (error("cover")): ?>
                <p class="error"><?= error("cover") ?></p>
            <?php endif;?>

        </div>

        <div class="form-group">
            <button type="submit" class="button">Save Book</button>
        </div>
    </form>

    </div></div>

    <!-- =================================================================== -->
    <!-- STEP 10: Clean Up                                                   -->
    <!-- See: /examples/04-php-forms/step-10-complete/                       -->
    <!-- =================================================================== -->
    <!-- TODO: Clear form data and errors after displaying the page          -->
    <?php
    //   Clear form data and errors
    ?>
    </body>
</html>