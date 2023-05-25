<?php
include 'connect.php';

// Initialize variables for search filters
$searchBloodGroup = '';
$searchLocation = '';
$showRecords = false; // Flag to determine whether to show records or not

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $searchBloodGroup = $_POST['bloodgroup'];
    $searchLocation = $_POST['location'];
    $searchLocation = mysqli_real_escape_string($conn, $searchLocation); // Escape special characters

    // Set the flag to true to indicate that records should be displayed
    $showRecords = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <form method="post">
            <div class="row">
                <div class="col">
                <input type="text" class="form-control" placeholder="Search blood group" name="bloodgroup" value="<?php echo isset($searchBloodGroup) ? htmlspecialchars($searchBloodGroup) : ''; ?>">
                </div>
                <div class="col">
                <input type="text" class="form-control" placeholder="Search location" name="location" value="<?php echo isset($searchLocation) ? htmlspecialchars($searchLocation) : ''; ?>">
                </div>
                <div class="col">
                    <button class="btn btn-dark btn-md" name="submit">Search</button>
                </div>
            </div>
        </form>
        <?php
        if ($showRecords) {
            echo '<div class="container my-5">
            <table class="table">';
            
            // Prepare the SQL query with search filters
            $sql = "SELECT * FROM `signup_data` WHERE 1=1";

            // Add search filters to the SQL query
            if (!empty($searchBloodGroup)) {
                $sql .= " AND bloodgroup = '$searchBloodGroup'";
            }
            if (!empty($searchLocation)) {
                $sql .= " AND location LIKE '%$searchLocation%'";
            }

            // Execute the SQL query
            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    echo '
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Email ID</th>
                            <th>Contact No.</th>
                        </tr>
                    </thead>';

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                        <tbody>
                            <tr>
                                <td>' . $row['name'] . '</td>
                                <td>' . $row['location'] . '</td>
                                <td>' . $row['email'] . '</td>
                                <td>' . $row['contact_no'] . '</td>
                            </tr>
                        </tbody>';
                    }

                } else {
                    echo '<h2 class="text-danger">Data not found</h2>';
                }
            } else {
                echo '<h2 class="text-danger">Error executing query: ' . mysqli_error($conn) . '</h2>';
            }
            
            echo '</table>
            </div>';
        }
        ?>
    </div>
</body>
</html>
