
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
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbname = "moviedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
