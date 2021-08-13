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
    <?php
        require_once('../table.php');
        require_once ('../func.php');

        $keyArr = array_keys($arr);

        $product = $_REQUEST['product'];
        if ($product !== null) {
            $productIndex = getKeyNumber($product, $keyArr);
        }

        $month = $_REQUEST['month'];
        if ($month !== null) {
            $monthIndex = getKeyNumber($month, $arrMonth);
        }

        $keyTonnage = array_keys($arr[$keyArr[0]]);
        $tonnage = $_REQUEST['tonnage'];
        if ($tonnage !== null) {
            $tonnageIndex = getKeyNumber($tonnage, $keyTonnage);
        }
    ?>
    <div class="wrap">
        <div class="container pt-5 pb-5 d-flex flex-column">
            <main class="main d-flex flex-column justify-content-between">
                <div class="main__title text-center">
                    <p class="fs-3 text-uppercase lh-base">Калькулятор начальной стоимости предложения</p>
                </div>
                <div class="main__body d-lg-flex justify-content-between">
                    <div class="main__form me-3 col-12 col-sm-8 col-lg-4">
                        <form action="<?=$_SERVER['$REQUEST_NAME']?>" method="post" name="form" class="d-flex flex-column justify-content-between h-100">
                            <?php
                                warning('продукт', $_REQUEST['product']);
                            ?>
                            <select class="form-select mb-3" aria-label="Default select example" name="product">
                                <?php
                                    echo option($keyArr, 'продукт', $_REQUEST['product']);
                                ?>
                            </select>
                            <?php
                                warning('месяц', $_REQUEST['month']);
                            ?>
                            <select class="form-select mb-3" aria-label="Default select example" name="month">
                                <?php
                                    echo option($arrMonth, 'месяц', $_REQUEST['month'])
                                ?>
                            </select>
                            <?php
                                warning('тоннаж', $_REQUEST['tonnage']);
                            ?>
                            <select class="form-select mb-3" aria-label="Default select example" name="tonnage">
                                <?php
                                    $keyTonnage = array_keys($arr[$keyArr[0]]);
                                    echo option($keyTonnage, 'тоннаж', $_REQUEST['tonnage']);
                                ?>
                            </select>
                            <div class="main__button d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary w-50 me-2">Рассчитать</button>
                                <a href="index.php" class="btn btn-secondary"">Сбросить</a>
                            </div>
                        </form>
                    </div>
                    <div class="main__table mt-5 mt-lg-0">
                        <?php
                            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                                if ($productIndex !== null && $monthIndex !== null && $tonnageIndex !== null ) {
                                    echo "<p>Цена: {$arr[$keyArr[$productIndex]][$keyTonnage[$tonnageIndex]][$monthIndex]} </p>";
                                    $str = tableOutput($arr, $keyArr[$productIndex], $arrMonth);
                                    echo $str;
                                } else {
                                    echo "<p>Укажите верные параметры!</p>";
                                }
                            }
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <script src="javascript/bootstrap.bundle.min.js"></script>
    <script src="javascript/script.min.js"></script>
</body>
</html>