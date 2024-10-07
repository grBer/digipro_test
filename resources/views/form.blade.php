<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>
    <!-- Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Questionnaire Form</h2>
    <form>
        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" id="fullName" name="fullName" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="numQuestions">Number of Questions</label>
            <input type="number" class="form-control" id="numQuestions" name="numQuestions" min="1" max="49" required>
            <small class="form-text text-muted">Please enter a number less than 50.</small>
        </div>

        <div class="form-group">
            <label for="difficulty">Select Difficulty</label>
            <select class="form-control" id="difficulty" name="difficulty" required>
                <option value="" disabled selected>Select Difficulty</option>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
        </div>

        <div class="form-group">
            <label for="type">Select Type</label>
            <select class="form-control" id="type" name="type">
                <option value="" disabled selected>Select Type</option>
                <option value="multiple-choice">Multiple Choice</option>
                <option value="true-false">True/False</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
