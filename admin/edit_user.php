<?php include "includes/header.php";

if (!$session_object->is_signed_in()) {
    redirect("login.php");
}

if (empty($_GET['id'])) {
    redirect("users.php");
} else {
    $user = user::find_by_id($_GET['id']);
    if (isset($_POST['update'])) {
        if ($user) {
            $user->first_name = $_POST['first_name'];
            $user->last_name  = $_POST['last_name'];
            $user->username   = $_POST['username'];
            if (isset($_FILES['file_upload'])) {
                $user->set_file($_FILES['file_upload']);
                if($user->save_user_by_image()){
                    $user->user_image = $user->filename;
                }
            
                $user->update();
            }
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

include "includes/top_nav.php";

?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

            <?php

include "includes/side_nav.php";

?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            users
                            <small>Subheading</small>
                        </h1>
                        <div class="col-md-6">
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <input type="hidden" id="user-id" value="<?php echo $user->id; ?>" >
                <form action="edit_user.php?id=<?php echo $user->id; ?>" method="post" enctype="multipart/form-data" >
                    <?php print_r(@$user->errors); ?>
                <div class="col-md-4">
                    <a href=""  data-toggle="modal" data-target="#photo-modal">
                        <img id="user-image" src="<?php echo $user->get_image(); ?>" alt="">
                    </a>
                </div>
                <div class="col-md-8">

                <div class="form-group">

                <div class="form-group">
                    <input type="file" name="file_upload" class="form-control">
                </div>

                </div>

                    <div class="form-group">

                        <label for="">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">

                    </div>
                    <div class="form-group">

                        <label for="">last Name</label>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">

                    </div>
                    <div class="form-group">

                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">

                    </div>
                    <div class="form-group">

                        <input type="submit" name="update" class="btn btn-warning" value="update">

                    </div>

                </div>
                </form>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
            <?php include("includes/photo_nodal.php"); ?>
        </div>
        <!-- /#page-wrapper -->

  <?php include "includes/footer.php";?>