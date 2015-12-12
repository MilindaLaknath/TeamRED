<?php
date_default_timezone_set("Asia/Colombo");
require 'class/db.php';
?>

<html>

    <head>
        <title>
            Greeen Project SMS Portal.
        </title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>




    </head>

    <body>
        <div class="row">
            <div class="col-md-4">
                
                <!--<img alt="Bootstrap Image Preview" src="https://ideamarthosting.dialog.lk/milindalApps/egreen/bootstrap/Logo.png" class="img-rounded" />-->
            </div>
            <div class="col-md-4" >
                <img alt="Bootstrap Image Preview" src="./bootstrap/Logo.png" class="img-rounded" width="320px" height="150px"/>
                <h3>Subscriber Announcement Portal</h3>
            </div>
            <div class="col-md-4"  >
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <form role="form" action="websmshandl.php" method="post">
                    <div class="form-group">
                        <label for="date">
                            Date : 
                        </label>
                        <span>
                            <?php
                            $format = "y:M:d h:m a";
                            echo date($format);
                            ?>
                        </span>
                        <br/>
                        <label for="count">
                            Number of Subscribers :
                        </label>
                        <span>
                            <?php
                            $qury = "SELECT COUNT(userid) as uidcount FROM egusers";
                            $result = mysqli_query($connection, $qury);
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $count = $row["uidcount"];
                            }
                            $count+=125;
                            echo "$count";
                            ?>
                        </span>
                        <br/>
                        <label for="egrnsms">
                            Enter Message :
                        </label>
                        <!--<input type="text" class="form-control" id="egrnmsg"  row="10"/>-->
                        <textarea id="egrnmsg" name="egrnmsg" class="form-control" rows="5" id="comment"></textarea>
                    </div>                    
                    <button type="Submit"  class="btn btn-block">
                        SEND
                    </button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>


    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" type="text/javascript"></script>


</html>