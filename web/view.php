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
<div class="wrap">
    <div class="container pt-5 pb-5 d-flex flex-column">
        <main class="main d-flex flex-column justify-content-between">
            <div class="main__title text-center">
                <p class="fs-3 text-uppercase lh-base">Калькулятор начальной стоимости предложения</p>
            </div>
            <div class="main__body d-lg-flex justify-content-between">
                <div class="main__form me-3 col-12 col-sm-8 col-lg-4">
                    <form action="<?=$_SERVER['$REQUEST_NAME']?>" method="post" name="form" class="d-flex flex-column justify-content-between h-100">
                        <?php if ($_POST['product'] === ''): ?>
                            <p class='warning mb-1'>выберите продукт</p>
                        <?php endif; ?>

                        <select class="form-select mb-3" aria-label="Default select example" name="product">
                            <?php $select = ($_POST['product'] === null) || ($_POST['product'] === '') ? 'selected' : ''?>
                            <option <?=$select?> value="">продукт</option>
                            <?php foreach($keyArrProduct as $key => $value): ?>
                                <option <?=(string) $key === $_POST['product'] ? 'selected' : ''?> value="<?=$key?>"><?=$value?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if ($_POST['month'] === ''): ?>
                            <p class='warning mb-1'>выберите месяц</p>
                        <?php endif; ?>

                        <select class="form-select mb-3" aria-label="Default select example" name="month">
                            <?php $select = ($_POST['month'] === null) || ($_POST['month'] === '') ? 'selected' : ''?>
                            <option <?=$select?> value="">месяц</option>
                            <?php foreach($arrMonth as $key => $value): ?>
                                <option <?=(string) $key === $_POST['month'] ? 'selected' : ''?> value="<?=$key?>"><?=$value?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if ($_POST['tonnage'] === ''): ?>
                            <p class='warning mb-1'>выберите тоннаж</p>
                        <?php endif; ?>

                        <select class="form-select mb-3" aria-label="Default select example" name="tonnage">
                            <?php $select = ($_POST['tonnage'] === null) || ($_POST['tonnage'] === '') ? 'selected' : ''?>
                            <option <?=$select?> value="">тоннаж</option>
                            <?php foreach($keyTonnage as $key => $value): ?>
                                <option <?=(string) $key === $_POST['tonnage'] ? 'selected' : ''?> value="<?=$key?>"><?=$value?></option>
                            <?php endforeach; ?>
                        </select>

                        <div class="main__button d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-50 me-2">Рассчитать</button>
                            <a href="index.php" class="btn btn-secondary"">Сбросить</a>
                        </div>
                    </form>
                </div>
                <div class="main__table mt-5 mt-lg-0">
                    <?php if ($_SERVER['REQUEST_METHOD'] === "POST"): ?>
                        <?php if (isset($productIndex, $monthIndex, $tonnageIndex)): ?>
                            <p>Цена: <?=$arrProduct[$keyArrProduct[$productIndex]][$keyTonnage[$tonnageIndex]][$monthIndex]?></p>
                            <p class='product'><?=$keyArrProduct[$productIndex]?></p>
                            <table>
                                <tr><td>мес/тон</td>
                                    <?php foreach ($arrMonth as $value): ?>
                                        <td><?=$value?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php foreach ($arrProduct[$keyArrProduct[$productIndex]] as $key => $value): ?>
                                    <tr><td><?=$key?></td>
                                        <?php foreach ($value as $val): ?>
                                            <td><?=$val?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        <?php else: ?>
                            <p>Укажите верные параметры!</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="javascript/bootstrap.bundle.min.js"></script>
<script src="javascript/script.min.js"></script>
</body>
</html>