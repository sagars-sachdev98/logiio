<?php include 'mailer.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
    <title>Success</title>
    <style>
        .thank-you {
            width: 50%;
            margin-top: 10%;
        }

        .card {
            padding: 25px;
        }
    </style>
</head>

<body>
    <!-- <h1>Congratulations! you have successfully joined the mail list...</h1> -->
    <div class="container thank-you">
        <div class="card">
            <h2 class="text-center">Thank You.</h2>
            <h4 class="text-center">Your request has been submitted successfully!</h4>
            <p class="text-center">You will be redirected to homepage shortly..</p>
        </div>
    </div>

    <script>
        function getCookiesMap(cookiesString) {
            return cookiesString.split(";")
                .map(function(cookieString) {
                    return cookieString.trim().split("=");
                })
                .reduce(function(acc, curr) {
                    acc[curr[0]] = curr[1];
                    return acc;
                }, {});
        }

        function SubForm() {
            $.ajax({
                url: 'https://api.apispreadsheets.com/data/18893/',
                type: 'post',
                data: $("#logiioForm").serializeArray(),
                success: function() {
                    alert("Submitted successfully")
                },
                error: function() {
                    alert("There was an error :(")
                }
            });
        }
        window.onload = function() {
            var cookies = getCookiesMap(document.cookie);
            var name = cookies["name"];
            var email = cookies["email"];
            var message = cookies["message"];
            console.log(name + " " + email + " " + message)
            setTimeout(function() {
                SubForm();
                window.location.href = "index.php";
            }, 3000);
        };
    </script>
</body>

</html>