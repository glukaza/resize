<?php

namespace abeautifulsite;

require_once '/var/www/resize/SimpleImage.php';

$img_original_host = "http://img1.vnovostroike.ru";

if (isset($_GET["process"]) && trim($_GET["process"]) != "" && trim($_GET["process"]) != "/") {

    $img_path = explode("/", trim($_GET["process"]));

    $img = array_pop($img_path);

    $img_width = array_pop($img_path);
    $proportion = explode("x", $img_width);

    $real_path = implode("/", $img_path);

    $img_src = $img_original_host . $real_path . '/' . $img;

    $img_format = substr($img, strrpos($img, "."));

    if (!in_array($img_format, Array(".jpg", ".jpeg", ".png", ".gif"))) {
        return false;
    }

    if (!file_exists('/var/www/images' . $real_path . '/' . $img)) {
        return false;
    }

    $new_img = new SimpleImage($img_src);

    if (!file_exists('/var/www/images' . $real_path . '/' . $img_width . '/')) {
        mkdir('/var/www/images' . $real_path . '/' . $img_width . '/', 0775, true);
    }

    $new_img->best_fit($proportion[0], $proportion[1])->save('/var/www/images' . $real_path . '/' . $img_width . '/' . $img);
    header("Location: " . $img_original_host . $real_path . "/" . $img_width . "/" . $img);
}

return false;