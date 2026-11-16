# ksf_FA_CRM_Dashboard — Requirements

## Purpose
Manage CRM dashboards/KPIs: dashboard widgets, KPI metrics and aggregated CRM data views.

## Business Rules (CRM-007)
- A dashboard widget has a name, type, JSON config, position and active flag.
- Widgets are ordered by position.
- Only active widgets are displayed on the dashboard.

## Functional Requirements
- FR-DB-01: Create a dashboard widget.
- FR-DB-02: List all dashboard widgets (summary table).
- FR-DB-03: Resolve a single widget by id (related-record linking).
- FR-DB-04: Update widget active flag and name.
- FR-DB-05: Expose dashboard widget fields via RELATED_TO_FIELDS.

## Non-Functional Requirements
- NF-DB-01: All database access uses native FA db_* calls.
- NF-DB-02: PHP 7.3 compatible runtime.
- NF-DB-03: Unit tests cover DTO round-trip and label resolution.
