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
$sql = "SELECT id, title, studio, status, sound, versions, recretprice, rating, year, genre, aspect
FROM movies";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table class="table-light table-hover" id="outTable">';
    echo "<tr><th>Movie ID</th><th>Title</th><th>Studio</th><th>Status</th><th>Sound</th><th>Version</th><th>Reccomended retail price</th><th>Rating</th><th>Year</th><th>Genre</th><th>Aspect</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
<td onclick=popfields(" . $row['id'] . ")>" . $row["id"] . "</td>
<td>" . $row["title"] . "</td><td>" . $row["studio"] . "</td><td>" . $row["status"] . "</td><td>" . $row["sound"] . "</td>
<td>" . $row["versions"] . "</td><td>" . $row["recretprice"] . "</td><td>" . $row["rating"] . "</td>
<td>" . $row["year"] . "</td><td>" . $row["genre"] . "</td><td>" . $row["aspect"] . "</td>
</tr>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>