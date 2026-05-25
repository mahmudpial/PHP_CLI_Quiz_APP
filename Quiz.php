<?php

class Quiz
{
    private array $questions = [];
    private array $answers = [];
    private array $wrongAnswers = [];

    /* Time limit for each question in seconds */
    private int $timeLimit = 10;

   /** Load questions from JSON file and shuffle them
    * __construct method to initialize the quiz with questions from a JSON file. It checks if the file exists, 
    * reads its contents, decodes the JSON, and shuffles the questions for randomness.
    */
    public function __construct(string $file)
    {
        if (!file_exists($file)) {
            die("Error: QuestionBank.json file not found!\n");
        }
        
        $data = file_get_contents($file);     // Load and decode JSON file
        $decoded = json_decode($data, true);  // Decode JSON to associative array

         // Check if decoding was successful and the result is an array
        if (!is_array($decoded)) {
            die("Error: Invalid JSON format in QuestionBank.json\n");
        }
        
        $this->questions = $decoded; // Store questions in the class property
        shuffle($this->questions);  // Shuffle questions for randomness
    }
    
    /**
     * color method to apply ANSI color codes to text for better terminal output. It takes a string and a color name,
     * and returns the colored string using ANSI escape codes. Supported colors include red, green, yellow, and blue.
     * This enhances the user experience by making the quiz output more visually appealing and easier to read in the terminal.
     * @param string $text The text to be colored.
     * @param string $color The color name (e.g., "red", "green", "yellow", "blue").
     * @return string The colored text with ANSI escape codes. 
     */
    private function color(string $text, string $color): string
    {
        $colors = [
            "red" => "\033[31m",
            "green" => "\033[32m",
            "yellow" => "\033[33m",
            "blue" => "\033[34m",
            "reset" => "\033[0m"
        ];

        return $colors[$color] . $text . $colors["reset"];
    }

    // timedInput method to handle user input with a time limit. It prompts the user for input and measures the time taken.
    // If the user takes too long, it returns an empty string and counts the answer as wrong.
    private function timedInput(string $prompt): string
    {
        echo $this->color($prompt, "yellow");

        $start = microtime(true);
        $input = trim(fgets(STDIN));
        $duration = microtime(true) - $start;

        if ($duration > $this->timeLimit) {
            echo $this->color("\nTime's up! Answer counted as wrong.\n", "red");
            return "";
        }

        return strtoupper($input);
    }
     
    // run method to execute the quiz. It iterates through each question,
    // displays it along with the options, and collects the user's answer using the timedInput method.
    public function run()
    {
        // Loop through each question and collect answers
        foreach ($this->questions as $index => $question) {

            // Display question and options
            echo "\n" . $this->color("Question " . ($index + 1), "blue") . "\n";
            echo $question["question"] . "\n";
           
            foreach ($question["options"] as $key => $value) {
                echo "$key. $value\n";
            }

            $answer = $this->timedInput("Your answer: "); // Get user input with time limit

            $this->answers[$index] = $answer;  // Store the user's answer
            
            // Check if the answer is correct and store wrong answers for review
            if ($answer !== $question["answer"]) {
                $this->wrongAnswers[] = [
                    "question" => $question["question"],
                    "your_answer" => $answer ?: "No Answer",
                    "correct_answer" => $question["answer"]
                ];
            }
        }

        $this->showResult();
    }
    
    // showResult method to display the quiz results. It calculates the total number of questions, the number of correct answers,
    // and the percentage score. It also provides feedback on wrong answers, showing the question, the user's answer
    private function showResult()
    {
        $total = count($this->questions); // Total number of questions

        if ($total === 0) {
            echo " No questions available.\n";
            return;
        }

        $correct = 0;

        foreach ($this->questions as $i => $question) {
            if (($this->answers[$i] ?? "") === $question["answer"]) {
                $correct++;
            }
        }

        $percentage = ($correct / $total) * 100;   // Calculate percentage score

        // Display results with colored output
        echo "\n" . $this->color("===== RESULT =====", "green") . "\n";
        echo "Score: $correct / $total\n";
        echo "Percentage: " . round($percentage, 2) . "%\n";  

        // Provide feedback based on the percentage score
        if ($percentage >= 80) {
            echo $this->color("Excellent work!", "green") . "\n";
        } elseif ($percentage >= 50) {
            echo $this->color("Good effort! Keep practicing.", "yellow") . "\n";
        } else {
            echo $this->color("Needs improvement. Review the material and try again.", "red") . "\n";
        }

        // Provide feedback on wrong answers
        if (!empty($this->wrongAnswers)) {
            echo "\n" . $this->color("Wrong Answers Review:", "red") . "\n";

            // Loop through wrong answers and display the question, user's answer, and correct answer
            foreach ($this->wrongAnswers as $wrongAnswer) {
                echo "Q: {$wrongAnswer['question']}\n";
                echo "Your Answer: {$wrongAnswer['your_answer']}\n";
                echo "Correct Answer: {$wrongAnswer['correct_answer']}\n\n";
            }
        }
    }
}