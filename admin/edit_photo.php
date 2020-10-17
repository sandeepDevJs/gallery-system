<?php include("includes/header.php"); 

if(!$session_object->is_signed_in()){
    redirect("login.php");
}

if(empty($_GET['id'])){
    redirect("photos.php");
}else{
    $photo  = Photo::find_by_id($_GET['id']);
    if (isset($_POST['update'])) {
    if ($photo) {
        $photo->title       = $_POST['title'];
        $photo->description = $_POST['description'];

        $photo->save();
    }
}

}
?>
<style>

img{
    width:50%;
    height:50%;
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
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <form action="edit_photo.php?id=<?php echo $photo->id; ?>" method="post">
                <div class="col-md-8">
                
                    <div class="form-group">
                    
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">

                    </div>
                    <div class="form-group">
                    
                        <a href=""><img src="<?php echo $photo->picture_path(); ?>" alt="" class="thumbnail"></a>

                    </div>
                    <div class="form-group">
                    
                        <label for="">Description</label>
                        <textarea class="form-control" name="description" cols="30" rows="10"><?php echo $photo->description; ?></textarea>

                    </div>

                </div>

                
                <div class="col-md-4" >
                            <div  class="photo-info-box">
                                <div class="info-box-header">
                                   <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>
                            <div class="inside">
                              <div class="box-inner">
                                 <p class="text">
                                   <span class="glyphicon glyphicon-calendar"></span> <?php echo $photo->date_added;?>
                                  </p>
                                  <p class="text ">
                                    Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                  </p>
                                  <p class="text">
                                    Filename: <span class="data"><?php echo $photo->filename; ?></span>
                                  </p>
                                 <p class="text">
                                  File Type: <span class="data"><?php echo $photo->type; ?></span>
                                 </p>
                                 <p class="text">
                                   File Size: <span class="data"><?php echo $photo->size; ?></span>
                                 </p>
                              </div>
                              <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg photo-delete">Delete</a>   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                </div>   
                              </div>
                            </div>          
                        </div>
                </div>
                </form>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>