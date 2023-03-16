<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bikash Charge Calculator</title>
</head>
<body>
    <h1>Bikash Charge Calculator</h1>
    <div>
        <label for="amount">Enter Amount (in BDT):</label>
        <input type="number" id="amount" name="amount">
        <button id="calculate-btn">Calculate</button>
    </div>
    <div id="result"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#calculate-btn').click(function() {
                var amount = $('#amount').val();
                $.ajax({
                    url: "{{ route('bikash-charge') }}",
                    method: "GET",
                    data: { amount: amount },
                    success: function(data) {
                        $('#result').html('The Bikash charge is BDT ' + data.total);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
