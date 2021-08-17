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
                        <?php if ($post && $_REQUEST['product'] === 'продукт'): ?>
                            <p class='warning mb-1'>выберите продукт</p>
                        <?php endif; ?>

                        <select class="form-select mb-3" aria-label="Default select example" name="product">
                            <?php $select = ($_REQUEST['product'] === null) || ($_REQUEST['product'] === 'продукт') ? 'selected' : ''?>
                            <option <?=$select?> >продукт</option>
                            <?php foreach($keyArr as $key => $value): ?>
                                <?php $ch = (string) $key === $_REQUEST['product'] ? 'selected' : ''?>
                                <option <?=$ch?> value="<?=$key?>"><?=$value?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if ($post && $_REQUEST['month'] === 'месяц'): ?>
                            <p class='warning mb-1'>выберите месяц</p>
                        <?php endif; ?>

                        <select class="form-select mb-3" aria-label="Default select example" name="month">
                            <?php $select = ($_REQUEST['month'] === null) || ($_REQUEST['month'] === 'месяц') ? 'selected' : ''?>
                            <option <?=$select?> >месяц</option>
                            <?php foreach($arrMonth as $key => $value): ?>
                                <?php $ch = (string) $key === $_REQUEST['month'] ? 'selected' : ''?>
                                <option <?=$ch?> value="<?=$key?>"><?=$value?></option>
                            <?php endforeach; ?>
                        </select>

                        <?php if ($post && $_REQUEST['tonnage'] === 'тоннаж'): ?>
                            <p class='warning mb-1'>выберите тоннаж</p>
                        <?php endif; ?>

                        <select class="form-select mb-3" aria-label="Default select example" name="tonnage">
                            <?php $select = ($_REQUEST['tonnage'] === null) || ($_REQUEST['tonnage'] === 'тоннаж') ? 'selected' : ''?>
                            <option <?=$select?> >тоннаж</option>
                            <?php foreach($keyTonnage as $key => $value): ?>
                                <?php $ch = (string) $key === $_REQUEST['tonnage'] ? 'selected' : ''?>
                                <option <?=$ch?> value="<?=$key?>"><?=$value?></option>
                            <?php endforeach; ?>
                        </select>

                        <div class="main__button d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary w-50 me-2">Рассчитать</button>
                            <a href="index.php" class="btn btn-secondary"">Сбросить</a>
                        </div>
                    </form>
                </div>
                <div class="main__table mt-5 mt-lg-0">
                    <?php
                    $isParameters = isset($productIndex, $monthIndex, $tonnageIndex);
                    if ($post && $isParameters): ?>
                        <p>Цена: <?=$arr[$keyArr[$productIndex]][$keyTonnage[$tonnageIndex]][$monthIndex]?></p>
                        <p class='product'><?=$keyArr[$productIndex]?></p>
                        <table>
                            <tr><td>мес/тон</td>
                                <?php foreach ($arrMonth as $value): ?>
                                    <td><?=$value?></td>
                                <?php endforeach; ?>
                            </tr>
                            <?php foreach ($arr[$keyArr[$productIndex]] as $key => $value): ?>
                                <tr><td><?=$key?></td>
                                    <?php foreach ($value as $val): ?>
                                        <td><?=$val?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php elseif ($post && !$isParameters): ?>
                        <p>Укажите верные параметры!</p>
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