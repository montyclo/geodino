<?php

    $currentDir = getcwd();
    $uploadDirectory = "/uploads/";

    if (isset($_POST['submit'])) {

  	    $errors = []; // Store all foreseen and unforseen errors here

	    $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

	    $fileName = $_FILES['myfile']['name'];
	    $fileSize = $_FILES['myfile']['size'];
	    $fileTmpName  = $_FILES['myfile']['tmp_name'];
	    $fileType = $_FILES['myfile']['type'];
	    $fileExtension = strtolower(end(explode('.',$fileName)));

	    $uploadPath = $currentDir . $uploadDirectory . basename($fileName); 

    	if (!file_exists( $currentDir . $uploadDirectory )) {
		    mkdir( $currentDir . $uploadDirectory, 0777, true );
		}

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload) {
                echo "The file " . basename($fileName) . " has been uploaded";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "These are the errors" . "\n";
            }
        }
    }
    else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload with PHP</title>
</head>
<body>
    <form action="./" method="post" enctype="multipart/form-data">
        Upload a File:
        <input type="file" name="myfile" id="fileToUpload">
        <input type="submit" name="submit" value="Upload File Now" >
    </form>
</body>
</html>

<?php
    }
?>
