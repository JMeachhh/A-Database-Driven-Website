<html>
    <body>
        <?php
            require_once("connection.php");

            $query = "SELECT COUNT(DISTINCT owner_id) AS 'owner_no' FROM dogs WHERE id IN (SELECT DISTINCT dog_id FROM entries)";
            $result = mysqli_query($conn, $query);
            $x = mysqli_fetch_assoc($result)['owner_no'];

            $query = "SELECT COUNT(DISTINCT dog_id) AS 'dogs_no' FROM entries WHERE 1";
            $result = mysqli_query($conn, $query);
            $y = mysqli_fetch_assoc($result)['dogs_no'];

            $query = "SELECT COUNT(DISTINCT event_id) AS 'events_no' FROM competitions WHERE 1";
            $result = mysqli_query($conn, $query);
            $z = mysqli_fetch_assoc($result)['events_no'];

            $query = "SELECT d.id,o.id AS owner_id, o.name AS owner_name, o.email AS owner_email, b.name AS breed, d.name AS dog_name, AVG(e.score) AS avg FROM dogs d INNER JOIN entries e ON d.id = e.dog_id INNER JOIN breeds b ON d.breed_id = b.id INNER JOIN owners o ON d.owner_id = o.id GROUP BY d.id HAVING COUNT(e.dog_id) > 1 ORDER BY avg DESC LIMIT 10";
            $result = mysqli_query($conn, $query);

        ?>
        <h1>
            <?php
                echo "Welcome to Poppleton Dog Show! This year $x owners entered $y dogs in $z events!"
            ?>
        <?php
            echo "
            <br>
            THE TOP 10 DOGS ARE
            <table border = '1'>
                <th>Name</th>
                <th>Breed</th>
                <th>Average Score</th>
                <th>Owner Name</th>
                <th>Owner Email Address</th>";
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<tr>";
                    echo "<td>".$row["dog_name"]."</td>";
                    echo "<td>".$row["breed"]."</td>";
                    echo "<td>".$row["avg"]."</td>";
                    echo "<td><a href= owner_details.php?id=". $row["owner_id"] .">".$row["owner_name"]."</a></td>";
                    echo "<td><a href='mailto:".$row["owner_email"]."'>".$row["owner_email"]."</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
        ?>
    </body>
</html>