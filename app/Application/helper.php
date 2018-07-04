<?php

use App\Model\Icehouse\Icehouse_floatingips;


if (!function_exists('generate_ean')) {
    /**
     * Generating Random Valid EAN code.
     *
     * @return string
     */
    function generate_ean()
    {
        $number     = mt_rand(1, 999999999);
        $code       = '211' . str_pad($number, 9, '0');
        $weightflag = true;
        $sum        = 0;
        for ($i = strlen($code) - 1; $i >= 0; $i--) {
            $sum        += (int) $code[$i] * ($weightflag ? 3 : 1);
            $weightflag = !$weightflag;
        }
        $code .= (10 - ($sum % 10)) % 10;
        
        return $code;
    }
}

if (!function_exists('formatNumber')) {
    
    /**
     * @param        $number
     * @param string $currency
     * @return string
     */
    function formatNumber($number, $currency = 'IDR')
    {
        if ($currency == 'USD') {
            return number_format($number, 2, ' . ', ',');
        }
        
        return number_format($number, 0, ' . ', ' . ');
    }
}

if (!function_exists('floatingips')) {
    
    /**
     * @param $environment
     * @param $ip
     */
    function floatingips($environment, $ip)
    {
        $results = DB::select(DB::raw("SELECT " . $environment . "_floatingips.status AS status_ip,
        " . $environment . "_instance.status AS status_instance,
        " . $environment . "_floatingips.fixed_ip_address,
        " . $environment . "_floatingips.floating_ip_address,
        " . $environment . "_floatingips.port_id,
        " . $environment . "_floatingips.router_id,
        " . $environment . "_projects.name AS project_name,
        " . $environment . "_instance.name AS instance_name,
        " . $environment . "_instance.addresses,
        " . $environment . "_floatingips.tenant_id FROM " . $environment . "_floatingips
        LEFT JOIN " . $environment . "_projects ON " . $environment . "_floatingips.tenant_id = icehouse_projects.id
        LEFT JOIN " . $environment . "_instance ON " . $environment . "_instance.tenant_id = icehouse_projects.id
        WHERE " . $environment . "_floatingips.floating_ip_address = '$ip' AND " . $environment . "_floatingips.status = 'ACTIVE'
        AND " . $environment . "_instance.addresses LIKE '%$ip%'"));
        return $results;
    }
}
