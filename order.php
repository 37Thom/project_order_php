<?php

//připojení k databázi
require "database.php";

$numOrder = $_POST["numOrder"] ?? "";
$currencyProduct = null;
$subTotalOrder = null;
$totalPriceOrder = null;

?>


<form action="index.php" method="post">
    <input 
        type="text" 
        name="numOrder" 
        placeholder="Zadejte číslo objednávky" 
        value="<?= htmlspecialchars($numOrder) ?>">
    <input 
        type="submit" 
        name="submit" 
        value="Hledací tlačítko">
</form>


<?php

//vložení čísla objednávky do proměnné + test jestli není prázné a je číslo
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    

    if(is_numeric($_POST["numOrder"])){

        //dotaz na db
        $sql = "SELECT  order_done.id, 
                        order_done.date, 
                        order_done.status,
                        product.name,
                        product.price,
                        product.currency,
                        order_product.quantity
                FROM order_done
                JOIN order_product 
                    ON order_done.id = order_product.order_done_id
                JOIN product 
                    ON order_product.product_id = product.id
                WHERE order_done.id = $numOrder; ";

        //vložení dat
        $data = mysqli_query($connection, $sql);
        $result = mysqli_fetch_all($data, MYSQLI_ASSOC);
        //var_dump($result);



        //Zastavení kódu při neexistující objednávce
        if(!$result){
            die("Nenalezená objednávka");
        };



        //výpis dat
        echo "<br />";
        echo 'Číslo objednávky: '.$result[0]["id"];
        echo "<br />";
        echo 'Datum objednání: '.$result[0]["date"];
        echo "<br />";
        echo 'Stav objednávky: '.$result[0]["status"];
        echo "<br />";

        echo "<table border='1' cellpadding='5' cellspacing='0'>
                <tr>
                    <th>Produkt</th>
                    <th>Cena</th>
                    <th>Množství</th>
                    <th>Mezisoučet</th>
                </tr>";

        foreach ($result as $oneProductOfOrder) {
            $subTotalOrder = $oneProductOfOrder["quantity"] * $oneProductOfOrder["price"];
            $totalPriceOrder += $subTotalOrder;
            $currencyProduct = $oneProductOfOrder["currency"];

            echo "<tr>
                    <td>{$oneProductOfOrder['name']}</td>
                    <td>{$oneProductOfOrder['price']} {$currencyProduct}</td>
                    <td>{$oneProductOfOrder['quantity']}</td>
                    <td>{$subTotalOrder} {$currencyProduct}</td>
                </tr>";
        }

        echo "</table>";
        echo "<h3>Celková částka objednávky: {$totalPriceOrder} {$currencyProduct}</h3>";
    }else{
        
        echo "Zadejte prosím číslo Vaší objednávky";
    }
};



/* verze $stmt

//dotaz na db
    $stmt = $connection->prepare(
                    "SELECT  order_done.id, 
                            order_done.date, 
                            order_done.status,
                            product.name,
                            product.price,
                            product.currency,
                            order_product.quantity
                    FROM order_done
                    JOIN order_product 
                        ON order_done.id = order_product.order_done_id
                    JOIN product 
                        ON order_product.product_id = product.id
                    WHERE order_done.id = ? ");

//vložení dat
    $stmt->bind_param("i" , $numOrder); 
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);      

*/

?>