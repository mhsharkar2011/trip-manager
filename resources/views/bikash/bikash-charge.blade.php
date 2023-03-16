<!DOCTYPE html>
<html>
<head>
    <title>Bikash Charge Calculator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Bikash Charge Calculator</h1>

    <form id="bikash-charge-form">
        <div>
            <label>Amount:</label>
            <input type="number" name="amount" required>
        </div>

        <div>
            <button type="submit">Calculate</button>
        </div>
    </form>

    <div id="bikash-charge-results" style="display: none;">
        <p>Charge: <span id="charge"></span> Taka</p>
        <p>Total: <span id="total"></span> Taka</p>
    </div>

    <script>
        $(document).ready(function () {
            $('#bikash-charge-form').submit(function (event) {
                event.preventDefault();

                var form = $(this);
                var url = form.attr('action');

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (response) {
                        $('#charge').text(response.charge);
                        $('#total').text(response.total);

                        $('#bikash-charge-results').show();
                    }
                });
            });
        });
    </script>
</body>
</html>
