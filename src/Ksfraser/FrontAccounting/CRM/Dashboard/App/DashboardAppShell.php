<?php

declare(strict_types=1);

namespace Ksfraser\FrontAccounting\CRM\Dashboard\App;

use ksfraser\FrontAccounting\Common\App\AbstractAppShell;
use ksfraser\FrontAccounting\Common\App\TabRegistration;

class DashboardAppShell extends AbstractAppShell
{
    public function __construct()
    {
        parent::__construct('dashboard', 'index.php', 'view', 'dashboard_widgets');

        $this->registerTab(new TabRegistration(
            'dashboard_widgets',
            'Dashboards',
            'SA_DASHBOARD_VIEW',
            null,
            10,
            0,
            null,
            null,
            array()
        ));
    }
}
