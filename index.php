<?php
include "dbFuncs.php";


$func = new dbFuncs();

if ($func->checkDB(DB_NAME)) $func->createDB();

if ($func->checkTable($tableGoods)) {
    $func->createTableGoodsList($tableGoods);
}

$goods[0] = new Product('ZA', 2.0, '7 for 4');
$goods[1] = new Product('YB', 12.0, '');
$goods[2] = new Product('FC', 1.25, '6 for 6');
$goods[3] = new Product('GD', 0.15, '');

// Filling in the table with Product List
if ($func->checkFillingTable($tableGoods)) {
    $goods_number = count($goods);
    print ($goods_number);
    for ($i = 0; $i < $goods_number; $i++) {
        $func->fillInTableGoods($goods[$i]->getCode(), $goods[$i]->getPrice(), $goods[$i]->getOffer(), $tableGoods);
    }
}

if ($func->checkTable($tableCart)) $func->createTableShoppingCart($tableCart);

if (isset($_GET['code'])) {
    $code = $func->test_input($_GET['code']);

    $func->addToCart($code, $tableCart);
}

?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <style>
        table {
            font-size: 18px;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #424242;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .thead {
            background-color: black;
            color: white;
        }

        .link {
            color: black;
            text-decoration: none;
            font-weight: bold;
        }

        .link:hover {
            text-decoration: underline;
            color: #0D25A7;
        }
    </style>
</head>
<body>
<form action="cart.php" method="post">
    <h2 style="float: left;">List of products</h2>
    <input type="image" src="img/shopping-cart1.png" style="float: right; width: 70px; height: 70px;">

    <table>
        <tr>
            <th class="thead">Product code</th>
            <th class="thead">Price</th>
            <th class="thead">Action</th>
        </tr>
        <?php
        $goods = $func->getGoods($tableGoods);
        foreach ($goods as $product) {
            echo '<tr><td>' . $product['code'] . '</td>' . '<td>£' . $product['price'];
            if (!empty($product['special_offer'])) {
                echo ' £' . $product['special_offer'] . ' pieces</td>';
            }
            echo '<td><a href="?code=' . $product['code'] . '" class="link">Add to the shopping cart</a></td></tr>';
        }
        ?>
    </table>
</form>
</body>
</html>
