<?php

namespace Kreds\WebWalletApiClient;

use InnoBrig\FlexInput\Input;
use Unirest\Request;
use Unirest\Request\Body;


class Client
{
    protected $_config;


    public function __construct ($config=null)
    {
        $this->_config = $config ? $config : Config::getConfig();
    }


    public function createAccount ()
    {
        $url      = $this->getUrl('account');
        $headers  = $this->genHeader();
        $response = Request::post ($url, $headers);

        return $response->body;
    }


    public function creditAccount (string $account, float $amount)
    {
        if (!$account) {
            throw new \InvalidArgumentException('Invalid [account] received');
        }
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Invalid [amount] received');
        }

        $url      = $this->getUrl('account/credit', [ $account, $amount ]);
        $headers  = $this->genHeader();
        $response = Request::post ($url, $headers);

        return $response->body;
    }


    public function getAddresses ()
    {
        $url      = $this->getUrl('addresses');
        $headers  = $this->genHeader();
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function getBalance ()
    {
        $url      = $this->getUrl('balance');
        $headers  = $this->genHeader();
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function getDeposits ()
    {
        $url      = $this->getUrl('deposits');
        $headers  = $this->genHeader();
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function getDepositsSum (string $account, int $hours=24)
    {
        $url      = $this->getUrl('depositsSum', [ $account, $hours ]);
        $headers  = $this->genHeader();
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    // Note: getInfo is the only method which does not require authentication
    public function getInfo ()
    {
        $url      = $this->getUrl('info');
        $headers  = [ 'Accept' => 'application/json' ];
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function getSummary ()
    {
        $url      = $this->getUrl('summary');
        $headers  = $this->genHeader();
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function getStatus ()
    {
        $url      = $this->getUrl('status');
        $headers  = $this->genHeader();
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function getWithdraws ()
    {
        $url      = $this->getUrl('withdraws');
        $headers  = $this->genHeader();
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function getWithdrawsSum (string $account, int $hours=24)
    {
        $url      = $this->getUrl('withdrawsSum', [ $account, $hours ]);
        $headers  = $this->genHeader();
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function getTransaction (string $txid)
    {
        $url      = $this->getUrl('transactions', [ $txid ]);
        $headers  = $this->genHeader();
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function getTransactions ()
    {
        $url      = $this->getUrl('transactions');
        $headers  = $this->genHeader();
        $response = Request::get ($url, $headers);

        return $response->body;
    }


    public function newAddress ()
    {
        $url      = $this->getUrl('addresses');
        $headers  = $this->genHeader();
        $response = Request::post ($url, $headers);

        return $response->body;
    }


    public function status ()
    {
        $url      = $this->getUrl('status');
        $headers  = $this->genHeader();
        $response = Request::post ($url, $headers);

        return $response->body;
    }



    public function withdraw (string $toAddress, float $amount)
    {
        if (!$toAddress) {
            throw new \InvalidArgumentException('Invalid [account] received');
        }
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Invalid [amount] received');
        }

        $url       = $this->getUrl('withdraws', [ $toAddress, $amount ]);
        $headers   = $this->genHeader();
        $response = Request::post ($url, $headers);

        return $response->body;
    }



    protected function genHeader (array $params=[]) : array
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


    protected function getUrl (string $functionUrl, array $params=[]) : string
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

