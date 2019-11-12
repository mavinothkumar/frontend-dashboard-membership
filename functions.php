<?php
/**
 * Created by Buffercode.
 * User: M A Vinoth Kumar
 */

function fed_m_get_one_time_payment()
{
    $plans = fed_fetch_table_rows_by_key_value(BC_FED_PAY_PAYMENT_PLAN_TABLE, 'status', 'ACTIVE');

    $value = fed_get_key_value_array($plans, 'plan_id', 'plan_name');
    if(count($value) <= 0){
        return array(''=>'Please Add New One Time Payment');
    }
    return $value;
}

/**
 * @return array
 */
function fed_m_get_subscription_payment()
{
//    return array(''=>'Please select');
    $plans  = new FED_PayPal\FED_PayPal();
    $lists  = $plans->list_plans()->getPlans();
    $value = fed_get_key_value_array($lists, 'id', 'name');

    if(count($value) <= 0){
        return array(''=>'Please Add New Subscription Plan');
    }
    return $value;
}

add_filter('fed_plugin_versions', function ($version) {
    return array_merge($version, array('membership' => __('Membership','frontend-dashboard-membership') .'(' . BC_FED_M_PLUGIN_VERSION . ')'));
});

add_filter('fed_shortcode_lists',function($shortcodes){
    return $shortcodes + array('fed_membership');
});
