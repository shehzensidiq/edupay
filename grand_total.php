<?php
    
    $quantity = $rowFetched["quantity"];
    $grandTotal = 0;
    $quantityExploded = explode(",",$quantity);
    $price = $rowFetched["price"];
    $total = 0;
    $priceExploded = explode(",",$price);
    for ($i = 0; $i < sizeof($quantityExploded)-1; $i++) {
        $quantityExploded[$i]=(int)$quantityExploded[$i];
        $priceExploded[$i]=(int)$priceExploded[$i];
        $total = $priceExploded[$i]*$quantityExploded[$i];
        if(isset($_GET["bill_btn"])) {
            echo $total,"/-<hr>";
            }
        $grandTotal += $total;
        }
        
        ?>