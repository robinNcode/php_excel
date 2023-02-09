<!DOCTYPE html>
<html>

<head>
    <title>PHP Excel</title>
</head>

<body>
    <form method="POST" action="./process.php" id="form1" enctype="multipart/form-data">
        <input type="file" name="file" id="file" />
        <input type="submit" value="Upload" />
    </form>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#form1").submit(function(e) {
                e.preventDefault();

                var file = $("#file").val();

                // Check if a file is selected
                if (file == "") {
                    alert("Please select a file.");
                    return false;
                }

                // Check if the file is an Excel file
                var extension = file.substr((file.lastIndexOf('.') + 1));
                if (extension != "xlsx" && extension != "xls" && extension != "csv") {
                    alert("Invalid file type. Please select an Excel file.");
                    return false;
                }
                else{
                    $(this).unbind('submit').submit();
                }
            });
        });
    </script>

</body>

</html>