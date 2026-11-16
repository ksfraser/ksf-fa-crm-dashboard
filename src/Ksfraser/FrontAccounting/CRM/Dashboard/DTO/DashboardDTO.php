<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Dashboard\DTO;
final class DashboardDTO {
    public $widget_id;
    public $name;
    public $type;
    public $config;
    public $position;
    public $is_active;
    public $created_at;
    public $updated_at;
    public function __construct(
        int $widget_id,
        string $name = '',
        string $type = '',
        string $config = '',
        string $position = '0',
        string $is_active = '1',
        string $created_at = '',
        string $updated_at = ''
    ) {
        $this->widget_id = $widget_id;
        $this->name = $name;
        $this->type = $type;
        $this->config = $config;
        $this->position = $position;
        $this->is_active = $is_active;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
    public function getDisplayLabel(): string {
        if ($this->name !== '') {
            return sprintf(_('%s [%s]'), $this->name, $this->type);
        }
        return _('Dashboard Widget #') . (string) $this->widget_id;
    }
    public function toArray(): array {
        return array(
            'widget_id' => $this->widget_id,
            'name' => $this->name,
            'type' => $this->type,
            'config' => $this->config,
            'position' => $this->position,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        );
    }
    public static function fromArray(array $data): self {
        return new self(
            (int) ($data['widget_id'] ?? 0),
            (string) ($data['name'] ?? ''),
            (string) ($data['type'] ?? ''),
            (string) ($data['config'] ?? ''),
            (string) ($data['position'] ?? '0'),
            (string) ($data['is_active'] ?? '1'),
            (string) ($data['created_at'] ?? ''),
            (string) ($data['updated_at'] ?? '')
        );
    }
}
