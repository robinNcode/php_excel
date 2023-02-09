<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
include 'helper.php';

if (isset($_FILES["file"])) {
    $file = $_FILES["file"]["tmp_name"];
    $fileSize = $_FILES["file"]["size"];

    // Check the size of the file
    if ($fileSize > 10485760) { // 10 MB
        echo "File size exceeds the maximum limit.";
        return;
    }

    require_once 'vendor/autoload.php';

    // Load the Excel file
    try {
        $spreadsheet = IOFactory::load($file);
    } catch (Exception $e) {
        echo "Invalid Excel file.";
        return;
    }

    $sheet = $spreadsheet->getSheet(0);

    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    for ($row = 1; $row <= $highestRow; $row++) {
        $rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
    }

    echo "File uploaded successfully";
} else {
    echo "File not found";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP Excel</title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                text-align: center;
            }
            th, td {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <!-- Table To Display Excel Data -->
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>pH</th>
                    <th>Temparature</th>
                    <th>Taste</th>
                    <th>Odor</th>
                    <th>Fat</th>
                    <th>Turbidity</th>
                    <th>Color</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($rowData)) {
                    foreach ($rowData as $index=>$row) {
                        echo "<tr>";
                        echo "<td>" . ++$index . "</td>";
                        foreach ($row[0] as $cell) {
                            echo "<td>" . $cell . "</td>";
                        }
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        
    </body>
</html>
