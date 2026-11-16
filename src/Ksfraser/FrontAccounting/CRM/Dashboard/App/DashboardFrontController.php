<?php

declare(strict_types=1);

namespace Ksfraser\FrontAccounting\CRM\Dashboard\App;

use ksfraser\FrontAccounting\Common\App\AbstractFrontController;

class DashboardFrontController extends AbstractFrontController
{
    public function __construct(
        DashboardAppShell $appShell,
        string $fallbackSecurityArea,
        string $path_to_root
    ) {
        parent::__construct($appShell, $fallbackSecurityArea, $path_to_root);
    }
}
