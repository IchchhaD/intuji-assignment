<?php

    require 'includes/header.php';
    
    session_start();
    
    if(isset($_SESSION['access_token']))
    {
        $btn_a_content = "Connected to Calendar";
    }
    else
    {
        $btn_a_content = "Connect";
    }

?>

    <div class="container main-container">

        <div class="row">
            <div class="col-12">
                <h1>My Google Calendar Events</h1>
            </div>
        </div>
        <!-- links to go to lisitng of events and creation of events-->
        <div class="row">
            <div class="col-4 link-container">
                <form action="core/connect.php" class="btn-disconnect" method="post">
                    <button type="submit" class="btn btn-primary"><?php echo $btn_a_content; ?></button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-4 link-container">
                <a href="views/list.php" class="btn btn-warning link-btn">View All Events</a>
                <a href="views/create.php" class="btn btn-warning link-btn">Create New Events</a>
            </div>
        </div>
        <!--triggers disconnection of calendar-->
        <div class="row">
            <div class="col-4 link-container">
                <form action="core/disconnect.php" class="btn-disconnect" method="post">
                    <button type="submit" class="btn btn-danger">Disconnect</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>