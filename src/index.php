<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Using Heroku Postgres DB locally in PHP</title>

    <link rel="icon" href="https://jitendrazaa.com/favicon.ico" type="image/x-icon" />
     
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    
</head>
<body class="container">
    
    <div class="page-header"> 
            <div class="text-center"> 
                  <h1>Heroku Postgres Database<small> <br/> Use it locally in PHP</small></h1>
            </div> 
       </div>    

    <div class="well">
        <h3>Prerequisite</h3>
        <ul>
            <li>Local server must be SSL enabled</li>
        </ul>
    </div> 

    <?
        /*
            Sample Database String from Heroku
            'postgres://wvvgxgeoriumxg:c4e8612ae286a211a8c94976df0811e9b6fcdacb3ef3e468401e0619b38a1004@ec2-107-22-168-211.compute-1.amazonaws.com:5432/d5siauekbh9qlu' 
            */

            $dbconn = pg_connect("host=ec2-107-22-168-211.compute-1.amazonaws.com port=5432 dbname=d5siauekbh9qlu user=wvvgxgeoriumxg password=c4e8612ae286a211a8c94976df0811e9b6fcdacb3ef3e468401e0619b38a1004");

            $fName = pg_escape_string($_POST['firstName']);
            $lName = pg_escape_string($_POST['lastName']);
            
            if(!empty( $fName ) && !empty( $lName )){ 

                $sql = "INSERT into Person (firstName,lastName) values ('".$fName."', '".$lName."')" ;
                pg_query($dbconn, $sql); 
    ?> 
            <div class="alert alert-success" role="alert">
                Record Inserted Succesfully in Heroku Postgres Database !!!
            </div> 
            <?
                //close sql if statement bracket
                }
            ?>
     
     <div class="row">
         <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
             
            <form method="post">
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input required="true" type="tetxt" class="form-control" name="firstName" id="firstName" placeholder="First Name">
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input  required="true" type="tetxt" class="form-control" name="lastName" id="lastName" placeholder="Last Name">
                </div>
                 
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

         </div>
         <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
                <tbody> 
                        <?   
                            
                            /*
                            Use below code to create table and insert some sample records if using first time
                            $sql = "drop table Person;";
                            pg_query($dbconn, $sql);
                            
                            $sql = "create table Person (id SERIAL PRIMARY KEY, firstName varchar(15), lastName varchar(15) );";
                            pg_query($dbconn, $sql);
                            

                            $sql = "INSERT into Person (firstName,lastName) values ('Rudra', 'Zaa')" ;
                            pg_query($dbconn, $sql);

                            $sql = "INSERT into Person (firstName,lastName) values ('Shivanya', 'Zaa')" ;
                            pg_query($dbconn, $sql);

                            $sql = "INSERT into Person (firstName,lastName) values ('Minal', 'Zaa')" ;
                            pg_query($dbconn, $sql);
                            */ 

                            $sql = "select * from Person";

                            $resultset = pg_query($dbconn, $sql);
                            while($row = pg_fetch_array($resultset)) {
                                echo '<tr>
                                        <td>'.$row[0].'</td>
                                        <td>'.$row[1].'</td>
                                        <td>'.$row[2].'</td>
                                    </tr>'; 
                            }

                            pg_close($dbconn);
                        ?> 
              </tbody>
            </table>
            </div>
        </div>
    </body>
</html>
