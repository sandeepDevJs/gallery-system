<?php include("includes/header.php"); ?>
<?php
 
 if(!$session_object->is_signed_in()){
    redirect("login.php");
 }

 if(isset($_POST['submit'])){
    $file = array();
    for($i = 0; $i < count($_FILES['file_upload']['name']); $i++){  
        $photo = new Photo();
        $photo->title = $_POST['title'];
        $photo->description = $_POST['description'];  
        $file['name'] = $_FILES['file_upload']['name'][$i];
        $file['tmp_name'] = $_FILES['file_upload']['tmp_name'][$i];
        $file['type'] = $_FILES['file_upload']['type'][$i];
        $file['size'] = $_FILES['file_upload']['size'][$i];
        $file['error'] = $_FILES['file_upload']['error'][$i];
        $photo->set_file($file);
        if(!$photo->multi_upload()){
            $messages = $photo->errors;
        }

        //$photo->set_file($_FILES['file_upload']);
    }
    // $photo = new Photo();
    // $photo->title = $_POST['title'];
    // $photo->description = $_POST['description'];
    
    // if($photo->save()){
    //     $message = "File Uploaded Successfully!!";
    // }else{
    //     $message = join("<br>", $photo->errors);
    // }
 }

?>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

            <?php 
            
                include("includes/top_nav.php");

            ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

            <?php
            
                include("includes/side_nav.php");

            ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            UPLOAD
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> upload
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6">
                    <p class="text-danger">
                        <?php
                        if(isset($messages)){
                            foreach($messages as $message)
                            {
                                echo $message;
                            }
                            echo "Rest Files Are Uploaded!!!";
                        }
                        ?>

                    </p>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                    
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="description" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="file" name="file_upload[]" class="dropzone" multiple>
                        </div>

                        <input type="submit" class="btn btn-warning" name="submit">

                    </form>
                </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>