<?php
require_once './php/lib/config.php';
require_once './php/lib/session.php';
require_once './php/lib/forms.php';
require_once './php/lib/utils.php';

$data = [];
$errors = [];

startSession();

try {

    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception(message: "invalid request method.");
    }
    
    $data["format_ids"] = $_POST["format_ids"] ?? [];

    foreach($_POST as $key => $value) {
        $data[$key] = $_POST[$key] ?? null;
    }
    
    $data["cover_filename"] = $_FILES["cover"] ?? null;

    $rules = [
        "id" => "required|integer",
        "title" => "required|nonempty|min:3|max:255",
        "author" => "required|nonempty|min:3|max:255",
        "publisher_id" => "required|nonempty|integer",
        "year" => "required|nonempty|integer|minvalue:1900|maxvalue:" . date("Y"),
        "isbn" => "required|nonempty|min:13|max:14",
        "description" => "required|nonempty|min:10|max:255",
        "format_ids" => "required|nonempty|array|min:1|max:4",
        "cover_filename" => "file|image|mimes:jpg,jpeg,png|max_file_size:5242880"
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {

        foreach($validator->errors() as $field => $feildErrors) {
            $errors[$field] = $feildErrors[0];
        }

        throw new Exception("validation failed");

    }

    $book = Book::findById($data["id"]);

    if (!$book) {
        throw new Exception("book not found");
    }

    $publisher = Publisher::findById($data["publisher_id"]);
    if (!$publisher) {
        throw new Exception("publisher does not exist");
    }

    foreach ($data["format_ids"] as $formatId) {
        if (!Format::findById($formatId)) {
            throw new Exception("one or more selected formats do not exist");
        }
    }
 
    $coverFilename = null;
    $uploader = new ImageUpload();
    
    if ($uploader->hasFile("cover")) {
        // Delete old image
        $uploader->deleteImage($book->cover_filename);
        // Process new image
        $coverFilename = $uploader->process($_FILES["cover"]);
        // Check for processing errors
        if (!$coverFilename) {
            throw new Exception("failed to process and save the cover");
        }
    }

    $book->title = $data["title"];
    $book->author = $data["author"];
    $book->publisher_id = $data["publisher_id"];
    $book->year = $data["year"];
    $book->isbn = $data["isbn"];
    $book->description = $data["description"];
    if ($coverFilename) {
        $book->cover_filename = $coverFilename;
    }

    $book->save();


    BookFormat::deleteByBook($book->id);
    if (!empty($data["format_ids"]) && is_array($data["format_ids"])) {
        foreach ($data["format_ids"] as $formatId) {
            BookFormat::create($book->id, $formatId);
        }
    }

    
    clearFormData();
    clearFormErrors();

    // =========================================================================
    // STEP 8: Flash Messages
    // See: /examples/04-php-forms/step-08-flash-messages/
    // =========================================================================
    // TODO: On successful registration, set a success flash message and 
    // redirect back to the form

    redirect("book_view.php?id=" . $book->id);
    
}
catch (Exception $e) {

    if ($coverFilename) {
        $uploader->deleteImage($coverFilename);
    }

    setFormErrors($errors);

    setFormData($data);

    print_r("something");

    // =========================================================================
    // STEP 8: Flash Messages
    // See: /examples/04-php-forms/step-08-flash-messages/
    // =========================================================================
    // TODO: On validation error, you set an error flash message

    // redirect("book_view.php?id=" . $book->id);

    if (isset($data["id"]) && $data["id"]) {
        
        redirect("book_edit.php?id=" . $data["id"]);
    }
    else {

        redirect("book_list.php");
    }
}
