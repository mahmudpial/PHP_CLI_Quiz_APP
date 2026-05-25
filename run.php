<?php

require "Quiz.php"; // Include the Quiz class from the Quiz.php file to use its functionality in this script

/* color function to apply ANSI color codes to text for better terminal output. It takes a string and a color name,
 * and returns the colored string using ANSI escape codes. Supported colors include red, green, yellow, and blue.
 * This enhances the user experience by making the quiz output more visually appealing and easier to read in the terminal.
 * @param string $text The text to be colored.
 * @param string $color The color name (e.g., "red", "green", "yellow", "blue").
 * @return string The colored text with ANSI escape codes. 
 */
function color($text, $code)
{
    $colors = [
        "red" => "\033[31m",
        "green" => "\033[32m",
        "yellow" => "\033[33m",
        "blue" => "\033[34m",
        "reset" => "\033[0m"
    ];

    return $colors[$code] . $text . $colors["reset"];
}


$file = __DIR__ . "/QuestionBank.json"; // Define the path to the JSON file containing quiz questions

// validate file once
if (!file_exists($file)) {
    die("Error: QuestionBank.json not found!\n");
}

do {

    // load questions
    $data = file_get_contents($file);
    $questions = json_decode($data, true);// Decode JSON data into an associative array

    // Validate that the decoded data is an array of questions
    if (!is_array($questions)) {
        die("Error: Invalid QuestionBank.json format!\n");
    }

    // Display welcome message and quiz information

    echo "=======================================\n";
    echo color("         PHP QUIZ APP", "blue") . "\n";
    echo color("     Total Questions: " . count($questions), "green") . "\n";
    echo color("Time Limit: 10 sec per question", "yellow") . "\n";
    echo "=======================================\n\n";

    // run quiz
    $quiz = new Quiz($file);
    $quiz->run();

    // ask retry after quiz completion
    $retry = strtolower(trim(readline(color("Do you want to retake? (yes/no): ", "yellow"))));

} while ($retry === "yes");

echo color("\n👋 Thanks for playing! Goodbye!\n", "green");