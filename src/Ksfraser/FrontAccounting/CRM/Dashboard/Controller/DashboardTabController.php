<?php

declare(strict_types=1);

namespace Ksfraser\FrontAccounting\CRM\Dashboard\Controller;

use Ksfraser\FrontAccounting\Common\App\AbstractTabController;
use Ksfraser\FrontAccounting\CRM\Dashboard\Service\DashboardService;
use ksfraser\RelatedTo\DTO\RelatedQueryDto;
use ksfraser\RelatedTo\UI\DefaultRelatedRecordsRenderer;

class DashboardTabController extends AbstractTabController
{
    private $service;

    public function __construct($context = null, array $options = [])
    {
        parent::__construct($context, $options);
        $this->service = new DashboardService();
    }

    protected function getPkField(): string { return 'widget_id'; }

    protected function getFieldMetadata(): array
    {
        return [
            'entity'      => 'ksf_crm_dashboard_widget',
            'table'       => '0_ksf_crm_dashboard_widgets',
            'label'       => 'Dashboard Widget',
            'labelPlural' => 'Dashboard Widgets',
            'hookPrefix'  => 'dashboard',
            'pk'          => 'widget_id',
            'fields'      => [],
            'fk_ddls'   => [],
            'ddlHooks'  => [],
            'tableSettings' => [],
        ];
    }

    protected function listRows(int $page, int $perPage): array
    {
        $offset = ($page - 1) * $perPage;
        return array_slice($this->service->listAll(), $offset, $perPage);
    }

    protected function countRows(): int
    {
        return count($this->service->listAll());
    }

    protected function findRecord(string $pk): ?array { return null; }
    protected function createRecord(array $data): int { return 0; }
    protected function updateRecord(string $pk, array $data): void {}
    protected function deleteRecord(string $pk): void {}
    protected function fkOptions(): array { return []; }

    protected function renderSummaryTable(): void
    {
        if (!function_exists('start_table')) return;

        $page = max(1, $this->page());
        $perPage = $this->perPage;
        $rows = $this->listRows($page, $perPage);

        start_table(TABLESTYLE2, "width='95%'");
        $th = function (string $label): void {
            echo '<th>' . htmlspecialchars($this->localise($label), ENT_QUOTES) . '</th>';
        };
        echo '<tr>';
        $th(_('Widget ID'));
        $th(_('Widget Name'));
        $th(_('Widget Type'));
        $th(_('Position'));
        $th(_('Active'));
        $th(_('Actions'));
        echo '</tr>';

        if (empty($rows)) {
            echo '<tr><td colspan="6"><em>'
                . htmlspecialchars($this->localise('No dashboard widgets yet.'), ENT_QUOTES)
                . '</em></td></tr>';
        }

        foreach ($rows as $i => $row) {
            echo '<tr class="' . ($i % 2 ? 'evenrow' : 'oddrow') . '">';
            echo '<td>' . htmlspecialchars($row['fields']['widget_id'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['fields']['name'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['fields']['type'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['fields']['position'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td>' . htmlspecialchars($row['fields']['is_active'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
            echo '<td><a href="' . htmlspecialchars($row['url'] ?? '#', ENT_QUOTES, 'UTF-8') . '" target="_blank">'
                . htmlspecialchars($this->localise('View'), ENT_QUOTES, 'UTF-8') . '</a></td>'
            . '</tr>';
        }

        end_table(0);
    }

    protected function renderNotes(): void
    {
        $lhsId = isset($_GET['id']) ? (string) $_GET['id'] : '';
        if ($lhsId === '' || !function_exists('hook_invoke')) return;

        $queryDto = new RelatedQueryDto('ksf_crm_dashboard_widget', $lhsId);
        $queryResult = $queryDto;
        hook_invoke('ksf_FA_RelatedTo', 'RELATED_TO', $queryResult, null);

        if (!is_array($queryResult) || !isset($queryResult['related']) || !is_array($queryResult['related'])) {
            return;
        }

        $renderer = new DefaultRelatedRecordsRenderer(array(
            'css_class' => 'related-records',
            'header_class' => 'related-header',
            'table_class' => 'related-table',
            'table_border' => true,
            'type_labels' => array('ksf_crm_dashboard_widget' => _('Dashboard Widget')),
        ));
        echo $renderer->renderRelatedRecords('ksf_crm_dashboard_widget', $lhsId, $queryResult['related'], array(
            'css_class' => 'related-records',
            'header_class' => 'related-header',
            'table_class' => 'related-table',
            'table_border' => true,
        ));
    }
}
