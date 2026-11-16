# ksf_FA_CRM_Dashboard — Requirements Traceability Matrix

| Req ID | Requirement | Source | Implemented In | Verified By |
|--------|-------------|--------|----------------|-------------|
| CRM-007 | CRM dashboards/KPIs | HR-CRM_gaps.md CRM-007 | DashboardService | unit tests |
| FR-DB-01 | Create widget | CRM-007 | DashboardRepository::insertWidget | DashboardDtoTest |
| FR-DB-02 | List widgets | CRM-007 | DashboardService::listAll | (tab controller) |
| FR-DB-03 | Resolve widget by id | CRM-007 | DashboardService::resolveById | (capability hook) |
| FR-DB-04 | Update widget | CRM-007 | DashboardService::updateState | (service) |
| FR-DB-05 | RELATED_TO_FIELDS | CRM-007 | hooks.php RELATED_TO_FIELDS | (capability) |
| NF-DB-01 | Native db_* calls | AGENTS_ARCH | repository | code review |
| NF-DB-02 | PHP 7.3 compatible | AGENTS_ARCH | all src | code review |
| NF-DB-03 | Unit tests | AGENTS_ARCH | tests/Unit | phpunit |
