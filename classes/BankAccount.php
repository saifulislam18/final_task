<?php

class BankAccount implements IfaceBankAccount
{

    private $balance = null;

    public function __construct(Money $openingBalance)
    {
        $this->balance = $openingBalance;
    }

    public function balance()
    {
        return $this->balance;
    }

    public function deposit(Money $amount)
    {
        $depositAmount=$amount->getAmount();
        $currentBalance=$this->balance->getAmount();
        $this->balance=$currentBalance+$depositAmount;
    }

    public function transfer(Money $amount, BankAccount $account)
    {
        $currentBalance=$this->balance;
        $transferAmount=$amount->getAmount();

        if ($transferAmount > $currentBalance) {
            throw new Exception('Withdrawl amount larger than balance');
        }else{
            $account->balance=$transferAmount+$account->balance;
            $this->balance=$currentBalance-$transferAmount;
        }
    }
    public function withdraw(Money $amount)
    {
        $withdrawAmount=$amount->getAmount();
        if (is_object($this->balance)) {
            $currentBalance=$this->balance->getAmount();   
            $this->balance=$currentBalance-$withdrawAmount;
        }elseif ($withdrawAmount > $this->balance) {
            throw new Exception('Withdrawl amount larger than balance');
        }       
    }
}