<?php
/**
 * @var array $keyArrProduct
 * @var string $products
 * @var View $this
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.min.css">
    <title>Calculator</title>
</head>
<body>
<div class="wrap__product">
    <div class="container">
        <div class="pt-5 pb-5 d-flex flex-column">
            <p class="fs-3 mb-3"><?=$products?></p>
            <?php foreach ($keyArrProduct as $key => $value): ?>
                <p class="fs-4 mb-2"><?=$key + 1 . '. ' . $value?></p>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script src="javascript/bootstrap.bundle.min.js"></script>
<script src="javascript/script.min.js"></script>
</body>
</html>