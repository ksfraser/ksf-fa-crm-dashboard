<?php
declare(strict_types=1);
namespace Ksfraser\FrontAccounting\CRM\Dashboard\Repository;
final class DashboardRepository {
    private string $table = 'ksf_crm_dashboard_widgets';
    public function findAll(): array {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return array(); }
        $sql = "SELECT * FROM " . TB_PREF . $this->table . " ORDER BY position ASC, widget_id ASC";
        $result = db_query($sql, 'Could not load dashboard widgets');
        if ($result === false) { return array(); }
        $rows = array();
        while (($row = db_fetch_assoc($result)) !== false && $row !== null) { $rows[] = $row; }
        return $rows;
    }
    public function findById(int $id): ?array {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return null; }
        $sql = "SELECT * FROM " . TB_PREF . $this->table . " WHERE widget_id = " . (int) $id;
        $result = db_query($sql, 'Could not load dashboard widget');
        if ($result === false) { return null; }
        $row = db_fetch_assoc($result);
        return $row === false ? null : $row;
    }
    public function insertWidget(array $data): int {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return 0; }
        $sql = "INSERT INTO " . TB_PREF . $this->table . " (
                name, type, config, position, is_active, created_at, updated_at)
            VALUES ("
            . $this->escape($data['name'] ?? '') . ", "
            . $this->escape($data['type'] ?? '') . ", "
            . $this->escape($data['config'] ?? '') . ", "
            . $this->intVal($data['position'] ?? 0) . ", "
            . $this->intVal($data['is_active'] ?? 1) . ", "
            . $this->escape(date('Y-m-d H:i:s')) . ", "
            . $this->escape(date('Y-m-d H:i:s')) . ")";
        $this->dbQuery($sql);
        return $this->dbInsertId();
    }
    public function updateState(int $widgetId, string $isActive, string $name = null): void {
        if (!function_exists('db_query') || !defined('TB_PREF')) { return; }
        $sets = ["is_active = " . $this->intVal($isActive)];
        $sets[] = "name = " . $this->escape($name ?? '');
        $sets[] = "updated_at = " . $this->escape(date('Y-m-d H:i:s'));
        $sql = "UPDATE " . TB_PREF . $this->table . " SET " . implode(', ', $sets)
            . " WHERE widget_id = " . $this->intVal($widgetId);
        $this->dbQuery($sql);
    }
    private function dbQuery($sql, $errorMsg = null) {
        return db_query($sql, $errorMsg);
    }
    private function dbInsertId() {
        return db_insert_id();
    }
    private function escape($value): string {
        if ($value === null) { return 'NULL'; }
        return function_exists('db_escape') ? db_escape($value) : addslashes((string) $value);
    }
    private function intVal($value): int {
        return $value !== null ? (int) $value : 0;
    }
}
