<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $image = $_FILES['image'];
    $file_name = $image['name'];
    $file_path = $image['tmp_name'];
    $file_type = $image['type'];
    $c_image = new CURLFile($file_path, $file_type, $file_name);
    $valid_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($image['type'], $valid_types)) {
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://127.0.0.1:5000/upload',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('image' => $c_image),
      ));
      $response = curl_exec($curl);
      $decoded_res = json_decode($response, true);
      if ($decoded_res['status'] == 200) {
        $process_type = $_POST['process_type'];
        if ($process_type == 'resize') {
          $widht = $_POST['widht'];
          $height = $_POST['height'];
          $_curl = curl_init();
          curl_setopt_array($_curl, array(
            CURLOPT_URL => 'http://127.0.0.1:5000/resize_image',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('width' => $widht, 'height' => $height, 'image' => $decoded_res['path']),
          ));
          $res = curl_exec($_curl);
          $_decoded_res = json_decode($res, true);
          echo '<img src="' . $_decoded_res['path'] . '" alt="resim">';
        } else if ($process_type == 'rotate') {
          $rotate = $_POST['rotate'];
          $_curl = curl_init();
          curl_setopt_array($_curl, array(
            CURLOPT_URL => 'http://127.0.0.1:5000/rotate_image',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('rotate' => $rotate, 'image' => $decoded_res['path']),
          ));
          $res = curl_exec($_curl);
          $_decoded_res = json_decode($res, true);
          echo '<img src="' . $_decoded_res['path'] . '" alt="resim">';
        } else if ($process_type == 'flip') {
          $flip = $_POST['flip'];
          $_curl = curl_init();
          curl_setopt_array($_curl, array(
            CURLOPT_URL => 'http://127.0.0.1:5000/flip_image',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('flip' => $flip, 'image' => $decoded_res['path']),
          ));
          $res = curl_exec($_curl);
          $_decoded_res = json_decode($res, true);
          echo '<img src="' . $_decoded_res['path'] . '" alt="resim">';
        } else if ($process_type == 'crop') {
          $crop = $_POST['crop'];
          $parts = explode(",", $crop);
          if (count($parts) == 4) {
            $x = $parts[0];
            $y = $parts[1];
            $w = $parts[2];
            $h = $parts[3];
            $_curl = curl_init();
            curl_setopt_array($_curl, array(
              CURLOPT_URL => 'http://127.0.0.1:5000/crop_image',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('x' => $x, 'y' => $y, 'w' => $w, 'h' => $h, 'image' => $decoded_res['path']),
            ));
            $res = curl_exec($_curl);
            $_decoded_res = json_decode($res, true);
            echo '<img src="' . $_decoded_res['path'] . '" alt="resim">';
          } else {
            echo "You need to enter 4 numbers";
          }
        }
      } else {
        echo $response;
        echo "Unexpected Error";
      }
    } else {
      echo 'Invalid file type';
    }
  } else {
    echo 'Image could not uploaded';
  }
}
