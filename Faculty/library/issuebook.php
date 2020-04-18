

<?php
 include '../../include/db_config.php';
        if (isset($_GET["bookid"]))
        {
	        $book_id = $_GET["bookid"];
	        $reg_num = $_GET["regno"];
            $date = date_create(date("Y-m-d"));
            date_add($date, date_interval_create_from_date_string("60 days"));
            $expiryDate = date_format($date, "Y-m-d");
//            echo $expiryDate;



                $result = mysqli_query($link, "select book_id,available from table_book where book_id = '$book_id'");
                $row = mysqli_fetch_assoc($result);
                if (mysqli_num_rows($result) == 1) {
                    if($row["available"] == 'available') {
                       // mysqli_query($link,"select * from table_alloted_books where book_id = '$book_id' and reg_num = '$reg_num' and alloted_date = NOW() and return_date = '$expiryDate'");

                    mysqli_query($link, "insert into table_alloted_books(book_id,reg_num,alloted_date,return_date,fine,daysover,status) values ('$book_id','$reg_num',NOW(),'$expiryDate',0,0,'alloted')");
//                    $dateset = mysqli_query($link,"select alloted_date from table_alloted_books where book_id = $book_id and reg_num = '$reg_num'");
//                    $dateFetched = mysqli_fetch_assoc($dateset);
//                    $dateAlloted = $dateFetched["alloted_date"];
//                    $date = date_create($dateAlloted);
//                    date_add($date, date_interval_create_from_date_string("60 days"));
//                    $expiryDate = date_format($date, "Y-m-d");
                    //mysqli_query($link,"update table_alloted_books set return_date = '$expiryDate' where book_id = $book_id and reg_num = '$reg_num' and ");
                    mysqli_query($link,"update table_book set available = 'pending'");
                        echo "<script>alert('Book Has Been Issued Successfully');window.location='library_students.php'</script>";
                } else {
                        header("location:library_students.php?regNum2=$reg_num");
                        }
                } else {
                    header("location:library_students.php?regNum=$reg_num");
                }
        
  

        }
    ?>