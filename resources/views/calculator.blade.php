<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>
    <h1>Calculator</h1>
    <form method="post">
        @csrf
        <label for="num1">Number 1:</label>
        <input type="number" name="num1" id="num1" required>
        <br>
        <label for="operator">Operator:</label>
        <select name="operator" id="operator" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <br>
        <label for="num2">Number 2:</label>
        <input type="number" name="num2" id="num2" required>
        <br>
        <button type="submit">Calculate</button>
    </form>
    @if(isset($result))
        <h2>Result: {{ $result }}</h2>
    @endif
</body>
</html>
