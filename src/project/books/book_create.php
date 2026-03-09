<?php

require_once './php/lib/config.php';
require_once './php/lib/session.php';
require_once './php/lib/forms.php';
require_once './php/lib/utils.php';

// Start the session
startSession();

$publishers = Publisher::findAll();
$formats = Format::findAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Book</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'php/inc/navbar.php'; ?>

    <div class="container">

        <div class="width-3"></div>
        <div class="width-9">
            <?php require 'php/inc/flash_message.php'; ?>
        </div>
        
        <div class="width-3"></div>
        <div class="width-9">
            <h1>Create Book</h1>
        </div>

        <div class="width-3"></div>
        <div class="width-9">
            <form action="book_store.php" method="POST" enctype="multipart/form-data" novalidate>

                <div class="form-group">
                    <label for="title">Book Title:</label>
                    <input type="text" id="title" name="title" value="<?= h(old("title")) ?>">
                    <p class="error"><?= error("title") ?></p>

                </div>

                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author" value="<?= h(old("author")) ?>">
                    <p class="error"><?= error("author") ?></p>
                </div>

                <div class="form-group">
                    <label for="publisher_id">Publisher:</label>
                    <select id="publisher_id" name="publisher_id">
                        <option value="">-- Select Publisher --</option>

                        <?php foreach ($publishers as $pub): ?>
                            <option value="<?= $pub->id ?>" <?= chosen("publisher_id", $pub->id) ? "selected" : "" ?>>
                                <?= h($pub->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="error"><?= error("publisher_id") ?></p>

                </div>

                <div class="form-group">
                    <label for="year">Year:</label>
                    <input type="text" id="year" name="year" value="<?= h(old("year")) ?>">
                    <p class="error"><?= error("year") ?></p>
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" value="<?= h(old("isbn")) ?>">
                    <p class="error"><?= error("isbn") ?></p>
                </div>

                <div class="form-group">
                    <label>Available Formats:</label>
                    <div class="checkbox-group">

                        <?php foreach ($formats as $format): ?>
                            <label class="checkbox-label">
                                <input 
                                    type="checkbox" 
                                    name="format_ids[]" 
                                    value="<?= $format->id ?>" 
                                    <?= chosen("format_ids", $format->id) ? "checked" : "" ?>
                                >
                                <?= h($format->name) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <p class="error"><?= error("format_ids") ?></p>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="5"><?= h(old("description")) ?></textarea>
                    <p class="error"><?= error("description") ?></p>
                </div>

                <div class="form-group">
                    <label for="cover">Book Cover Image (max 2MB):</label>
                    <input type="file" id="cover" name="cover" accept="image/*">
                    <p class="error"><?= error("cover_filename") ?></p>
                </div>

                <div class="form-group">
                    <button type="submit" class="button">Save Book</button>
                </div>
            </form>
        </div>
    </div>

    <?php
        // Clear form data after displaying
        clearFormData();
        // Clear errors after displaying
        clearFormErrors();
    ?>
    </body>
</html>