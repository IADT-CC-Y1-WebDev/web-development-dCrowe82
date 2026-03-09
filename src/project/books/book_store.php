<?php
/**
 * User Registration Handler - Exercise
 *
 * Follow the steps below to progressively implement form handling.
 * Each step corresponds to an example in /examples/04-php-forms/
 *
 * This file processes the form submission from book_create.php
 */


// =============================================================================
// Write your code here
// =============================================================================
// Include the required library files
require_once './php/lib/config.php';
require_once './php/lib/session.php';
require_once './php/lib/forms.php';
require_once './php/lib/utils.php';

$data = [];
$errors = [];

startSession();

// dd($_FILES, true);

try {

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("invalid request method.");
    }
    
    $data["format_ids"] = $_POST["format_ids"] ?? [];

    foreach($_POST as $key => $value) {
        $data[$key] = $_POST[$key] ?? null;
    }
    
    $data["cover_filename"] = $_FILES["cover"] ?? null;

    $rules = [
        "title" => "required|nonempty|min:5|max:255",
        "author" => "required|nonempty|min:5|max:255",
        "publisher_id" => "required|nonempty|integer",
        "year" => "required|nonempty|integer|minvalue:1900|maxvalue:" . date("Y"),
        "isbn" => "required|nonempty|min:13|max:14",
        "description" => "required|nonempty|min:10|max:255",
        "format_ids" => "required|nonempty|array|min:1|max:4",
        "cover_filename" => "required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880"
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {

        foreach($validator->errors() as $field => $feildErrors) {
            $errors[$field] = $feildErrors[0];
        }

        throw new Exception("Validation failed");

    }

    $uploader = new ImageUpload();
    $coverFilename = $uploader->process($_FILES["cover"]);

    if (!$coverFilename) {
        throw new Exception("Failed to process and save the cover.");
    }

    $book = new Book($data);
    $book->cover_filename = $coverFilename;
    $book->save();

    
    foreach ($data["format_ids"] as $formatId) {
        if (!Format::findById($formatId)) {
            throw new Exception("one or more selected formats do not exist");
        }
    }

    if (!empty($data["format_ids"]) && is_array($data["format_ids"])) {
        foreach ($data["format_ids"] as $formatId) {
            BookFormat::create($book->id, $formatId);
        }
    }

    
    
    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Book stored successfully.');

    redirect("book_view.php?id=" . $book->id);
    
}
catch (Exception $e) {

    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormErrors($errors);

    setFormData($data);

    redirect("book_create.php");
}
