
<?php
/************************************************************
*                                                           *
* db_query.php                                              *
*                                                           *
*   This code connects to the mysql database DRD and        *
*   returns data based on the valeus passed in via POST     *
*   variables.                                              *
*                                                           *
************************************************************/
include('../xml_parser.php');

    /*
       Because of the way ajax works you cannot specify a particular function to call
       only a file that will automatically be executed so you must make a call to
       a function that eventually returns the data for the javascript to process.
    */
    get_data();

    function get_data()
    {
        // Set database connect variables.
        $dbname = 'DRD';
        $dbuser = 'leliebe';
        $dbpass = 'Merm9!87rl1';
        $dbhost = 'localhost';

        // Retrieve the name of the function to call posted by the javascript routine.
        $func_to_call = $_POST['function_name'];

        switch ($func_to_call) {
            case 'get_authors':
                $query_name = "Authors";
                get_authors($query_name);
            break;
            case 'get_plays':
                $query_name = "Plays";
                get_plays($query_name);
            break;
            case 'get_play_text': //This will actually return the XML filename.
                $query_name = "Play_Text";
                get_play_text($query_name);
            break;
            case 'get_titles':
                $query_name = "Titles";
            break;
            default:
                echo "Something went wrong";
        }
        return;
        // echo "$query_name";
        // $query_name = $_POST['query_name'];
        // $field1 = $_POST['field1'];
        // $field2 = $_POST['field2'];
    }

// function get_authors($query_name)
// {
//     $field1 = "";
//     $field2 = "";
//     $field3 = "";
//
//     $sql_query = get_query($query_name, $field1, $field2, $field3);
//     $result = execute_query($sql_query);
//     if (mysqli_num_rows($result)!=0)
//     {
//         echo '<option value=" " selected="selected">Select Author</option>';
//
//         while ($row = $result->fetch_row())
//         {
//             $aname = "$row[1]" . ", " . "$row[0] \n";
//             // echo "$aname\n";
//             echo '<option value="'.$aname.'">'.$aname.'</option>';
//         }
//         // echo '</select>';
//     }
//
//     // echo $result;
// }

function get_plays($query_name)
{
    $field1 = $_POST['field1'];
    $field2 = $_POST['field2'];
    $field3 = "";

    $sql_query = get_query($query_name, $field1, $field2, $field3);
    // echo $sql_query;
    $result = execute_query($sql_query);
    if (mysqli_num_rows($result)!=0)
    {
        // echo "Got results.";
        $count =1;
        echo "<ul class='playsul'>";
        while ($row = $result->fetch_row())
    	{
            $aname = $row[0];
                echo "<li><a href=\"#\" id=\"play$count\" class=\"wsl\">" . $aname . "</a></li>";
            $count++;
    	}
        echo "</ul>";
        // $result = $qry_result->fetch_all();
        // echo $result;
        // echo json_encode($testfetch);

    }
    // echo $result;
}

function get_play_text($query_name)
{
    $field1 = $_POST['field1'];
    $field2 = "";
    $field3 = "";

    $sql_query = get_query($query_name, $field1, $field2, $field3);
    $result = execute_query($sql_query);
    if (mysqli_num_rows($result)!=0)
    {
        $row = $result->fetch_row();
        // echo $row[0];
        parse_xml_file($row[0]);
        // $count =1;
        // echo "<ul class='playsul'>";
        // while ($row = $result->fetch_row())
        // {
        //     $aname = $row[0];
        //         echo "<li><a href=\"#\" id=\"play$count\" class=\"wsl\">" . $aname . "</a></li>";
        //     $count++;
        // }
        // echo "</ul>";
        // $result = $qry_result->fetch_all();
        // echo $result;
        // echo json_encode($testfetch);
    }
}

function get_query($query_name, $field1, $field2, $field3)
{
    switch ($query_name) {
        case 'Authors':
            $sql_query = "select distinct FirstName, LastName
                            from
                                Person
                                ,authorplay
                            where
                                person.idPerson = authorplay.idPerson
                            order by LastName;";
        break;
        case 'Plays':
            $sql_query = "select PlayTitle
                            from
                                play
                                ,person
                                ,authorplay
                           where
                                person.FirstName = '$field1'
                                and person.LastName = '$field2'
                                and person.idPerson=authorplay.idPerson
                                and authorplay.idPlay = play.idPlay;";
        break;
        case 'Play_Text':
            $sql_query = "select link
                            from transcription
                                 , play
                                 ,publication
                           where PlayTitle = '$field1'
                             and play.idPlay = publication.idPlay
                             and publication.idPublication = transcription.idPublication;";
        break;
        case 'Titles':
            $sql_query = "select PlayTitle from play;";
        break;
        default:
            $sql_query = "select FirstName, LastName from Person order by LastName";
    }
    return $sql_query;
}

function execute_query($sql_query)
{
    // echo $sql_query;
    // Set database connect variables.
    $dbname = 'DRD';
    $dbuser = 'leliebe';
    $dbpass = 'Merm9!87rl1';
    $dbhost = 'localhost';

    $mysqli = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
    if($mysqli->connect_errno)
    {
        $error = $mysqli->connect_errno;
    }
    else
    {
        // echo "got a connection";
        $qry_result = $mysqli->query($sql_query);
        return $qry_result;
    }
    // if(mysqli_num_rows($qry_result)!=0)
    // {
    //     echo "got results";
    // }
    // if (mysqli_num_rows($qry_result)!=0)
    // {
    //     $count =1;
    //     echo "<ul class='playsul'>";
    //     while ($row = $qry_result->fetch_row())
    // 	{
    //         $aname = $row[0];
    //             echo "<li><a href=\"#\" id=\"play$count\" class=\"wsl\">" . $aname . "</a></li>";
    //         $count++;
    // 	}
    //     echo "</ul>";


        // $result = $qry_result->fetch_all();
        // echo $result;
        // echo json_encode($testfetch);

  }


  // echo $name;
  // echo $value;
  // foreach ($value as $test) {
  //    echo $test;
  // }

?>
