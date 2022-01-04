<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/blog/upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="upload" id="file hidden">
    <label for="file" id="selector">Select file</label>

    <input type="submit" value="Upload file" name="submit">
</form>

<script src="asset/file.js"></script>
</body>
</html>