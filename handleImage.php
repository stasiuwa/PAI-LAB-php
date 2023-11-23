<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <title>PAI LAB php</title>
    <link rel="stylesheet" href="src/styles.css">
</head>
<body>
<header>
    <h2>Images</h2>
    <h3><a href="index.php">strona główna</a></h3>
</header>


<?php
if(isset($_POST['submit']) && $_POST['submit'] == 'submit' && !isset($_GET['pic'])){
    if(is_uploaded_file($_FILES['image']['tmp_name'])){
        $type = $_FILES['image']['type'];
        $type = strtolower($type);
        if ($type === 'image/jpeg') {
            move_uploaded_file($_FILES['image']['tmp_name'], './' . $_FILES['image']['name']);
            $link = $_FILES['image']['name'];
            $random = uniqid('img_');
            $image = $random . '.jpg';
            copy($link, './' . $image);

            list($width, $height) = getimagesize($image);

            $wdth = $_POST['width'];
            $hght = $_POST['height'];
            $scaleWidth = 1;
            $scaleHeight = 1;
            $scale = 1;
            if ($width > $wdth) $scaleWidth = $wdth / $width;
            if ($height > $hght) $scaleHeight = $hght / $height;
            if ($scaleWidth <= $scaleHeight) $scale = $scaleHeight;
            else $scaleHeight = $scaleWidth;

            $newW = $width * $scale;
            $newH = $height * $scale;

            //header('Content-Type: image/jpeg');
            $new = imagecreatetruecolor($newW, $newH);
            $picture = imagecreatefromjpeg($image);

            imagecopyresampled($new, $picture, 0, 0, 0, 0, $newW, $newH, $width, $height);
            imagejpeg($new, './src/thumbnails/mini-' . $link, 100);
            rename($link, "./src/img/" . $link);

            imagedestroy($new);
            imagedestroy($picture);
            unlink($image);

            echo '<a href="imagesForm.html">Powrót</a><br/><img src="./src/thumbnails/mini-' . $link . '" alt="' . $link . '"/><br/>';
        }
    }
    else {
        header('location:imagesForm.html');
    }
}

?>
</body>
</html>