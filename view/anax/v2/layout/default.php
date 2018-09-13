<?php

namespace Anax\View;

/**
 * A layout rendering views in defined regions.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$title = ($title ?? "No title") . ($baseTitle ?? " | No base title defined");

?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

<?php if (isset($favicon)) : ?>
    <link rel="icon" href="<?= $favicon ?>">
<?php endif; ?>

<?php if (isset($stylesheets)) : ?>
    <?php foreach ($stylesheets as $stylesheet) : ?>
        <link rel="stylesheet" type="text/css" href="<?= asset($stylesheet) ?>">
    <?php endforeach; ?>
<?php endif; ?>

</head>
<body>

<!-- header -->
<?php if (regionHasContent("header")) : ?>
    <?php renderRegion("header") ?>
<?php endif; ?>

<!-- navbar -->
<?php if (regionHasContent("navbar")) : ?>
    <?php renderRegion("navbar") ?>
<?php endif; ?>

<!-- main -->
<?php if (regionHasContent("main")) : ?>
<main class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="main-wrapper bg-secondary">
                <?php renderRegion("main") ?>
            </div>
        </div>
    </div>
</main>
<?php endif; ?>

<!-- footer -->
<?php if (regionHasContent("footer")) : ?>
    <?php renderRegion("footer") ?>
<?php endif; ?>

<?php if (isset($stylesheets)) : ?>
    <?php foreach ($javascripts as $javascript) : ?>
    <script src="<?= asset($javascript) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
