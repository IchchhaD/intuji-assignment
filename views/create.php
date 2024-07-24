<?php

//frontend for creating event

    require '../includes/header.php';
    require '../core/calendar.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        if(isset($_POST['create_event']))
        {
            $summary = $_POST['summary'];
            $startDateTime = $_POST['start_datetime'];
            $endDateTime = $_POST['end_datetime'];
            createEvent($summary, $startDateTime, $endDateTime);
        }
        else
        {
            message();
        }
    }

    if(isset($_GET['status']) && $_GET['status']=="success")
    {
        $message = "Event Successfully Created";
    }
    else if(isset($_GET['status']) && $_GET['status']=="fail")
    {
        $message = "Event Creation Failed";
    }
    else
    {
        $message = "";
    }


?>

    <div class="container main-container">
        <div class="row" style="background: #43eb34; padding 5px">
            <div class="col-12">
                <?php echo $message; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="container mt-3">
                    <form method="post">
                        <h2>Create Event</h2>
                        <div class="mb-3 mt-3">
                            <label for="email">Event Summary</label>
                            <input type="text" class="form-control" id="summary" name="summary" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Event Start Date</label>
                            <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Event End Date</label>
                            <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime" required>
                        </div>
                        <button class="btn btn-warning" type="submit" name="create_event">Create Event</button>
                        <a href="../index.php" class="btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>