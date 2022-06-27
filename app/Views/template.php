<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?=$title_tab ?></title>
    <meta name="description" content="Visualisation Van Hool Hal5 & Hal6">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="<?= base_url()?>/images/logo_VanHool.png" >

    <!-- CSS !-->
    <link href= <?= base_url()?>/css/template.scss rel="stylesheet"/>
    <?php if (isset($styles_to_load)) foreach($styles_to_load as $style): ?>
        <link href= <?= base_url()?>/css/<?=$style?> rel="stylesheet"/>
    <?php endforeach; ?>

    <!-- JS !-->
    <script src='<?= base_url()?>/js/template.js' defer></script>
    <?php if (isset($scripts_to_load)) foreach($scripts_to_load as $script): ?>
        <script src="<?= base_url()?>/js/<?=$script?>" defer></script>
    <?php endforeach; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script > let BASE_URL = "<?=base_url();?>";</script>

</head>

<body>
<header>
    <div class="menu">
        <ul>
            <li class="logo">
                <a href="<?= base_url()?>/home/map_view">
                    <img id="logo" class="site-logo" src="<?= base_url()?>/images/logo_VanHool.png" alt="...">
                </a>
            </li>
            <li class="menu-toggle">
                <button onclick="toggleMenu();">&#9776;</button>
            </li>

            <?php foreach ($burger_menu as $menu): ?>
                <li class="menu-item">
                    <a href="<?=$menu['link']?>" title="<?= $menu['title'] ?>" class="<?=$menu['className']?> link"> <?= $menu['name'] ?></a>
                </li>
            <?php endforeach;?>

        </ul>
    </div>
</header>

<div class="content_div">
    <?php if (isset($content)): ?>
        <?=$content ?>
    <?php endif; ?>
</div>

</body>
</html>
