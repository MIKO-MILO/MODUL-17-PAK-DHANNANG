<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Tambah Berita</h2>
    <form action="proses_upload.php" method="post" enctype="multipart/form-data">
        Judul : <br>
        <input type="text" name="title" required><br><br>

        Konten : <br>
        <textarea name="content" id="" cols="30" rows="10" required></textarea><br><br>

        Author : <br>
        <input type="text" name="author" required><br><br>

        Gambar : <br>
        <input type="file" name="image" required><br><br>

        <Button type="submit">Upload</Button>
    </form>
</body>
</html>