<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Template</title>
    <meta name="description" content="Main visualisation Van Hool">
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
            <li class="menu-item hidden">
                <a href="<?= base_url()?>/home/map_view">Map View</a>
            </li>
            <li class="menu-item hidden">
                <a href="<?= base_url()?>/home/chassis_view">Chassis View</a>
            </li>
            <li class="menu-item hidden">
                <a href="<?= base_url()?>/home/analyze_view">Analyze View</a>
            </li>
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
