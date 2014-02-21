<?php

function cs_pdf_to_img($file, $start, $end) {

    global $cs_main;

    // Get translation
    $cs_lang = cs_translate('newspdf');

    // Fetch module options
    $options = cs_sql_option(__FILE__, 'newspdf');

    // Check if imagick is available
    if(!extension_loaded('imagick')) {

        return $cs_lang['error'] . ': ' . $cs_lang['imagick_not_found'];
    }

    // Check if file exists
    $file_loc = $cs_main['def_path'] . '/' . $options['pdf_upload_to'] . '/' . $file;
    $file_ext = $cs_main['php_self']['dirname'] . $options['pdf_upload_to'] . '/' . $file;

    if(!file_exists($file_loc)) {

        return $cs_lang['error'] . ': ' . $cs_lang['file_not_found'];
    }

    // Prepare image file names
    $imgs_loc = $cs_main['def_path'] . '/' . $options['img_upload_to'] . '/' .  rtrim($file, '.pdf');
    $imgs_ext = $cs_main['php_self']['dirname'] . $options['img_upload_to'] . '/' .  rtrim($file, '.pdf');

    // Open file to read the number of images
    $imck = new Imagick();
    $imck->setResolution(2, 2);
    $imck->readImage($file_loc);

    $pages = $imck->getNumberImages();

    $imck->destroy();

    // Create image files and append news text
    $text = '[html]' . "\n";

    // Determine start and end page
    $start = (int) $start;
    $end   = (int) $end;

    if ($start < 1) {

        $start = 1;

    } elseif ($start > $pages) {

        $start = $pages;
    }

    if ($end < $start) {

        $end = $start;

    } elseif ($end > $pages) {

        $end = $pages;
    }

    for ($page = $start; $page <= $end; $page++) {

        $img_name = $imgs_loc . '_' . $page . '.jpg';
        $img_link = $imgs_ext . '_' . $page . '.jpg';
        $pdf_link = $file_ext . '#page=' . $page;

        // Create object and set quality settings
        $isub = new Imagick();
        $isub->setInterlaceScheme(imagick::INTERLACE_NO);
        $isub->setCompression(imagick::COMPRESSION_JPEG);

        // Set DPI if changed in options
        if(!empty($options['pdf_dpi_x']) AND !empty($options['pdf_dpi_y'])) {

            $isub->setResolution($options['pdf_dpi_x'], $options['pdf_dpi_y']);
        }

        // Load current part to create an image from
        $last = (int) ($page - 1);
        $isub->readImage($file_loc . '[' . $last . ']');

        // Calculate image width and height
        $s_width  = $isub->getImageWidth();
        $s_height = $isub->getImageHeight();
        $w_factor = $s_width / $options['img_max_width'];
        $h_factor = $s_height / $options['img_max_height'];
        $factor = ($h_factor > $w_factor) ? $h_factor : $w_factor;

        // If width or height are too large resize the image
        if($factor > 1) {

            if($factor == $w_factor) {

                $s_width  = $options['img_max_width'];
                $s_height = round($s_height / $w_factor);
            }
            else {

                $s_width  = round($s_width / $h_factor);
                $s_height = $options['img_max_height'];
            }

            // Resize image to target size
            $isub->thumbnailImage($s_width, $s_height, true, true);
        }

        // Set file type and write file
        $isub->setImageFormat('jpeg');
        $isub->writeImage($img_name);

        // Destroy object
        $isub->destroy();

        // Update news text
        $text .= '<a href="' . $pdf_link . '">'
               . '<img src="' . $img_link . '" alt="" />'
               . '</a>' . "\n";
    }

    $text .= '[/html]';
    
    return $text;
}