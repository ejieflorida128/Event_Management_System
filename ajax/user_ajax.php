<?php
    include("../conn/connection.php");
    session_start();

   
        
   // Ajax for displaying the log_info table and search ASC
    if (isset($_POST['log_info']) && $_POST['log_info'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;
    
        echo '<div style="max-height: 400px; max-width: 1200px; font-size: 11px; position: relative; left: 40px; top: 210px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr> 
                    <th scope="col" class="text-center align-middle">Event No.</th>
                    <th scope="col" class="text-center align-middle">Team A</th>
                    <th scope="col" class="text-center align-middle">Team B</th>
                    <th scope="col" class="text-center align-middle" onclick = "DESC()">Date</th>
                    <th scope="col" class="text-center align-middle">Time</th>
                    <th scope="col" class="text-center align-middle">Location</th>
                    <th scope="col" class="text-center align-middle">Action</th>
                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE ASC";
        } else {
            $sql = "SELECT * FROM log_info ORDER BY DATE ASC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $time =  $row['TIME'];
            $location = $row['LOCATION'];
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . '</td>
                <td class="text-center align-middle">' . $teamTwo . '</td>
                <td class="text-center align-middle">' . $date . '</td>
                <td class="text-center align-middle">' . $time . '</td>
                <td class="text-center align-middle">' . $location . '</td>
                <td class="text-center align-middle">
                        <button class = "btn btn-danger" onclick = "ReportEvent('. $id .')">REQUEST</button>
                        
                </td>
            </tr>';
    
            $number++;
    
    
        }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }
    
    // Ajax for displaying the log_info table and search DESC
    if (isset($_POST['log_info_R']) && $_POST['log_info_R'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;
    
      
    
        echo '<div style="max-height: 400px; max-width: 1200px; font-size: 11px; position: relative; left: 40px; top: 150px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr> 
                    <th scope="col" class="text-center align-middle">Event No.</th>
                    <th scope="col" class="text-center align-middle">Team A</th>
                    <th scope="col" class="text-center align-middle">Team B</th>
                    <th scope="col" class="text-center align-middle" onclick = "ASC()">Date</th>
                    <th scope="col" class="text-center align-middle">Time</th>
                    <th scope="col" class="text-center align-middle">Location</th>
                    <th scope="col" class="text-center align-middle">Action</th>
                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE DESC";
        } else {
            $sql = "SELECT * FROM log_info ORDER BY DATE DESC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $time =  $row['TIME'];
            $location = $row['LOCATION'];
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . '</td>
                <td class="text-center align-middle">' . $teamTwo . '</td>
                <td class="text-center align-middle">' . $date . '</td>
                <td class="text-center align-middle">' . $time . '</td>
                <td class="text-center align-middle">' . $location . '</td>
                <td class="text-center align-middle">
                        <button class = "btn btn-success" onclick = "ShowDetailsForEditBtn('. $id .')">EDIT</button>
                        <button onclick = "DeleteEvent('. $id .')" class = "btn  btn-danger">DELETE</button>
                </td>
            </tr>';
    
            $number++;
    
    
        }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }
    
    







    //ajax para ma process and report sa user or player
    if(isset($_POST['user_id'])){

        $reportTeamOne = $_POST['reportTeamOne'];
        $reportTeamTwo = $_POST['reportTeamTwo'];
        $reportDate = $_POST['reportDate'];
        $reportTime = $_POST['reportTime'];
        $reportLocation = $_POST['reportLocation'];
            $user_id = $_POST['user_id'];
         


            $sql = "INSERT INTO report (user_id, TeamOne, TeamTwo, Date, Time, Location) VALUES ('$user_id', '$reportTeamOne', '$reportTeamTwo', '$reportDate', '$reportTime', '$reportLocation')";
mysqli_query($conn, $sql);

echo '<script>';
echo 'alert("You have successfully reported it!");';
echo '</script>';
    }







   //edit profile in the profile section
            if(isset($_POST['fullname']) && isset($_POST['age']) && isset($_POST['gmail'])){
                $age = $_POST['age'];
                $fullname = $_POST['fullname'];
                $gmail = $_POST['gmail'];

                $picture = "../profile_pictures/" . $_POST['profilePic'];


                $id = $_SESSION['id'];

                if(isset($age) && isset($fullname) && isset($gmail) && isset($picture)){

                    $sql = "UPDATE users SET fullname = '$fullname', age = '$age', gmail = '$gmail', profile = '$picture' WHERE id = '$id'";
                    mysqli_query($conn,$sql);
                    
                }else if(isset($age) && isset($fullname) && isset($gmail)){

                    $sql = "UPDATE users SET fullname = '$fullname', age = '$age', gmail = '$gmail' WHERE id = '$id'";
                    mysqli_query($conn,$sql);

                }

               
            }








// Ajax for displaying the teamScore table and search ASC
     if (isset($_POST['displayTeamScoreASC']) && $_POST['displayTeamScoreASC'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;
    
        echo '<div style="max-height: 400px; max-width: 1113px; font-size: 11px; position: relative; left: 122px; top: 90px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr>
                <th scope="col" class="text-center align-middle">Event No.</th>
                <th scope="col" class="text-center align-middle" onclick = "DESC()">Date</th>
                <th scope="col" class="text-center align-middle">Match</th>
                <th scope="col" class="text-center align-middle">Location</th>
                <th scope="col" class="text-center align-middle">Winner</th>
                <th scope="col" class="text-center align-middle">Action</th>
                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE ASC";
        } else {
            $sql = "SELECT * FROM log_info ORDER BY DATE ASC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $teamOneScore = $row['TeamOneScore'];
            $teamTwoScore =  $row['TeamTwoScore'];
            $location = $row['LOCATION'];
          
            $winner = "";

            if($teamOneScore == 0 && $teamTwoScore == 0){
                $winner = "Not Scored Yet";
            }else{
                if($teamOneScore >  $teamTwoScore){
                    $winner = $teamOne;
                }else if($teamOneScore < $teamTwoScore){
                    $winner = $teamTwo;
                }else if($teamOneScore == $teamTwoScore){
                    $winner = "Tied";
                }else{
                    $winner = "Error";
                }
            }
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $date . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . ' VS '.$teamTwo.'</td>
                <td scope="row" class="text-center align-middle">' . $location . '</td>
                <td scope="row" class="text-center align-middle"> '.$winner.' </td>
                <td class="text-center align-middle">
                        <button class = "btn btn-primary" onclick = "viewScore('.$id.')">VIEW</button>
                       
                </td>
            </tr>';
    
            $number++;
    
    
        }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }
    
    // Ajax for displaying the teamScore table and search DESC
    if (isset($_POST['displayTeamScoreDESC']) && $_POST['displayTeamScoreDESC'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;
    
        echo '<div style="max-height: 400px; max-width: 1113px; font-size: 11px; position: relative; left: 122px; top: 90px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr> 
                <th scope="col" class="text-center align-middle">Event No.</th>
                <th scope="col" class="text-center align-middle" onclick = "ASC()">Date</th>
                <th scope="col" class="text-center align-middle">Match</th>
                <th scope="col" class="text-center align-middle">Location</th>
                <th scope="col" class="text-center align-middle">Winner</th>
                <th scope="col" class="text-center align-middle">Action</th>
                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE DESC";
        } else {
            $sql = "SELECT * FROM log_info ORDER BY DATE DESC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $teamOneScore = $row['TeamOneScore'];
            $teamTwoScore =  $row['TeamTwoScore'];
            $location = $row['LOCATION'];
          
            $winner = "";

            if($teamOneScore == 0 && $teamTwoScore == 0){
                $winner = "Not Scored Yet";
            }else{
                if($teamOneScore >  $teamTwoScore){
                    $winner = $teamOne;
                }else if($teamOneScore < $teamTwoScore){
                    $winner = $teamTwo;
                }else if($teamOneScore == $teamTwoScore){
                    $winner = "Tied";
                }else{
                    $winner = "Error";
                }
            }
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $date . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . ' VS '.$teamTwo.'</td>
                <td scope="row" class="text-center align-middle">' . $location . '</td>
                <td scope="row" class="text-center align-middle"> '.$winner.' </td>
                <td class="text-center align-middle">
                        <button class = "btn btn-primary" onclick = "viewScore('.$id.')" >VIEW</button>
                        
                </td>
            </tr>';
    
            $number++;
    
    
        }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }







     //ajax for showing the details from sa databse para ma hibaw and mga score and para ne sa score
     if(isset($_POST['view_score_id'])){
        $user_id = $_POST['view_score_id'];

        $sql = "SELECT * FROM log_info WHERE id = $user_id";
        $result = mysqli_query($conn,$sql);
        $response = array();

        while($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }

        echo json_encode($response);
    }else{
        $response['status'] =   200;
        $response['message'] = "Invalid or Data Information!";
    }











    // Ajax for displaying the Event List table and search ASC
    if (isset($_POST['displayEventListASC']) && $_POST['displayEventListASC'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;
    
        echo '<div style="max-height: 400px; max-width: 1113px; font-size: 11px; position: relative; left: 122px; top: 90px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr> 
                <th scope="col" class="text-center align-middle">Event No.</th>
                <th scope="col" class="text-center align-middle" onclick = "DESC()">Date</th>
                <th scope="col" class="text-center align-middle">Match</th>
                <th scope="col" class="text-center align-middle">Location</th>
                <th scope="col" class="text-center align-middle">Action</th>
                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE ASC";
        } else {
            $sql = "SELECT * FROM log_info ORDER BY DATE ASC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $teamOneScore = $row['TeamOneScore'];
            $teamTwoScore =  $row['TeamTwoScore'];
          
            $location = $row['LOCATION'];
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $date . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . ' VS '.$teamTwo.'</td>
                <td scope="row" class="text-center align-middle"> '.$location.' </td>
                <td class="text-center align-middle">
                      
                        <button class = "btn  btn-primary" onclick = "ViewDetails('.$id.')">VIEW DETAILS</button>
                </td>
            </tr>';
    
            $number++;
    
    
        }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }
    
    // Ajax for displaying the EventList table and search DESC
    if (isset($_POST['displayEventListDESC']) && $_POST['displayEventListDESC'] == true) {
        // Check if searchValue is set and not empty
        $value = isset($_POST['searchValue']) ? $_POST['searchValue'] : NULL;
    
        echo '<div style="max-height: 400px; max-width: 1113px; font-size: 11px; position: relative; left: 122px; top: 90px; overflow-y: auto; " class="table">';
        $table = '<table class="table table-bordered table-hover">
                <thead class="table-dark" id="table-header" style="position: sticky; top: 0; background-color: #343a40; color: white;">
                <tr> 
                <th scope="col" class="text-center align-middle">Event No.</th>
                <th scope="col" class="text-center align-middle" onclick = "ASC()">Date</th>
                <th scope="col" class="text-center align-middle">Match</th>
                <th scope="col" class="text-center align-middle">Location</th>
                <th scope="col" class="text-center align-middle">Action</th>
                </tr>
                </thead>
                <tbody>';
    
        if (!empty($value)) {        
            $sql = "SELECT * FROM log_info WHERE DATE = '$value' ORDER BY DATE DESC";
        } else {
            $sql = "SELECT * FROM log_info ORDER BY DATE DESC";
        }
    
        $result = mysqli_query($conn, $sql);
        $number = 1;
    
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $teamOne = $row['TEAMONE'];
            $teamTwo = $row['TEAMTWO'];
            $date = $row['DATE'];
            $teamOneScore = $row['TeamOneScore'];
            $teamTwoScore =  $row['TeamTwoScore'];
          
            $location = $row['LOCATION'];
          
    
            $table .= '<tr>
                <td scope="row" class="text-center align-middle">' . $number . '</td>
                <td scope="row" class="text-center align-middle">' . $date . '</td>
                <td scope="row" class="text-center align-middle">' . $teamOne . ' VS '.$teamTwo.'</td>
                <td scope="row" class="text-center align-middle"> '.$location.' </td>
                <td class="text-center align-middle">
                       
                        <button class = "btn  btn-primary" onclick = "ViewDetails('.$id.')">VIEW DETAILS</button>
                </td>
            </tr>';
    
            $number++;
    
    
        }
    
        $table .= '</tbody></table>';
        echo $table;
        echo '</div>';
    }








     //ajax for showing the details from sa databse para ma hibaw and mga details  and sa show details sa event list
     if(isset($_POST['details_id'])){
        $user_id = $_POST['details_id'];

        $sql = "SELECT * FROM log_info WHERE id = $user_id";
        $result = mysqli_query($conn,$sql);
        $response = array();

        while($row = mysqli_fetch_assoc($result)){
            $response = $row;
        }

        echo json_encode($response);
    }else{
        $response['status'] =   200;
        $response['message'] = "Invalid or Data Information!";
    }
    
    





   









   



    

    ?>
