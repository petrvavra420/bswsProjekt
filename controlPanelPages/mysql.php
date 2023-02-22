<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type"
          content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width,
        minimum-scale=1,initial-scale=1">

    <script src=
            "https://code.jquery.com/jquery-3.3.1.min.js">
    </script>

    <script src=
            "https://unpkg.com/jquery.terminal/js/jquery.terminal.min.js">
    </script>

    <link rel="stylesheet" href=
    "https://unpkg.com/jquery.terminal/css/jquery.terminal.min.css" />

    <style type="text/css">
        .terminal,
        span,
        .cmd,
        div {
            --color: rgba(0, 128, 0, 0.99);
        }

        .terminal,
        span {
            --size: 1.4;
        }
    </style>
</head>

<body>
<script>
    $('body').terminal({
        iam: function (name) {
            this.echo('Hello, ' + name +
                '. Welcome to GeeksForGeeks');
        },
        founder: function () {
            this.echo('Sandeep Jain');
        },
        help: function () {
            this.echo('iam - iam command and '
                + 'pass your name as argument\n'
                + 'founder to know the founder');
        },
    }, {
        greetings: 'GeeksForGeeks - A place to'
            + ' learn DS, Algo and Computer '
            + 'Science for free'
    });
</script>
</body>

</html>