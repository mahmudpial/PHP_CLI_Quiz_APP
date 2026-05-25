# 📊 PHP Quiz Management CLI App

This is a **Command Line Interface (CLI) Quiz Application built with PHP**.  
It supports quiz execution from a JSON database, score calculation, wrong answer review, timer system, question randomization, and a retake quiz feature.

This project is designed for beginners to intermediate PHP developers to understand:

- File handling
- JSON data processing
- OOP (Object-Oriented Programming)
- CLI input/output
- Basic application architecture

---

# 📁 Project Structure

```bash
Quiz_APP/
├── run.php               # Main entry point (starts the quiz)
├── Quiz.php              # Quiz class (core logic)
└── QuestionBank.json     # Database (quiz questions in JSON format)
```

---

# 🚀 Features

## 🎯 Core Features

- Loads questions from a JSON file
- Displays questions in CLI format
- Multiple choice (A, B, C, D)
- Score calculation
- Percentage result
- Wrong answer review

---

## 🔁 Advanced Features

- 🔀 Random question order (shuffle)
- 🔁 Retake quiz system
- 📊 Total question counter
- 🧠 OOP-based design (Quiz class)
- 📁 JSON-based database (no MySQL required)
- 🖥 CLI-friendly interface

---

## ⏱ Timer System

- Each question has a **10-second limit**
- If the user exceeds the time:
  - Answer is marked wrong
  - Moves to next question

---

## ❌ Wrong Answer Review

At the end of the quiz, the system shows:

- Question
- User’s answer
- Correct answer

This helps users learn from mistakes.

---

## 📊 Score System

- Total correct answers
- Total questions
- Percentage score

Example:

```
Score: 3 / 5
Percentage: 60%
```

---

# 📄 Question Database (JSON Format)

All questions are stored in:

```
QuestionBank.json
```

Example structure:

```json
[
  {
    "question": "What is the capital of France?",
    "options": {
      "A": "Berlin",
      "B": "Madrid",
      "C": "Paris",
      "D": "Rome"
    },
    "answer": "C",
    "difficulty": "easy"
  }
]
```

---

# ▶️ How to Run

## Step 1: Open terminal

Navigate to the project folder:

```bash
cd PHP_MINI_Projects/Quiz_APP
```

---

## Step 2: Run application

```bash
php run.php
```

---

# 🔁 Retake Quiz Feature

After completing the quiz, the system asks:

```
Do you want to retake the quiz? (yes/no)
```

- Type `yes` → Quiz restarts
- Type `no` → Program exits

---

# 🧠 OOP Structure

The main logic is inside the `Quiz.php` class.

## Main Methods:

### `__construct($file)`
- Loads JSON file
- Parses questions
- Shuffles questions

---

### `run()`
- Displays questions
- Collects user answers
- Stores wrong answers
- Calls result function

---

### `showResult()`
- Calculates score
- Shows percentage
- Displays wrong answers

---

### `timedInput()`
- Handles user input
- Enforces time limit per question

---

### `color()`
- Adds CLI color output for better UI

---

# 🎨 CLI Color Support

The app supports terminal colors:

| Color | Meaning |
|------|--------|
| 🟦 Blue | Questions |
| 🟩 Green | Results |
| 🟥 Red | Wrong answers |
| 🟨 Yellow | Input prompts |

---

# 📚 Concepts Used

This project helps you practice:

- PHP OOP (Classes & Objects)
- Arrays & loops
- JSON parsing
- File handling
- CLI input/output
- Error handling
- Conditional logic
- Modular programming

---

# 🛠 Requirements

- PHP 7.4 or higher (recommended PHP 8+)
- Terminal / Command Prompt / PowerShell
- No database required
- No web server required

---

# ⚠️ Known Limitations

- Timer is CLI-based (not a real-time interrupt system)
- No persistent score storage
- No user authentication
- No database integration

---

# 🚀 Future Improvements

You can upgrade this project with:

## 🔥 Advanced Features

- MySQL database integration
- User login system
- Leaderboard (top scores)
- Admin panel to add questions
- Difficulty filter (Easy / Medium / Hard)
- Web version (Laravel + Vue.js)
- API-based quiz system
- Progress tracking per user

---

# 👨‍💻 About Project

This project was built as a **learning-based PHP CLI application** to improve backend development skills and understand:

- Data handling
- OOP design patterns
- Real-world CLI tools
- Structured PHP applications

---

# 📄 License

This project is open-source and free to use for learning purposes.

You can modify, improve, and use it in your own projects.

---

# ⭐ Support

If you like this project:

- Give it a ⭐ on GitHub
- Share with other developers
- Improve it with new features

---

# 🎯 Summary

This is a **complete PHP CLI Quiz System** featuring:

✔ JSON database  
✔ OOP structure  
✔ Timer system  
✔ Score calculation  
✔ Retake system  
✔ Wrong answer review  
✔ CLI UI enhancements  

---
