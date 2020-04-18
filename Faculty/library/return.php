<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 23/09/18
 * Time: 10:34 PM
 */
include "../../include/db_config.php";
?>
<?php
if (isset($_GET["returnBtn"])) {
    $regNum = $_GET["regno"];
    $bookId = $_GET["bookId"];
    $id = $_GET["id"];
    mysqli_query($link, "update table_alloted_books set status = 'returned', returned_on = NOW() where book_id = $bookId and reg_num = '$regNum' and id = $id");
    mysqli_query($link,"update table_book set available = 'available' where book_id = '$bookId'");
    echo "<script>alert('Book has Been Returned');window.location='library_students.php'</script>";

}
?>
