<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title><?php echo $title ?? 'Cobranza'; ?></title>
    <link rel="stylesheet" href="<?php echo View::asset('css/global.css'); ?>">
    <link rel="stylesheet" href="<?php echo View::asset('css/layout.css'); ?>">
    <link rel="stylesheet" href="<?php echo View::asset('css/components.css'); ?>">
    <?php if (!empty($styles)):
    foreach ($styles as $style): ?>
    <link rel="stylesheet" href="<?php echo View::asset($style); ?>">
    <?php endforeach; endif; ?>
</head>
<body>
<?php View::partial('layout/header'); ?>
<?php echo $content; ?>
<?php View::partial('layout/footer', ['scripts' => $scripts ?? []]); ?>
</body>
</html>
