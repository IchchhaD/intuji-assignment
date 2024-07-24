<?php

    require 'includes/header.php';
    
    session_start();
    
    if(isset($_SESSION['access_token']))
    {
        $btn_a_content = "Connected to Calendar";
        $btn_b_content = "Disconnect from Calendar";
    }
    else
    {
        $btn_b_content = "Connected to Calendar";
        $btn_a_content = "Disconnect from Calendar";
    }

?>

    <div class="container main-container">

        <div class="row">
            <div class="col-12">
                <h1>My Google Calendar Events</h1>
            </div>
        </div>

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

        <div class="row">
            <div class="col-4 link-container">
                <form action="core/disconnect.php" class="btn-disconnect" method="post">
                    <button type="submit" class="btn btn-danger"><?php echo $btn_b_content; ?></button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>