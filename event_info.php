
<!-- Contains the description of the events -->

<?php if ($result = $conn->query($query)) {

  while ($row = $result->fetch_assoc()) {

    $event_id = $row["event_id"];
    $name = $row["name"];
    $description = $row["description"];
    $venue = $row["venue"];
    $date = $row["date"];
    $time = $row["time"];
    $organiser = $row["organiser"];
    $contact = $row["contact"];
  }
}
?>


<h2><?php echo $name ?></h2>
<ul>
  <li> Description: <?php echo "" . $description ?> </li>
  <hr>
  <li>Venue: <?php echo "" . $venue ?></li>
  <hr>
  <li>Date: <?php echo "" . $date ?></li>
  <hr>
  <li>Time: <?php echo "" . $time ?> </li>
  <hr>
  <li>Organiser: <?php echo "" . $organiser ?> </li>
  <hr>
  <li>Contact: <?php echo "" . $contact ?></li>
</ul>