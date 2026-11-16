<?php
declare(strict_types=1);

use Ksfraser\FrontAccounting\CRM\Dashboard\Controller\DashboardTabController;

$path_to_root = '../..';

require_once($path_to_root . '/includes/session.inc');

if (!function_exists('page_security')) {
    define('page_security', 'SA_DASHBOARD_MANAGE');
}

$controller = new DashboardTabController(null, array());
$controller->renderForm();
