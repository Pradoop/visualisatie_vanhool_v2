<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Van Hool IV</title>
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

<!-- Enable tooltips !-->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>
<!-- Enable popovers !-->
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>

</body>
</html>
