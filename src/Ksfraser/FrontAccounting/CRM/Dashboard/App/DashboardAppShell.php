<?php

declare(strict_types=1);

namespace Ksfraser\FrontAccounting\CRM\Dashboard\App;

use ksfraser\FrontAccounting\Common\App\AbstractAppShell;
use ksfraser\FrontAccounting\Common\Menu\FAModuleMenu;
use Ksfraser\FrontAccounting\CRM\Dashboard\Controller\DashboardTabController;

class DashboardAppShell extends AbstractAppShell
{
    public function __construct()
    {
        parent::__construct('dashboard', 'index.php', 'view', 'dashboard_widgets');

        $this->add_module(_("Dashboards"));

        $menu = new FAModuleMenu(
            'modules/ksf_FA_CRM_Dashboard/index.php',
            'view',
            ''
        );

        $menu->addItem('dashboard_widgets', _("Dashboards"), MENU_INQUIRY)
             ->registerWithApp($this, 'SA_DASHBOARD_VIEW');

        $this->add_extensions();
    }
}
