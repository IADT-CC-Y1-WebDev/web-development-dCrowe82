<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/03-arrays.php">View Example &rarr;</a>
    </div>

    <h1>Arrays Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Favorite Movies</h2>
    <p>
        <strong>Task:</strong> 
        Create an indexed array with 5 of your favorite movies. Use a for 
        loop to display each movie with its position (e.g., "Movie 1: 
        The Matrix").
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
            $movies = ["Arrival", "Memento", "Parasite", "Prisoners", "Blade Runner"];

            for ($i = 0; $i < count($movies); $i++) {
                echo "Movie " . $i + 1 . ": {$movies[$i]} <br>";
            }

        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Student Record</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array for a student with keys: name, studentId, 
        course, and grade. Display this information in a formatted sentence.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
            $student = [
                "name" => "Daniel",
                "studentId" => "n00254023",
                "course" => "Creative Computing",
                "grade" => "??"
            ];
            
            echo "The student's name is {$student["name"]}, and their ID is {$student["studentId"]}, and they are in the course {$student["course"]}, and their grade is {$student["grade"]}.";

        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Country Capitals</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array with at least 5 countries as keys and their 
        capitals as values. Use foreach to display each country and capital 
        in the format "The capital of [country] is [capital]."
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
            $countries = [
                "ireland" => "dublin",
                "england" => "london",
                "france" => "paris",
                "spain" => "madrid",
                "greece" => "athens",
            ];

            foreach ($countries as $country => $capital) {
                echo "The capital of " . ucfirst($country) . " is " . ucfirst($capital) . "<br>";
            }

        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Menu Categories</h2>
    <p>
        <strong>Task:</strong> 
        Create a nested array representing a restaurant menu with at least 
        2 categories (e.g., "Starters", "Main Course"). Each category should 
        have at least 3 items with prices. Display the menu in an organized 
        format.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        
        $menu = [
            "starters" => [
                "starter1" => 1.99,
                "starter2" => 2.50,
                "starter3" => 3.99,
            ],
            "mainCourse" => [
                "main1" => 9.99,
                "main2" => 19.99,
                "main3" => 29.99,
            ]
        ];

        foreach ($menu as $course => $items) {
            echo "<p>" . ucfirst($course) . ":</p><ul>";
            foreach ($items as $dish => $price) {
                echo "<li>" . ucfirst($dish) . ": €$price";
            }
            echo "</ul>";
        }

        ?>
    </div>

</body>
</html>
