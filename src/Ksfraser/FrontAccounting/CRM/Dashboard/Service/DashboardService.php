<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Dashboard\Service;
use Ksfraser\FrontAccounting\CRM\Dashboard\DTO\DashboardDTO;
use Ksfraser\FrontAccounting\CRM\Dashboard\Repository\DashboardRepository;
use ksfraser\RelatedTo\DTO\RelatedRecordDto;
final class DashboardService {
    private $repo;
    public function __construct(?DashboardRepository $repo = null) { $this->repo = $repo ?? new DashboardRepository(); }
    public function resolveById(int $id, ?RelatedRecordDto $dto = null): array {
        $row = $this->repo->findById($id);
        if ($row === null) {
            return array('dto' => new RelatedRecordDto('ksf_crm_dashboard_widget', '0', 'ksf_crm_dashboard_widget', '0', null), 'fields' => $this->fieldMap(), 'labels' => $this->labelMap(), 'url' => '#', 'label' => _('Dashboard Widget #') . (string) $id);
        }
        $r = DashboardDTO::fromArray($row);
        $dto = $dto ?? new RelatedRecordDto('ksf_crm_dashboard_widget', (string) $r->widget_id, 'ksf_crm_dashboard_widget', (string) $r->widget_id, null);
        return array(
            'dto' => $dto,
            'fields' => array(
                'widget_id' => (string) $r->widget_id,
                'name' => $r->name,
                'type' => $r->type,
                'position' => $r->position,
                'is_active' => $r->is_active,
            ),
            'labels' => $this->labelMap(),
            'url' => '/modules/ksf_FA_CRM_Dashboard/pages/dashboard_widget_form.php?action=edit&widget_id=' . $r->widget_id,
            'label' => $r->getDisplayLabel(),
        );
    }
    public function listAll(): array {
        $rows = $this->repo->findAll();
        $results = array();
        foreach ($rows as $row) {
            $r = DashboardDTO::fromArray($row);
            $results[] = array(
                'id' => $r->widget_id,
                'dto' => new RelatedRecordDto('ksf_crm_dashboard_widget', (string) $r->widget_id, 'ksf_crm_dashboard_widget', (string) $r->widget_id, null),
                'fields' => array(
                    'widget_id' => (string) $r->widget_id,
                    'name' => $r->name,
                    'type' => $r->type,
                    'position' => $r->position,
                    'is_active' => $r->is_active,
                ),
                'labels' => $this->labelMap(),
                'url' => '/modules/ksf_FA_CRM_Dashboard/pages/dashboard_widget_form.php?action=edit&widget_id=' . $r->widget_id,
                'label' => $r->getDisplayLabel(),
            );
        }
        return $results;
    }
    public function insertWidget(array $data): int {
        return $this->repo->insertWidget($data);
    }
    public function updateState(int $widgetId, string $isActive, string $name = null): void {
        $this->repo->updateState($widgetId, $isActive, $name);
        dashboard_widget_state_changed((string) $widgetId, '', 'updated', array('is_active' => $isActive));
    }
    public function fieldMap(): array { return $this->labelMap(); }
    public function labelMap(): array {
        return array(
            'widget_id' => _('Widget ID'),
            'name' => _('Widget Name'),
            'type' => _('Widget Type'),
            'position' => _('Position'),
            'is_active' => _('Active'),
        );
    }
    public function getStateTransitions(string $currentState): array {
        return array();
    }
    public function isAllowedTransition(string $fromState, string $toState): bool {
        return false;
    }
}
