<?php include("includes/header.php"); 

if(!$session_object->is_signed_in()){
    redirect("login.php");
}

$photos = Photo::find_all();
?>
<style>

img{
    width:200px;
    height:200px;
}

</style>

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
                            PHOTOS
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Photo Page
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="col-md-12">
                
                    <table class="table table-hover">
                    
                        <thead>
                        
                            <tr>
                                <th>Image</th>
                                <th>Photo Id</th>
                                <th>File Name</th>
                                <th>Title</th>
                                <th>Size</th>
                                <th>Comments</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach($photos as $photo): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo $photo->picture_path();?>" class="thumbnail" alt="">
                                        <div class="pictures_link">
                                            <a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                            <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                            <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                                        </div>
                                    </td>
                                    <td><?php echo $photo->id; ?></td>
                                    <td><?php echo $photo->filename; ?></td>
                                    <td><?php echo $photo->title; ?></td>
                                    <td><?php echo $photo->size; ?></td>
                                    <td><a href="comment_photo.php?id=<?php echo $photo->id?>">
                                        <?php
                                        
                                        echo count($comments = Comment::find_comments($photo->id));


                                        ?></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>