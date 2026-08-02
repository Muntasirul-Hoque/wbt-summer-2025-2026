<!DOCTYPE html>
<html lang="en"S>
<head>
    <title>Student Cafeteria Billing System</title>
</head>
<body>
    <?php
        $name = "Alvi";
        $id = "23-53907-3";
        
        $item = 1;
        $quantity = 6;

        switch ($item) {
            case 1:
                $itemName = "Burger";
                $price = 5;
                break;
            case 2:
                $itemName = "Pizza";
                $price = 8;
                break;
            case 3:
                $itemName = "Sandwich";
                $price = 4;
                break;
            case 4: 
                $itemName = "Coffee";
                $price = 3;
                break;
            default:
                $itemName = "Unknown Item";
                $price = 0;
        }

        $subtotal = $price * $quantity;

        if($subtotal >= 30){
            $discountPercent = 20;
        }
        else if($subtotal >= 20){
            $discountPercent = 10;
        }
        else{
            $discountPercent = 0;
        }

        $discountAmount = ($discountPercent / 100) * $subtotal;
        $total = $subtotal - $discountAmount;
        
        echo "================================<br>";
        echo "<p>UNIVERSITY CAFETERIA</p>";
        echo "================================<br><br>";

        echo "Student Name : " . $name . "<br>";
        echo "Student ID : " . $id . "<br><br>";
        echo "Food Item : " . $itemName . "<br>";
        echo "Price : $" . $price . "<br>";
        echo "Quantity : " . $quantity . "<br><br>";

        echo "Ordered Items:<br>";

        for($i = 1; $i <= $quantity; $i++)
        {
            echo "Item " . $i . ": " . $itemName . "<br>";
        }

        echo "<br>";
        echo "Subtotal : $" . $subtotal . "<br>";
        echo "Discount : " . $discountPercent . "%<br>";
        echo "Discount Amount : $" . $discountAmount . "<br>";
        echo "Final Bill : $" . $total . "<br><br>";

        echo "Thank you for visiting!<br>";
        echo "================================";

    ?>
</body>
</html>