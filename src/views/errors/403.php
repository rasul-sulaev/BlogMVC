<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>:( Доступ запрещен...</title>
    <link href="https://fonts.googleapis.com/css2?family=Finlandica:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/errors.css">
</head>
<body style="background-color: gainsboro">
<div class="error-block">
    <h1>403 Доступ запрещен</h1>
    <p class="link" id="goBack">Вернуться назад</p>
</div>
<script>
    document.querySelector('#goBack').addEventListener('click', () => {
        window.history.go(-1);
        return false;
    })
</script>
</body>
</html>