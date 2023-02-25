<?php

namespace Models;

class Register extends ActiveRecord{
    protected static $table = 'register';
    protected static $idName = 'registerId';
    protected static $columnsDB = ['registerId','packageId','payId','token','userId','giftId'];

    public $registerId;
    public $packageId;
    public $payId;
    public $token;
    public $userId;
    public $giftId;

    public function __construct($args = [])
    {
        $this->registerId = $args['registerId'] ?? null;
        $this->packageId = $args['packageId'] ?? '';
        $this->payId = $args['payId'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->userId = $args['userId'] ?? '';
        $this->giftId = $args['giftId'] ?? 1;

    }

   
}