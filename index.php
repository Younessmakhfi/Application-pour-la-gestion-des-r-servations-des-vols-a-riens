<?php
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <div class="col-lg-9">
        <div class="search_wrap">
            <form class="search_form" method="post" action="home.php">
                <div class="input_field">
                    <input type="text" placeholder="depart" name="Depart">
                </div>
                <div class="input_field">
                    <input id="datepicker" placeholder="destination" name="Destination">
                </div>

                <div class="search_btn">
                    <button class="boxed-btn4 " type="submit" name="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>