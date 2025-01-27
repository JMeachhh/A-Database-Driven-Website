<html>
    <body>
        <?php
            require_once('connection.php');
            $owner_id =  isset($_GET['id']) ? $_GET['id'] : "null";
            $query = "SELECT * FROM owners WHERE id = $owner_id";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)){
                $name = $row['name'];
                $address = $row['address'];
                $email = $row['email'];
                $phone = $row['phone'];
            }
        ?>
    <h1>
        <?php echo $name ?>
    </h1>
        <?php
            echo "Address : $address <br>";
            echo "Email : $email <br>";
            echo "Phone Number : $phone <br>";
        ?>
    </body>
</html>
