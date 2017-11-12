<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo e(isset($title) ? $title : ''); ?></title>
    <style>
        h1 {
            border:1px solid;
        }
    </style>
</head>
<body>

<?php echo $__env->yieldContent('content'); ?>

</body>
</html>