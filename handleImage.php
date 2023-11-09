<?php
echo '<h1>Images</h1>';
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

            header('Content-Type: image/jpeg');
            $new = imagecreatetruecolor($newW, $newH);
            $picture = imagecreatefromjpeg($image);
            imagecopyresampled($new, $picture, 0, 0, 0, 0, $newW, $newH, $width, $height);
            imagejpeg($new, './mini-' . $link, 100);

            imagedestroy($new);
            imagedestroy($picture);
            unlink($image);

            $len = strlen($link);
            $len -= 4;
            $link = substr($link, 0, $len);
            header("location:images.php?pic=$link");

        }
    }
}
if(!empty($_GET['pic'])){
        echo '<a href="' . $_GET['pic'] . '.jpg">Picture</a><br/>';
        echo '<a href="mini-' . $_GET['pic'] . '.jpg">Miniature</a><br/><br/>';
        echo '<a href="imagesForm.html">Return</a>';
    }
?>