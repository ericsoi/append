<!DOCTYPE html>
<html>
<head>
    <title>Page Title</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php
// Set the path to your Google Contacts CSV file
$csvFilePath = 'contacts.csv';

// Check if the file exists
if (file_exists($csvFilePath)) {
    // Read the CSV file
    $csvData = file_get_contents($csvFilePath);

    // Parse the CSV data
    $csvRows = str_getcsv($csvData, "\n"); // Split the CSV into rows

    // Loop through each row
    foreach ($csvRows as $index => $row) {
        $rowData = str_getcsv($row); // Split the row into data fields

        // Assuming the phone number is in a specific column (e.g., column 34)
        if (count($rowData) >= 35) {
            $phoneNumber = $rowData[34];
            echo "<br>";
            $modalId = 'exampleModal' . $index; // Generate a unique id for each modal
            echo $rowData[0] . ' ' . $rowData[1];
            ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $modalId; ?>">
                <?php echo $rowData[34]; ?>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modalId; ?>Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="<?php echo $modalId; ?>Label">Contact</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            First name: <?php echo $rowData[0];?><br>
                            second name: <?php echo $rowData[1];?><br>
                            Number: <?php echo $phoneNumber; ?><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Apply Loan</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            // Adjust the index as needed
            // echo "Phone Number: $phoneNumber<br>";
        }
    }
} else {
    echo "File not found: $csvFilePath";
}
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
