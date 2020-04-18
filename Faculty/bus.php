<?php
$query = "";
if (isset($_GET["allot"])) {
    $stopName = $_GET["allot"];
    $uId = $_GET["user_id"];
    $query = "select * from table_vehicle where route like '%$stopName%'";
} elseif (isset($_GET["view_busses"])) {
    $query = "select * from table_vehicle";
} else {
    // $query = "select * from table_transport_allot tt join table_user_edupay tu on tt.u_id  = tu.u_id";
    error_reporting(0);
}

$result = mysqli_query($link, $query);
echo "<hr/>";
while ($rowFetched = mysqli_fetch_assoc($result)) {

    // echo $rowFetched["vehicle_id"];
    // echo $rowFetched["route"];?>

    <div class=" rounded" id="bus-display" style="border:none;float:left;height:600px;padding:20px;border-right:1px dotted black;margin-top: 50px">
            <?php
$vId = $rowFetched["vehicle_id"];
    echo "<span class='text-center text-success'>Route " . $rowFetched["route_num"] . "</span>";
    echo "<span class='text-center text-success'>&nbsp; &nbsp; Seats :-" . $rowFetched["seats"] . "</span>";
    echo "<span class='text-center text-success text-capitalize'>&nbsp; &nbsp; vehicle :-" . $rowFetched["vehicle_type"] . "</span>";
    // echo "<br>Registration Number :-".$rowFetched["reg_num"];
    // echo "<br>Route :-".$rowFetched["route"];
    // echo $vId;
    echo "<hr/>";
    echo "<img src='stering.png' style='float:right;margin-right:30px'/><br/><hr style='clear:both'/>";
    $count = mysqli_query($link, "select occupied_seats as seats from table_vehicle where vehicle_id=$vId");

    $rows = mysqli_fetch_assoc($count);
    $sum = $rows["seats"];
    $count = $rowFetched["seats"];
    $type=strtolower($rowFetched["vehicle_type"]);

    $rseater=0;
    $lseater=0;

    if($type=="mini bus")
    {
        $rseater=2;
        $lseater=2;
    }
    else if($type=="bus")
    {
         $rseater=3;
        $lseater=2;
    }
    else if($type=="van")
    {
        $rseater=2;
        $lseater=1;
    }
$templ=0;
$tempr=0;
$gap=false;
$gap2=true;
    for ($i = 0; $i < $count; $i++)
    {
       if($gap)
       {
            $tempr++;
             $gap2=false;
       }
        if($gap2)
        {
            $templ++;
        }

        if($i < $sum)
        {
            echo "<button class='disabled'  style='width:50px;height:50px;border:1px none black;display:inline-block;vertical-align:top;margin:4px;background-image:url(seat.jpg);color:white;border-radius:5px;background-repeat:no-repeat;background-size:cover;background-color: #25282f;' class='seats'></button>";

        }
        else
        {
            echo "<button style='width:50px;height:50px;border:1px none black;display:inline-block;vertical-align:top;margin:4px;background-image:url(vacantseat.jpg);color:white;border-radius:5px;background-repeat:no-repeat;background-size:cover' class='seats'></button>";

        }
        if($templ==$lseater)
        {
            echo "<button style='width:40px;height:50px;border:0px solid black;display:inline-block;vertical-align:top;margin:4px;;color:white;background-color:transparent;border-radius:5px' class='seats'> </button>";
           $templ=0;
           $gap=true;


        }
        if($tempr==$rseater)
        {
            echo "<br/>";
            $gap=false;
            $tempr=0;
           $gap2=true;
        }
    }
    $sum = 0;
    $count = 0;


    if (isset($_GET["allot"])) {
        ?>

        <form action="approve.php" style="width:300px;">
           <div class="container">
            <div class="form-group">
                <h1 for="" class="ml-4 mt-1 h6 text-danger">Fee</h1>
                <input type="number" name="fee" min="0"  class="form-control" placeholder="Fee in Indian Currency" required>

            </div>
           </div>
            <input type="hidden" value="<?php echo $uId; ?>" name="hidden_btn">
            <button class="btn btn-block btn-primary mb-1" type="submit" value="<?php echo $vId ?>" name="allot_seat_in">
                Allot this Bus
            </button>
        </form>
        <?php
}?>

    </div>


<?php
}

?>
