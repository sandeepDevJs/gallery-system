<?php include("includes/header.php"); 

if(!$session_object->is_signed_in()){
    redirect("login.php");
}

$users = User::find_all();
?>
<style>

img{
    width:300px;
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
                            users
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Users
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="col-md-12">
                
                    <table class="table table-hover">
                    
                        <thead>
                        
                            <tr>
                                <th>Photo</th>
                                <th>user Id</th>
                                <th>Usrename</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach($users as $user): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo $user->get_image();?>" class="thumbnail" alt="">
                                    </td>
                                    <td><?php echo $user->id; ?></td>
                                    <td>
                                        <?php echo $user->username; ?>
                                        <div class="pictures_link">
                                            <a class="delete-link" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                            <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                            <a href="">View</a>
                                        </div>
                                    </td>
                                    <td><?php echo $user->first_name; ?></td>
                                    <td><?php echo $user->last_name; ?></td>
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