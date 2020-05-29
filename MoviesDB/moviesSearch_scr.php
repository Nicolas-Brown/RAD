<main class="col-lg-9">
    <article class="col-lg-12">
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
        if (!isset($_POST['submit'])) {
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-group">
                    <label for="searchT">Title:</label>
                    <input type="text" class="form-control" id="searchT" name="searchT">
                </div>
                <div class="form-group">
                    <label for="searchR">Rating:</label>
                    <input type="text" class="form-control" id="searchR" name="searchR">
                </div>
                <div class="form-group">
                    <label for="searchY">Year:</label>
                    <input type="text" class="form-control" id="searchY" name="searchY">
                </div>
                <div class="form-group">
                    <label for="searchG">Genre:</label>
                    <input type="text" class="form-control" id="searchG" name="searchG">
                </div>

                <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </form>
            <?php
        } else {

            //intialise empty string for erro messages
            $error_msg = "";
            //firstname
            if ($_POST['searchT']) {
                //assign the filled value to the field
                $searchT = $_POST['searchT'];

                $searchT = filter_var($searchT, FILTER_SANITIZE_STRING);
            }
            //lastname
            if ($_POST['searchR']) {
                //assign the filled value to the field
                $searchR = $_POST['searchR'];

                $searchR = filter_var($searchR, FILTER_SANITIZE_STRING);
            }
            //phone
            if ($_POST['searchY']) {
                //assign the filled value to the field
                $searchY = $_POST['searchY'];

                $searchY = filter_var($searchY, FILTER_SANITIZE_STRING);
            }
            if ($_POST['searchG']) {
                //assign the filled value to the field
                $searchG = $_POST['searchG'];

                $searchG  = filter_var($searchG, FILTER_SANITIZE_STRING);
            }
        }

        @$sql = "SELECT *
        FROM movies
        WHERE  title LIKE '%" . $searchT . "%' AND rating LIKE '%" . $searchR . "%' AND year LIKE '%" . $searchY . "%' AND genre LIKE '%" . $searchG . "%'
        ";

        @$sql2 = "UPDATE movies 
        SET searchcount = searchcount + 1
        WHERE title = '" . $searchT . "' ";

        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);

        if ($result->num_rows > 0 && $result2) {
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
            echo "Nothing found";
        }
        $conn->close();
        ?>
    </article>
</main>