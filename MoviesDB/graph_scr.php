<?php

/**
 * Footer
 *
 * Main footer file for the theme.
 *
 * @category   Components
 * @package    WordPress
 * @subpackage Theme_Name_Here
 * @author     Your Name <yourname@example.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://yoursite.com
 * @since      1.0.0
 */
require "connect.php";
$sql = "SELECT 
title, searchcount
FROM movies
ORDER BY
searchcount DESC 
LIMIT 10";
$result = $conn->query($sql);


if (mysqli_num_rows($result) > 0) {
   while ($row = mysqli_fetch_array($result)) {

      $data[$row['title']] = ($row['searchcount']);
   }
}
?>

    <?php

      // Image dimensions
      $imageWidth = 2100;
      $imageHeight = 700;

      // Grid dimensions and placement within image
      $gridTop = 40;
      $gridLeft = 25;
      $gridBottom = 600;
      $gridRight = 2100;
      $gridHeight = $gridBottom - $gridTop;
      $gridWidth = $gridRight - $gridLeft;

      // Bar and line width
      $lineWidth = 1;
      $barWidth = 20;

      // Font settings
      $font = 'OpenSans-Regular.ttf';
      $fontSize = 8;

      // Margin between label and axis
      $labelMargin = 10;

      // Max value on y-axis
      $yMaxValue = 25;

      // Distance between grid lines on y-axis
      $yLabelSpan = 5;

      // Init image
      $chart = imagecreate($imageWidth, $imageHeight);

      // Setup colors
      $backgroundColor = imagecolorallocate($chart, 255, 255, 255);
      $axisColor = imagecolorallocate($chart, 85, 85, 85);
      $labelColor = $axisColor;
      $gridColor = imagecolorallocate($chart, 212, 212, 212);
      $barColor = imagecolorallocate($chart, 47, 133, 217);

      imagefill($chart, 0, 0, $backgroundColor);

      imagesetthickness($chart, $lineWidth);

      /*
 * Print grid lines bottom up
 */

      for ($i = 0; $i <= $yMaxValue; $i += $yLabelSpan) {
         $y = $gridBottom - $i * $gridHeight / $yMaxValue;

         // draw the line
         imageline($chart, $gridLeft, $y, $gridRight, $y, $gridColor);

         // draw right aligned label
         $labelBox = imagettfbbox($fontSize, 0, $font, strval($i));
         $labelWidth = $labelBox[4] - $labelBox[0];

         $labelX = $gridLeft - $labelWidth - $labelMargin;
         $labelY = $y + $fontSize / 2;

         imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, strval($i));
      }

      /*
 * Draw x- and y-axis
 */

      imageline($chart, $gridLeft, $gridTop, $gridLeft, $gridBottom, $axisColor);
      imageline($chart, $gridLeft, $gridBottom, $gridRight, $gridBottom, $axisColor);

      /*
 * Draw the bars with labels
 */

      $barSpacing = 200;
      $itemX = $gridLeft + $barSpacing / 2;

      foreach ($data as $key => $value) {
         // Draw the bar
         $x1 = $itemX - $barWidth / 2;
         $y1 = $gridBottom - $value / $yMaxValue * $gridHeight;
         $x2 = $itemX + $barWidth / 2;
         $y2 = $gridBottom - 1;

         imagefilledrectangle($chart, $x1, $y1, $x2, $y2, $barColor);

         // Draw the label
         $labelBox = imagettfbbox($fontSize, 0, $font, $key);
         $labelWidth = $labelBox[4] - $labelBox[0];

         $labelX = $itemX - $labelWidth / 2;
         $labelY = $gridBottom + $labelMargin + $fontSize;

         imagettftext($chart, $fontSize, 0, $labelX, $labelY, $labelColor, $font, $key);

         $itemX += $barSpacing;
      }

      /*
 * Output image to browser
 */

      imagepng($chart, 'chart.png');

      ?>
