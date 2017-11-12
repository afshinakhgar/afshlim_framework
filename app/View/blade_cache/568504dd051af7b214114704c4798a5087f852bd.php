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




<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
</body>
</html>