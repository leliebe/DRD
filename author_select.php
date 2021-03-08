<?php /* This is a required tag and must have a matching tag at the end of your code. */
/************************************************************
*                                                           *
* mysql_connect_test.php
*                                                           *                                  *
*   This code tests to insure that php can connect to your  *
* mysql database.  Just put this file in your doc root, set *
* the four variables with the correct information for your  *
* database and run it from your browser.                    *
*                                                           *
************************************************************/

/* Comments for PHP can use either
this multi line form or */

# this single line form.

/*
   The first form is more standard for documenting your code but
   the # form is great for commenting out single lines while debugging
   since it does not require a matching end tag.
*/

/* Set the variables for your database connection. */
$dbname = '****';
$dbuser = '****';
$dbpass = '****';
$dbhost = '****';

/* Set up the connection string to the database. */
// $conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
/* Establish the connection to the database. */
// mysqli_select_db($conn, $dbname) or die("Could not open the db '$dbname'");

// SELECT FirstName, LastName, PlayTitle
//    FROM
//     		Play pl
//     		,AuthorPlay ap
//     		,Person pe
//  WHERE
// 		pe.idPerson = 73
//                 and ap.idPerson = pe.idPerson
//                 and ap.idPlay = pl.idPlay;
$mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
if($mysqli->connect_errno){
echo $mysqli->connect_errno;
} else {

  // $test_query = "SHOW TABLES FROM $dbname";
  // $result = $mysqli->query($test_query);

  $test_query2 = "select FirstName, LastName from Person order by LastName";
  $result2 = $mysqli->query($test_query2);
}
// $test_query = "SHOW TABLES FROM $dbname"; /* This is the query that is being run...could be a select statement. */
// $result = mysqli_query($conn, $test_query); /* Run the query...the data returned is put in $result. */

// $test_query2 = "select FirstName, LastName from Person order by LastName";
// $result2 = mysqli_query($conn, $test_query2); /* Run the query...the data returned is put in $result. */

/* Process your data. */
// $tblCnt = 0;
// while($tbl = mysqli_fetch_array($result)) {
//   $tblCnt++;
//   echo $tbl[0]."<br />\n";
// }
// while ($row = $result2->fetch_row()) {
//         $aname = "$row[0]" . " " . "$row[1] \n";
//     }

/* The echo statements write to your display. */
// if (!$tblCnt) {
//   echo "There are no tables<br />\n";
// } else {
//   echo "There are $tblCnt tables<br />\n";
// }

// while ($row = $result2->fetch_assoc()) {
//     echo $row['Test'];
// }

// if (mysqli_num_rows($result2)!=0)
// 	{
//     // echo '<select name="auth_sel" class="auth_sel" onchange="dispName(this);"> <option value=" " selected="selected">Select Author</option>';
//     while ($row = $result2->fetch_row())
// 		{
//       $aname = "$row[1]" . ", " . "$row[0] \n";
//       echo "$aname\n";
//       echo '<option value="'.$aname.'">'.$aname.'</option>';
// 		}
//     echo '</select>';
//   }

/* Always make sure to close your connection when you are finished with it. */
mysqli_close($mysqli);

/* Matching tag */
?>
