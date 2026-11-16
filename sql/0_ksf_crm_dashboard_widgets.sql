-- ksf_FA_CRM_Dashboard: dashboard widget tables

CREATE TABLE IF NOT EXISTS `0_ksf_crm_dashboard_widgets` (
  `widget_id`   INT(11) NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(255) NOT NULL,
  `type`        VARCHAR(64) NOT NULL COMMENT 'e.g. kpi, chart, list, counter',
  `config`      TEXT DEFAULT NULL COMMENT 'JSON widget configuration',
  `position`    INT(11) NOT NULL DEFAULT 0,
  `is_active`   TINYINT(1) NOT NULL DEFAULT 1,
  `created_at`  DATETIME NOT NULL,
  `updated_at`  DATETIME NOT NULL,
  PRIMARY KEY (`widget_id`),
  KEY `idx_type` (`type`),
  KEY `idx_active` (`is_active`),
  KEY `idx_position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
