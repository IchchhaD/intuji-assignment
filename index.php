<?php

    require 'includes/header.php';

?>

    <div class="container main-container">

        <div class="row">
            <div class="col-12">
                <h1>My Google Calendar Events</h1>
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
                    <button type="submit" class="btn btn-danger">Disconnect From Calendar</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>