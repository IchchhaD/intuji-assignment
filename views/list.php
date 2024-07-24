<?php

//frontend for listing events

    require '../includes/header.php';
    require '../core/calendar.php';
    
    if(isset($_POST['delete_event']))
    {
        $eventId = $_POST['event_id'];
        deleteEvent($eventId);
    }

    $events = listEvents();

    function formatDate($date)
    {
        $o_date = new DateTime($date);
        $new_date = $o_date->format('Y-m-d H:i');
        return $new_date;
    }
?>

<div class="container list-container">

    <div class="row">
        <div class="col-12">
            <h2>List Events</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="container mt-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Event Summary</th>
                            <th>Event Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($events as $event): ?>
                            <tr>
                                
                                <td style="width:60%"><?php echo $event->getSummary(); ?></td>                                
                                <td style="width:30%">
                                    <?php
                                        $date = formatDate($event->getStart()->getDateTime()); 
                                        echo $date;
                                    ?>
                                </td>
                                <td style="width:10%">
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="event_id" value="<?php echo $event->getId(); ?>">
                                        <button type="submit" name="delete_event" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a href="../index.php" class="btn btn-warning dash-link">Dashboard</a>
        </div>
    </div>
</div>
     
</body>
</html>