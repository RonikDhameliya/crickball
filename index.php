<?php
    include 'connection.php';
    $sql = "SELECT * FROM `current_teams` ORDER BY id DESC LIMIT 1";
    $qry = mysqli_query($con,$sql)or die('query not performed');
    $row=mysqli_fetch_array($qry);
    $sum = $row[3] + $row[4] ;
    $t1 =ceil(($row[3]*100)/$sum).'%';
    $t2 =ceil(($row[4]*100)/$sum).'%';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .team {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .team img {
            width: 90px;
            height: 90px;
            margin-right: 15px;
            border-radius: 50%;
        }

        .team label {
            font-weight: bold;
        }

        .vote-button {
            padding: 10px 20px;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition:0.5s ease;
        }
       
  
        input[type='radio']
        {
            margin-left: 15px;
        }
        .vote-button:hover {
            background-color:#223577;
        }
    </style>
</head>
<body>
    <?php  include 'navbar.html'; ?> 
    

<form method="post">
<div class="container">
    <h1>Vote for Your Favorite Team</h1>

    <div class="team">
        <img src=<?php echo "img/$row[1]/$row[1]outline.png";?> alt="Team 1">
        <label for="team1"><?php echo $row[1]; ?></label>
        <input type="radio" id="team1" name="team" value="team1">
    </div>

    <div class="team">
        <img src=<?php echo "img/$row[2]/$row[2]outline.png";?> alt="Team 2">
        <label for="team2"><?php echo $row[2]; ?></label>
        <input type="radio" id="team2" name="team" value="team2">
    </div>

    <input type="submit"  id="sub" value="vote" name="submit" class="vote-button">
    
</div>
</form>

<?php
     if(isset($_POST['submit']))
     {
        $vote_t1=$row[3];
        $vote_t2=$row[4];
        if($_POST['team'])
        {
            if($_POST['team']=='team1')
            {
                 $vote_t1 = $row[3] + 1;
            }
            else if($_POST['team']=='team2')
             {
                $vote_t2 = $row[4] + 1;
             }
             $sql1 = "UPDATE `current_teams` SET `vote_t1` = ' $vote_t1', `vote_t2` = ' $vote_t2' WHERE `current_teams`.`id` = $row[0];";
            $qry1 = mysqli_query($con,$sql1)or die('query not performed');
           
        }
        else
        {
            
        }
        //  if ($team1 && $team2) {
         
        //  }
     }
     ?>
 
</body>
</html>