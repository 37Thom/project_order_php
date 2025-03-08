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




?>