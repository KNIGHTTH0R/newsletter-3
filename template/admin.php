<?php

use Pineapple\Model\Database;

require('config/settings.php');
require('vendor/autoload.php');
require('config/db.php');

session_start();        // Start a session to save filter data

include('inc/header.php');
?>

<body>
    <main class="admin">
            <div class="admin-controls">
                <a class="admin" href="<?= $homeDir ;?>">← Front page</a>
            </div>
            <div>
                <?php

                if (!isset($_SESSION["order"])) {        // Set to default if NOT set on session yet
                    $_SESSION["order"] = "date_created";
                }
                if (!isset($_SESSION["filter"])) {        // Same
                    $_SESSION["filter"] = "";
                    $filterEnabled = "";        // A class to mark button
                }

                $db = new Database();        // Start database object

                echo $db->find("mynew@summo.com");

                if (isset($_POST["order"])) {       // Listen for sort button submit
                    $_SESSION["order"] = $_POST["order"];
                }
                if (isset($_POST["filter"])) {        // Listen for filter button submit
                    $_SESSION["filter"] = $_POST["filter"];
                    if (!empty($_SESSION["filter"])) {
                        $filterEnabled = "admin-filter-enabled";        // Class to mark button
                    }
                }
                if (isset($_POST["reset"])) {        // Listen for sort and filter reset submit
                    session_destroy();        // Clear session values
                    header("Refresh:0");        // Reload
                }
                if (isset($_POST["remove"])) {        // Listen for delete button submit
                    $db->remove($_POST["remove"]);
                }

                $result = $db->index($_SESSION["order"]);        // Method to select all entries on db table
                $results_array = [];
                $email_providers = [];
                while ($row = $result->fetch_assoc()) {
                    array_push($results_array, $row);        // Add database table rows to an array
                    array_push( $email_providers, substr(strrchr($row["email"], "@"), 0) );        // Add extracted domain names to an array
                }
                ?>
                    <table class="admin">
                    <div class="admin-controls">
                        <form method="POST" action="">
                            <button name="order" value="date_created">Order by date</button>
                            <button name="order" value="email">Order by name</button>
                        </form>
                    </div>
                    <div class="admin-controls">
                        <form method="POST" action="">
                            <?php
                            foreach(array_unique($email_providers) as $email_provider) {        // Do not include double values and loop over email domain names
                            ?>
                            <button name="filter" value="<?= $email_provider; ?>" class="<?= $filter_enabled_tag ?>"><?= ltrim($email_provider, '@');?></button>
                            <?php
                                }        // End of foreach
                            ?>
                        </form>
                    </div>
                    <div class="admin-controls">
                            <form method="POST" action="">
                                <input type="text" name="filter" value="<?= $_SESSION["filter"]; ?>">
                                <button type="submit">Find</button>
                            </form>
                    </div>
                    <div class="admin-controls">
                            <form method="POST" action="">
                                <input type="hidden" name="reset">
                                <button type="submit" class="<?= $filterEnabled ?>">Reset all</button>
                            </form>
                    </div>
                        <thead>
                        <tr class="admin">
                            <th class="admin">Submitted</th>
                            <th class="admin">Email address</th>
                        </tr>
                    </thead>
                        <?php
                        foreach($results_array as $row) {
                            if ( strpos($row["email"], $_SESSION["filter"]) !== FALSE || $_SESSION["filter"] == "" ) {        // If filter is enabled or set to default
                                ?>
                                <tr class="admin">
                                    <td class="admin"><?= $row["date_created"] ?></td>
                                    <td class="admin"><?= $row["email"] ?></td>
                                    <td class="admin">
                                        <form method="POST" action="">
                                            <button type="submit" name="remove" value="<?= $row['id'] ?>">✖</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            } else {        // If filter does not match..
                                continue;        // ..do not show and go to next record
                        }        // End-if for filter
                            
                        }        // End foreach
                            ?>
                    </table>
            </div>    
    </main>

</body>
</html>