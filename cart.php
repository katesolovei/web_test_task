<?php
include "dbFuncs.php";

$func = new dbFuncs();

// Choising the number of products for delete
if (isset($_GET['code']) && isset($_GET['mode'])) {
    $code = $func->test_input($_GET['code']);
    $mode = $func->test_input($_GET['mode']);
    switch ($mode) {
        case 'one':
            $func->deleteOneProduct($code, $tableCart);
            break;
        case 'all':
            $func->deleteAllProducts($code, $tableCart);
            break;
    }
}

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<form action="index.php" method="post">
    <h2 style="float: left;">Shopping Cart</h2>
    <input type="image" src="img/back.png" style="float: right; width: 60px; height: 60px;">

    <table>
        <tr>
            <th class="thead">Product code</th>
            <th class="thead">Number</th>
            <th class="thead">Price</th>
            <th class="thead">Action</th>
        </tr>
        <?php
        $func = new dbFuncs();
        $goods = $func->getGoods($tableCart);
        foreach ($goods as $product) {
            echo '<tr><td>' . $product['code'] . '</td>' . '<td>' . $product['numb'] . '</td>';
            echo '<td>£' . $product['price'] . '</td>';
            echo '<td style="width: 10%;"><a href="?code=' . $product['code'] . '&mode=one" class="link">Delete one</a>
                      <a href="?code=' . $product['code'] . '&mode=all" class="link">Delete all</a></td></tr>';
        }
        ?>
        <tr>
            <td colspan="2"><b>Total summ</b></td>
            <td><b>£<?php (!$func->getTotalSum($tableCart)) ? print(0) : print($func->getTotalSum($tableCart)); ?></b></td>
        </tr>
    </table>
</form>
</body>
</html>
