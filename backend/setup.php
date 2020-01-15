<!DOCTYPE html>
<html>
    <head>
        <meta charset = "UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Setting up...</h1>
        <?php
        require_once './functions.php';
        
        //setup table User
        createTable("User", "uId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(50),
                    password VARCHAR(50),
                    status CHAR(1),
                    INDEX(username(10))");
        echo "<br>";
        //setup table Batch
        createTable("Batch", "bId INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                bName VARCHAR(50),
                bDescription VARCHAR(200),
                lastModifiedBy INT UNSIGNED,
                FOREIGN KEY (lastModifiedBy) REFERENCES User(uId),
                INDEX (bName(7))");
        echo "<br>";
        //setup table Student
        createTable("Student", "sId VARCHAR(8) PRIMARY KEY,"
                . "sName VARCHAR(50),"
                . "sDoB DATE,"
                . "sEmail VARCHAR(50),"
                . "sPhone VARCHAR(15),"
                . "sGender CHAR(1),"
                . "sAddress VARCHAR(200),"
                . "sImage VARCHAR(200),"
                . "sBatch INT UNSIGNED,"
                . "FOREIGN KEY (sBatch) REFERENCES Batch(bId),"
                . "INDEX(sName(10)),"
                . "INDEX(sBatch)");
        echo "<br>";
        //Setting up one default user
        $username = "admin";
        $password = "pass";
        $status = '1';
        if (addUser($username, $password, $status)) {
            echo "Added user $username, please change the password";
        } else {
            echo "User already exists";
        }
        $username = "admin2";
        $password = "pass2";
        $status = '1';
        if (addUser($username, $password, $status)) {
            echo "Added user $username, please change the password";
        } else {
            echo "User already exists";
        }
        ?>
        <h1>...done!</h1>       
    </body>
</html>