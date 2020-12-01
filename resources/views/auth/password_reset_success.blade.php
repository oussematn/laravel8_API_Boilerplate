<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reset Password Success</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fbfbfb;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        input {
            padding: 10pt;
            width: 60%;
            font-size: 15pt;
            border-radius: 5pt;
            border: 1px solid lightgray;
            margin: 10pt;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            width: 50%;
            align-items: center;
            margin: 20pt;
            border: 1px solid lightgray;
            padding: 20pt;
            border-radius: 5pt;
            background: white;
            -webkit-box-shadow: 1px 2px 16px 5px rgba(26, 25, 25, 0.34);
            box-shadow: 1px 2px 16px 5px rgba(26, 25, 25, 0.34);
        }

        button {
            border-radius: 5pt;
            padding: 10pt 14pt;
            background: white;
            border: 1px solid gray;
            font-size: 14pt;
            margin: 20pt;
        }

        button:hover {
            background: rgb(40, 155, 231);
            color: white;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <h1>Password successfuly reset!</h1>
    </div>
</body>

</html>