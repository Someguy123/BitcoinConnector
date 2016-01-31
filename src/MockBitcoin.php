<?php
namespace Someguy123\BitcoinConnector;

class MockBitcoin {
    public $balance = 1.23;
    public $blocks = 92172748;
    public $transactions = [];
    public function getinfo()
    {
        return [
            'balance' => $this->balance,
            'blocks' => $this->blocks
        ];
    }

    public function getaccountaddress($account = "")
    {
        return rand_str();
    }

    public function getnewaddress($account = "")
    {
        return rand_str();
    }

    public function listtransactions($limit = 0) {
        return $this->transactions;
    }

    public function sendtoaddress($address, $amount)
    {
        if($amount >= $this->balance) {
            throw new \Exception('Not enough balance');
        }
        return rand_str();
    }
}