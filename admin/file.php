<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_POST['submit'])){
            echo "<pre>";
            print_r($_FILES['user_file']);
            echo "</pre>";
            $upload_errors = array(
                UPLOAD_ERR_OK => "There is no error!",
                UPLOAD_ERR_NO_FILE => "No File Was Attaced!"
            );
            if(move_uploaded_file($_FILES['user_file']['tmp_name'], "upload/".$_FILES['user_file']['name'])){
                echo "File Uploaded Successfully!!!";
            }else{
                echo $upload_errors[$_FILES['user_file']['error']];
            }
        }

    ?>
    <form action="file.php" method="post" enctype="multipart/form-data" >
        upload:   <input type="file" name="user_file" id=""><br>
        <button type="submit" name="submit">Submit</button>
    </form>

</body>
</html>