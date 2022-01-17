<?php
require_once "connectdb.php";
?>

<body>
    <!-- Include Header File -->
    <?php include('header.php');
    ?>
</body>


<section class="bookedevents">
    <h1>Booked Events</h1>
    <br>
    <table class="table">
        <thead class="thead-dark">

            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Name</th>
                <th scope="col">Event Category</th>
                <th scope="col">Venue</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM bookings_table INNER JOIN events_table ON events_table.event_id = bookings_table.event_id WHERE user_id = $user_id;  ";
            if ($result = $conn->query($query)) {
                $i = 1;
                while ($row = $result->fetch_assoc()) {

                    $event_name = $row["name"];
                    $event_category = $row["category"];
                    $venue = $row["venue"];
                    $date = $row["date"];
                    $time = $row["time"]

            ?>




                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $event_name ?></td>
                        <td><?php echo $event_category ?></td>
                        <td><?php echo $venue ?></td>
                        <td><?php echo $date ?></td>
                        <td><?php echo $time ?></td>
                    </tr>
            <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
    <a href="events.php" class="btn"> Book More Events ?</a>
</section>
<script src="js/script.js"></script>

</html>