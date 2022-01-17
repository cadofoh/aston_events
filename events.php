
<?php
require_once "connectdb.php";
?>

<body>
    <!-- Include Header File -->
    <?php include('header.php'); ?>

    <?php
    $bookErr = "Please Login To Book An Event";
    $alreadyExists = "Booking Already Exists";
    $bookSuccess = "Event Booked Successfully";

    ?>

    <section>
        <!-- Event Header Text -->
        <div class="home-event-text">
            <h1>Events you can<br> book onto</h1>
            <p>
                Down below we have a selection of events, starting with Sports, Culture and Other events.
                Aston University Students are able to look through the catalogue of events and book onto them with the click of a button. <br>
            </p>
        </div>

        <div class="headers">
            <h1>Sports Events</h1>
        </div>

        <div class="sport-events">
            <div class="category1">
                <div class="e_icon"> <img src="images/football.png" alt=""> </div>

                <!-- Query Database and Echo Out Event Info -->
                <?php
                $query = "SELECT * FROM events_table WHERE event_id = 1 ";  ?>
                <!-- Include Event Info -->
                <?php include('event_info.php');
                $check = $conn->query("SELECT * FROM bookings_table WHERE event_id = $event_id AND user_id = $user_id");   ?>

                <!-- Book Event Button -->
                <form action="" method="POST">

                    <input type="submit" class="btn btn-primary" value="Book" name="book1">
                </form>

                <?php if (isset($_POST["book1"])) {
                    if (!isset($_SESSION["loggedin"])) {
                        $bookErr = "Please Login To Book An Event";
                        echo "<script type='text/javascript'>
                        alert('$bookErr');
                        window.location.href = 'login.php';                   
                        </script>";
                    } else if ($check->num_rows) {
                        echo "<script type ='text/javascript'> alert('$alreadyExists'); </script> ";
                    } else {
                        //Attempt insert query execution
                        $sql = "INSERT INTO bookings_table (event_id,user_id) VALUES ($event_id,$user_id)  ";
                        if ($conn->query($sql) === true) {

                            echo "<script type='text/javascript'>alert('$bookSuccess');
                            window.location.href = 'bookedevents.php';                      
                           </script>";
                        } else {
                            echo "Error: Booking was not successfuly Made $sql" . $conn->error;
                        }
                    }
                }
                ?>

            </div>

            <div class="category1">
                <div class="e_icon"><img src="images/basketball.png" alt=""></div>
                <!-- Query Database and Echo Out Event Info -->
                <?php
                $query = "SELECT * FROM events_table WHERE event_id = 2  ";
                ?>
                <!-- Include Event Info -->
                <?php include('event_info.php');
                $check = $conn->query("SELECT * FROM bookings_table WHERE event_id = $event_id AND user_id = $user_id");   ?>
                <form action="" method="POST">
                    <input type="submit" class="btn btn-primary" value="Book" name="book2">
                </form>

                <?php if (isset($_POST["book2"])) {
                    if (!isset($_SESSION["loggedin"])) {

                        echo "<script type='text/javascript'>alert('$bookErr');window.location.href = 'login.php';</script>";
                    } elseif ($check->num_rows) {
                        $alreadyExists = "Booking Already Exists";
                        echo "<script type ='text/javascript'> alert('$alreadyExists'); </script> ";
                    } else {
                        //Attempt insert query execution
                        $sql = "INSERT INTO bookings_table (event_id,user_id) VALUES ($event_id,$user_id)   ";
                        if ($conn->query($sql) === true) {
                            $bookSuccess = "Event Booked Successfully";
                            echo "<script type='text/javascript'>alert('$bookSuccess');
                             window.location.href = 'bookedevents.php';
                            </script>";
                        } else {
                            echo "Error: Booking was not successfuly Made $sql" . $conn->error;
                        }
                    }
                }

                ?>

            </div>

            <div class="category1">
                <div class="e_icon"> <img src="images/tennis.png" alt=""></div>

                <!-- Query Database and Echo Out Event Info -->
                <?php
                $query = "SELECT * FROM events_table WHERE event_id = 3  ";
                ?>
                <!-- Include Event Info -->
                <?php include('event_info.php');
                $check = $conn->query("SELECT * FROM bookings_table WHERE event_id = $event_id AND user_id = $user_id");   ?>

                <!-- Book Event Button -->
                <form action="" method="POST">
                    <input type="submit" class="btn btn-primary" value="Book" name="book3">
                </form>

                <?php if (isset($_POST["book3"])) {
                    if (!isset($_SESSION["loggedin"])) {
                        $bookErr = "Please Login To Book An Event";
                        echo "<script type='text/javascript'>alert('$bookErr'); window.location.href = 'login.php';</script>";
                    } elseif ($check->num_rows) {
                        $alreadyExists = "Booking Already Exists";
                        echo "<script type ='text/javascript'> alert('$alreadyExists'); </script> ";
                    } else {
                        //Attempt insert query execution
                        $sql = "INSERT INTO bookings_table (event_id,user_id) VALUES ($event_id,$user_id)  ";
                        if ($conn->query($sql) === true) {
                            $bookSuccess = "Event Booked Successfully";
                            echo "<script type='text/javascript'>alert('$bookSuccess');
                            window.location.href = 'bookedevents.php';
                            </script>";
                        } else {
                            echo "Error: Booking was not successfuly Made $sql" . $conn->error;
                        }
                    }
                }
                ?>

            </div>

        </div>



        <div class="headers">
            <h1>Culture Events</h1>
        </div>


        <div class="culture-events">
            <div class="category2">
                <div class="e_icon"> <img src="images/theatre.png" alt=""></div>

                <!-- Query Database and Echo Out Event Info -->
                <?php
                $query = "SELECT * FROM events_table WHERE event_id = 4 ";
                ?>
                <!-- Include Event Info -->
                <?php include('event_info.php');
                $check = $conn->query("SELECT * FROM bookings_table WHERE event_id = $event_id AND user_id = $user_id");   ?>

                <!-- Book Event Button -->
                <form action="" method="POST">
                    <input type="submit" class="btn btn-primary" value="Book" name="book4">
                </form>

                <?php if (isset($_POST["book4"])) {
                    if (!isset($_SESSION["loggedin"])) {
                        $bookErr = "Please Login To Book An Event";
                        echo "<script type='text/javascript'>alert('$bookErr');window.location.href = 'login.php';</script>";
                    } elseif ($check->num_rows) {
                        $alreadyExists = "Booking Already Exists";
                        echo "<script type ='text/javascript'> alert('$alreadyExists'); </script> ";
                    } else {
                        //Attempt insert query execution
                        $sql = "INSERT INTO bookings_table (event_id,user_id) VALUES ($event_id,$user_id)  ";
                        if ($conn->query($sql) === true) {
                            $bookSuccess = "Event Booked Successfully";
                            echo "<script type='text/javascript'>alert('$bookSuccess');
                              window.location.href = 'bookedevents.php';
                            </script>";
                        } else {
                            echo "Error: Booking was not successfuly Made $sql" . $conn->error;
                        }
                    }
                }
                ?>

            </div>


            <div class="category2">
                <div class="e_icon"> <img src="images/history.png" alt=""></div>

                <!-- Query Database and Echo Out Event Info -->
                <?php
                $query = "SELECT * FROM events_table WHERE event_id = 5 ";
                ?>
                <!-- Include Event Info -->
                <?php include('event_info.php');
                $check = $conn->query("SELECT * FROM bookings_table WHERE event_id = $event_id AND user_id = $user_id");  ?>
                <!-- Book Event Button -->
                <form action="" method="POST">
                    <input type="submit" class="btn btn-primary" value="Book" name="book5">
                </form>

                <?php if (isset($_POST["book5"])) {
                    if (!isset($_SESSION["loggedin"])) {
                        $bookErr = "Please Login To Book An Event";
                        echo "<script type='text/javascript'>alert('$bookErr'); window.location.href = 'login.php';</script>";
                    } elseif ($check->num_rows) {
                        $alreadyExists = "Booking Already Exists";
                        echo "<script type ='text/javascript'> alert('$alreadyExists'); </script> ";
                    } else {
                        //Attempt insert query execution
                        $sql = "INSERT INTO bookings_table (event_id,user_id) VALUES ($event_id,$user_id)  ";
                        if ($conn->query($sql) === true) {
                            $bookSuccess = "Event Booked Successfully";
                            echo "<script type='text/javascript'>alert('$bookSuccess');
                             window.location.href = 'bookedevents.php';
                            </script>";
                        } else {
                            echo "Error: Booking was not successfuly Made $sql" . $conn->error;
                        }
                    }
                }
                ?>

            </div>



            <div class="category2">
                <div class="e_icon"> <img src="images/art.png" alt=""></div>


                <!-- Query Database and Echo Out Event Info -->
                <?php
                $query = "SELECT * FROM events_table WHERE event_id = 6 ";
                ?>
                <!-- Include Event Info -->
                <?php include('event_info.php');
                $check = $conn->query("SELECT * FROM bookings_table WHERE event_id = $event_id AND user_id = $user_id");   ?>

                <!-- Book Event Button -->
                <form action="" method="POST">
                    <input type="submit" class="btn btn-primary" value="Book" name="book6">
                </form>

                <?php if (isset($_POST["book6"])) {
                    if (!isset($_SESSION["loggedin"])) {
                        $bookErr = "Please Login To Book An Event";
                        echo "<script type='text/javascript'>alert('$bookErr'); window.location.href = 'login.php';</script>";
                    } elseif ($check->num_rows) {
                        $alreadyExists = "Booking Already Exists";
                        echo "<script type ='text/javascript'> alert('$alreadyExists'); </script> ";
                    } else {
                        //Attempt insert query execution
                        $sql = "INSERT INTO bookings_table (event_id,user_id) VALUES ($event_id,$user_id)  ";
                        if ($conn->query($sql) === true) {
                            $bookSuccess = "Event Booked Successfully";
                            echo "<script type='text/javascript'>alert('$bookSuccess');
                            window.location.href = 'bookedevents.php';
                            </script>";
                        } else {
                            echo "Error: Booking was not successfuly Made $sql" . $conn->error;
                        }
                    }
                }
                ?>
            </div>
        </div>
        </div>

        <div class="headers">
            <h1>Other Events</h1>
        </div>


        <div class="other-events">
            <div class="category3">
                <div class="e_icon"> <img src="images/live-band.png" alt=""></div>

                <!-- Query Database and Echo Out Event Info -->
                <?php
                $query = "SELECT * FROM events_table WHERE event_id = 7 ";
                ?>
                <!-- Include Event Info -->
                <?php include('event_info.php');
                $check = $conn->query("SELECT * FROM bookings_table WHERE event_id = $event_id AND user_id = $user_id");   ?>


                <!-- Book Event Button -->
                <form action="" method="POST">
                    <input type="submit" class="btn btn-primary" value="Book" name="book7">
                </form>

                <?php if (isset($_POST["book7"])) {
                    if (!isset($_SESSION["loggedin"])) {
                        $bookErr = "Please Login To Book An Event";
                        echo "<script type='text/javascript'>alert('$bookErr');  window.location.href = 'login.php';</script>";
                    } elseif ($check->num_rows) {
                        $alreadyExists = "Booking Already Exists";
                        echo "<script type ='text/javascript'> alert('$alreadyExists'); </script> ";
                    } else {
                        //Attempt insert query execution
                        $sql = "INSERT INTO bookings_table (event_id,user_id) VALUES ($event_id,$user_id)  ";
                        if ($conn->query($sql) === true) {
                            $bookSuccess = "Event Booked Successfully";
                            echo "<script type='text/javascript'>alert('$bookSuccess');
                              window.location.href = 'bookedevents.php';
                            </script>";
                        } else {
                            echo "Error: Booking was not successfuly Made $sql" . $conn->error;
                        }
                    }
                }
                ?>
            </div>

            <div class="category3">
                <div class="e_icon"> <img src="images/game-night.png" alt=""></div>

                <!-- Query Database and Echo Out Event Info -->
                <?php
                $query = "SELECT * FROM events_table WHERE event_id = 8 ";
                ?>

                <?php include('event_info.php');
                $check = $conn->query("SELECT * FROM bookings_table WHERE event_id = $event_id AND user_id = $user_id");  ?>

                <!-- Book Event Button -->
                <form action="" method="POST">
                    <input type="submit" class="btn btn-primary" value="Book" name="book8">
                </form>

                <?php if (isset($_POST["book8"])) {
                    if (!isset($_SESSION["loggedin"])) {
                        $bookErr = "Please Login To Book An Event";
                        echo "<script type='text/javascript'>alert('$bookErr');  window.location.href = 'login.php';</script>";
                    } elseif ($check->num_rows) {
                        $alreadyExists = "Booking Already Exists";
                        echo "<script type ='text/javascript'> alert('$alreadyExists'); </script> ";
                    } else {
                        //Attempt insert query execution
                        $sql = "INSERT INTO bookings_table (event_id,user_id) VALUES ($event_id,$user_id)  ";
                        if ($conn->query($sql) === true) {
                            $bookSuccess = "Event Booked Successfully";
                            echo "<script type='text/javascript'>alert('$bookSuccess');
                             window.location.href = 'bookedevents.php';
                            </script>";
                        } else {
                            echo "Error: Booking was not successfuly Made $sql" . $conn->error;
                        }
                    }
                }
                ?>
            </div>

            <div class="category3">
                <div class="e_icon"><img src="images/bro-talk.png" alt=""> </div>

                <!-- Query Database and Echo Out Event Info -->
                <?php
                $query = "SELECT * FROM events_table WHERE event_id = 9 ";
                ?>

                <!-- Include Event Info -->
                <?php include('event_info.php');
                $check = $conn->query("SELECT * FROM bookings_table WHERE event_id = $event_id AND user_id = $user_id");  ?>

                <!-- Book Event Button -->
                <form action="" method="POST">
                    <input type="submit" class="btn btn-primary" value="Book" name="book9">
                </form>

                <?php if (isset($_POST["book9"])) {
                    if (!isset($_SESSION["loggedin"])) {
                        $bookErr = "Please Login To Book An Event";
                        echo "<script type='text/javascript'>alert('$bookErr');     window.location.href = 'login.php';</script>";
                    } elseif ($check->num_rows) {
                        $alreadyExists = "Booking Already Exists";
                        echo "<script type ='text/javascript'> alert('$alreadyExists'); </script> ";
                    } else {
                        //Attempt insert query execution
                        $sql = "INSERT INTO bookings_table (event_id,user_id) VALUES ($event_id,$user_id)  ";
                        if ($conn->query($sql) === true) {
                            $bookSuccess = "Event Booked Successfully";
                            echo "<script type='text/javascript'>alert('$bookSuccess');
                             window.location.href = 'bookedevents.php';
                            </script>";
                        } else {
                            echo "Error: Booking was not successfuly Made $sql" . $conn->error;
                        }
                    }
                }
                ?>

            </div>
        </div>

    </section>

    <script src="js/script.js"></script>

</body>

</html>