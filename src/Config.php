<?php

namespace Kreds\WebWalletApiClient;


class Config
{
    public static function getConfig ()
    {
        return [
            'baseUrl'   => 'http://localhost/BoostFixes/web/api',          // The base URL to the API routes of your wallet
            'apiKey'    => '94b5a646-d0e1-408a-8733-3a51d078ae7e',          // Your API-Key as reported by your web wallet account
            'apiSecret' => 'fTiTF2aHoWT97mO6hlWUykXpAoZbw0gy13It9j54BO98bD0LtdgacLYERgtkLUe6'           // Your API-Secret as reported by your web wallet account
        ];
    }
}

