<?php

namespace Kreds\WebWalletApiClient;

use Unirest\Request;


/* ********************************************************************************* */
/* **************** Reference Implementation for the Kreds WebWallet API *********** */
/* ********************************************************************************* */
/* *** Note: For clarity the available methods have been divided into 3 sections *** */
/* **   1) General methods                                                       *** */
/* **   2) User methods                                                          *** */
/* **   3) Admin methods                                                         *** */
/* ********************************************************************************* */
class Client
{
    protected $_config;


    public function __construct ($config=null)
    {
        $this->_config = $config ? $config : Config::getConfig();
    }



    /* ********************************************************************** */
    /* ******** Public functions which do not require authentication ******** */
    /* ********************************************************************** */
    public function getInfo ()
    {
        $url      = $this->_getUrl('info');
        $headers  = [ 'Accept' => 'application/json' ];
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function getStatus ()
    {
        $url      = $this->_getUrl('status');
        $headers  = [ 'Accept' => 'application/json' ];
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function validateAddress (string $address)
    {
        if (!$address) {
            throw new \InvalidArgumentException('Invalid [address] received');
        }

        $url      = $this->_getUrl('validateAddress', [ $address ] );
        $headers  = [ 'Accept' => 'application/json' ];
        $response = Request::get ($url, $headers);

        return $response->body;
    }



    /* ********************************************************************** */
    /* ********** User functions which require user authentication ********** */
    /* ********************************************************************** */
    public function userAddressCreate ()
    {
        $url      = $this->_getUrl('user/address');
        $headers  = $this->_genHeader();
        $response = Request::post($url, $headers);

        return $response->body;
    }


    public function userAddressesGet ($page=1, $pagesize=100)
    {
        $url      = $this->_getUrl('user/addresses', [ $page, $pagesize ]);
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }


    public function userBalanceGet ()
    {
        $url      = $this->_getUrl('user/balance');
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }


    public function userDepositsGet ($page=1, $pagesize=100)
    {
        $url      = $this->_getUrl('user/deposits', [ $page, $pagesize ]);
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }


    public function userSummaryGet ()
    {
        $url      = $this->_getUrl('user/summary');
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }


    public function userWithdrawsGet ($page=1, $pagesize=100)
    {
        $url      = $this->_getUrl('user/withdraws', [ $page, $pagesize ]);
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }


    public function userWithdraw (string $toAddress, float $amount, bool $takeFeeFromAmount=true)
    {
        if (!$toAddress) {
            throw new \InvalidArgumentException('Invalid [account] received');
        }
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Invalid [amount] received');
        }

        $url       = $this->_getUrl('user/withdraw', [ $toAddress, $amount, $takeFeeFromAmount ]);
        $headers   = $this->_genHeader();
        $response = Request::post($url, $headers);

        return $response->body;
    }


    public function userTransactionGet (string $txid)
    {
        if (!$txid) {
            throw new \InvalidArgumentException('Invalid [txid] received');
        }

        $url      = $this->_getUrl('user/transaction', [ $txid ]);
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }


    public function userTransactionsGet ($page=1, $pagesize=100)
    {
        $url      = $this->_getUrl('user/transactions', [ $page, $pagesize ]);
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }



    /* ********************************************************************** */
    /* ********* Admin functions which require admin authentication ********* */
    /* ********************************************************************** */
    public function adminAccountBalance (string $account)
    {
        if (!$account) {
            throw new \InvalidArgumentException('Invalid [account] received');
        }

        $url      = $this->_getUrl('admin/account/balance', [ $account ]);
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }


    public function adminAccountCreate (float $initialBalance=0.0)
    {
        $url      = $this->_getUrl('admin/account', [ 'withBalance', $initialBalance ]);
        $headers  = $this->_genHeader();
        $response = Request::post($url, $headers);

        return $response->body;
    }


    public function adminAccountCredit (string $account, float $amount)
    {
        if (!$account) {
            throw new \InvalidArgumentException('Invalid [account] received');
        }
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Invalid [amount] received');
        }

        $url      = $this->_getUrl('admin/account/credit', [ $account, $amount ]);
        $headers  = $this->_genHeader();
        $response = Request::post($url, $headers);

        return $response->body;
    }


    public function adminAccountDebit (string $account, float $amount)
    {
        if (!$account) {
            throw new \InvalidArgumentException('Invalid [account] received');
        }
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Invalid [amount] received');
        }

        $url      = $this->_getUrl('admin/account/debit', [ $account, $amount ]);
        $headers  = $this->_genHeader();
        $response = Request::post($url, $headers);

        return $response->body;
    }


    public function adminAccountDepositsSum (string $account, int $hours=24)
    {
        if (!$account) {
            throw new \InvalidArgumentException('Invalid [account] received');
        }

        $url      = $this->_getUrl('admin/account/deposits/sum', [ $account, $hours ]);
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }


    public function adminAccountReset (string $account)
    {
        if (!$account) {
            throw new \InvalidArgumentException('Invalid [account] received');
        }

        $url      = $this->_getUrl('admin/account/reset', [ $account ]);
        $headers  = $this->_genHeader();
        $response = Request::post($url, $headers);

        return $response->body;
    }


    public function adminAccountWithdrawAvailable (string $account)
    {
        if (!$account) {
            throw new \InvalidArgumentException('Invalid [account] received');
        }

        $url      = $this->_getUrl('admin/account/withdraws/available', [ $account ]);
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }


    public function adminAccountWithdrawsSum (string $account, int $hours=24)
    {
        if (!$account) {
            throw new \InvalidArgumentException('Invalid [account] received');
        }

        $url      = $this->_getUrl('admin/account/withdraws/sum', [ $account, $hours ]);
        $headers  = $this->_genHeader();
        $response = Request::get($url, $headers);

        return $response->body;
    }




    /* ********************************************************************** */
    /* ********************* Internal/Private methods *********************** */
    /* ********************************************************************** */
    protected function _genHeader (array $params=[]) : array
    {
        $params['nonce'] = strval(round(microtime(true) * 1000,0));
        $payload         = base64_encode(json_encode($params));
        $signature       = hash_hmac("sha512", $payload, $this->_config['apiSecret']);

        return [
            'Accept'          => 'application/json',
            'X-WWT-APIKEY'    => $this->_config['apiKey'],
            'X-WWT-PAYLOAD'   => $payload,
            'X-WWT-SIGNATURE' => $signature
        ];
    }


    protected function _getUrl (string $functionUrl, array $params=[]) : string
    {
        $url = $this->_config['baseUrl'] . '/' . $functionUrl;
        if ($params) {
            foreach ($params as $k=>$v) {
                $url .= "/$v";
            }
        }

        return $url;
    }
}

