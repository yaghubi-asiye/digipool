<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'perfectmoney/sell/success',
        'perfectmoney/sell/failure',
        'perfectmoney/charge/*',
        'perfectmoney/buy/*',
        'wallet/callback/*',
        'PSVouchers/buy/*/callback',
        'PMvoucher/charge/*/callback',
        'PMvoucher/buy/*/callback',
        'paypal/charge/*/callback',
        'paypal/buy/*/callback',
        'skrill/charge/*/callback',
        'skrill/buy/*/callback',
        'webmoney/charge/*/callback',
        'webmoney/buy/*/callback',
        'voucher/buy/*/callback',
        'bitcoin/buy/*/callback',
        'ethereum/buy/*/callback',
        'ripple/buy/*/callback',
        'tether/buy/*/callback',

        'vg-admin/ticket/mobile',

        'telegram/*'
    ];
}
