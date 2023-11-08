<?php

function CroppedImage($image_orig,$new_image_width,$new_image_height,$image_save_path) {
 
   $image_info = getimagesize($image_orig);

   $width_orig = $image_info[0];
   $height_orig = $image_info[1];

   $created_image = imagecreatefromjpeg($image_orig);
   $ratio_orig = $width_orig/$height_orig;
   
   if ($new_image_width/$new_image_height > $ratio_orig) {
      $new_height = $new_image_width/$ratio_orig;
      $new_width = $new_image_width;
   } else {
      $new_width = $new_image_height*$ratio_orig;
      $new_height = $new_image_height;
   }
   
   $width_middle = $new_width/2;
   $height_middle = $new_height/2;
   
   $created_crop = imagecreatetruecolor(round($new_width), round($new_height)); 
   
   imagecopyresampled($created_crop, $created_image, 0, 0, 0, 0, $new_width, $new_height, $width_orig, $height_orig);

   $cropped_image = imagecreatetruecolor($new_image_width, $new_image_height);
   
   imagecopyresampled($cropped_image, $created_crop, 0, 0, ($width_middle-($new_image_width/2)),
      ($height_middle-($new_image_height/2)), $new_image_width, $new_image_height, $new_image_width, $new_image_height);

   imagedestroy($created_crop);
   imagedestroy($created_image);

   imagejpeg($cropped_image, $image_save_path, 100);
}

?>