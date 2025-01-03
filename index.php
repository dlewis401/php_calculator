<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP - Calculator</title>
</head>
<body>
	<!-- HTML FORM -->
	<!-- Use htmlspecialchars to convert field to plain text, so no code is executed when posted to PHP file -->
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
		<label for="number1">Number 1:</label>
		<input type="number" name="number1">


		<label for="number2">Number 2:</label>
		<input type="number" name="number2">

		<label for="operation">Select your operation:</label>
		<select name="operations" required>
			<option value="plus">+</option>
			<option value="substract">-</option>
			<option value="multiply">*</option>
			<option value="divide">/</option>
		</select>

		<button type="submit">Submit</button>
	</form>

	<?php

	// IF THE SERVER RECEIVES A POST METHOD 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// REMOVE STRINGS FROM FLOAT NUMBERS TO SANITIZE DATA (PREVENTING MALICIOUS USE)
		$num1 = filter_input(INPUT_POST, "number1", FILTER_SANITIZE_NUMBER_FLOAT);
		$num2 = filter_input(INPUT_POST, "number2", FILTER_SANITIZE_NUMBER_FLOAT);

		// CONVERTS OPERATION OUTPUT INTO HTML SPECIAL CHARACTERS (so code if a user did input for example, it would not execute as code but would be plain text)
		$operation = htmlspecialchars($_POST['operations']);

		// key variables
		$errorLog = false;
		$result = 0;

		// Checks if either of the inputs are empty and if so, display an error message (and keeps track of the errors)
		if (empty($num1) || empty($num2) || empty($operation)) {
			echo "<p style='color: red'> Make sure all boxes are filled in </p>";
			$errorLog = true;
		} else if (!is_numeric($num2) || !is_numeric($num1) ) {
			echo "<p style='color: red'> Make sure all boxes are actually numbers </p>";
			$errorLog = true;
		};

		// Main logic
		// If no errors
		if ($errorLog == false) {
			switch ($operation):
				// Different methods of the calculations, with varying results due to operations used
				case "plus":
					$result = $num1 + $num2;
					break;
				case "substract":
					$result = $num1 - $num2;
					break;

				case "multiply":
					$result = $num1 * $num2;
					break;

				case "divide":
					$result = $num1 / $num2;
					break;
				// Default is there is no valid operation
				default:
					echo "Nothing could be found to make a result from :(";
					break;
			endswitch;

			// Echos the final result
			echo "<p>Result: " . $result . "</p>";
		};
	};

?>
</body>
</html>