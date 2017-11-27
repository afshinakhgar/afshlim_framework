<?php
session_start();
include __APP_ROOT__.'bootstrap/app.php';
use Tracy\Debugger;
Debugger::enable(Debugger::DEVELOPMENT, $settings['tracy']['path']);
