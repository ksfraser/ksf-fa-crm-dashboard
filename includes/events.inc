<?php
declare(strict_types=1);

if (!function_exists('hook_invoke_all')) {
    return;
}

function dashboard_widget_state_changed($widgetId, $fromState, $toState, $meta = array()) {
    hook_invoke_all('DASHBOARD_STATE_CHANGED', array(
        'widget_id' => $widgetId,
        'from_state' => $fromState,
        'to_state' => $toState,
        'meta' => $meta,
    ));
}
