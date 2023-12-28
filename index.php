<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];
    $operation = $_POST["operation"];

    switch ($operation) {
        case "+":
            $result = $num1 + $num2;
            break;
        case "-":
            $result = $num1 - $num2;
            break;
        case "*":
            $result = $num1 * $num2;
            break;
        case "/":
            if ($num2 != 0) {
                $result = $num1 / $num2;
            } else {
                $result = "Ділення на нуль неможливе";
            }
            break;
        default:
            $result = "Невідома операція";
    }

    $history = "$num1 $operation $num2 = $result";
    file_put_contents("history.txt", $history . PHP_EOL, FILE_APPEND);
} else {
    $num1 = $num2 = $result = "";
}
?>

<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            .history{
                border: 1px solid black;
                width:60%;
                border-radius:5px;
                padding:10px;
            }
        </style>
        <title>Калькулятор</title>
    </head>
    <body>
        <h2>Калькулятор</h2>
        <form method="post" action="index.php">
            <label for="num1">Число 1:</label>
            <input type="number" step="any" name="num1" id="num1" value="<?php echo $num1; ?>" required>
            <br>

            <label for="num2">Число 2:</label>
            <input type="number" step="any" name="num2" id="num2" value="<?php echo $num2; ?>" required>
            <br><br>

            <label>Операція:</label>
            <input type="radio" name="operation" value="+" checked id="o1"> 
            <label for="o1">Додавання</label>
            <input type="radio" name="operation" value="-" id="o2"> 
            <label for="o2">Віднімання</label>
            <input type="radio" name="operation" value="*" id="o3"> 
            <label for="o3">Множення</label>
            <input type="radio" name="operation" value="/" id="o4"> 
            <label for="o4">Ділення</label>
            <br><br>

            <input type="submit" value="Обчислити">
        </form>

        <h2>Історія операцій</h2>
        <div class="history">
            <?php
            if (file_exists("history.txt")) {
                $historyContent = file_get_contents("history.txt");
                echo nl2br($historyContent);
            } else {
                echo "Історія порожня";
            }
            ?>
        </div>
        
    </body>
</html>