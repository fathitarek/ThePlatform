<?php



namespace App\Http\Middleware;



use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;



class VerifyCsrfToken extends BaseVerifier

{

    /**

     * The URIs that should be excluded from CSRF verification.

     *

     * @var array

     */

    protected $except = [

        //

        'affiliateAPI/addProductWithCode',

        'affiliateAPI/addProductViewsWithCode',
        'affiliateAPI/addLogsNotifications',
        'affiliateAPI/sendSMSEmail',
        
        'cron',
        'getaccesstoken1/*',
        'updatepost1/*',
        
        


    ];

}

