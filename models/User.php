<?php

namespace Models;

class User extends ActiveRecord{
    protected static $table = 'users';
    protected static $idName = 'userId';
    protected static $columnsDB = ['userId','name','surname','email','tempEmail','password','token','confirm','admin'];

    public $userId;
    public $name;
    public $surname;
    public $email;
    public $tempEmail;
    public $password;
    public $password2;
    public $current_password;
    public $new_password;
    public $token;
    public $confirm;
    public $admin;
    

    public function __construct($args = [])
    {
        $this->userId = $args['userId'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->surname = $args['surname'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->tempEmail = $args['tempeamil'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->current_password = $args['current_password'] ?? '';
        $this->new_password = $args['new_password'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirm = $args['confirm'] ?? '0';     
        $this->admin = $args['admin'] ?? '0';     
    }

    //validar login
    public function validateLogin() : array{
        $this->validateEmail();
        $this->validatePassword();
        return self::$alerts;
    }

    //validar cuentas nuevas
    public function validateNewAccount() : array{
        $this->validateName();
        $this->validateEmail();
        $this->validatePassword();
        $this->validatePassword2();
        return self::$alerts;
    }

    public function validateProfile() : array{
        $this->validateName();
        $this->validateEmail();
        $this->validarCurrentPassword();
        return self::$alerts;
    }

    public function validateName() : array{
        if(!$this->name){
            self::$alerts['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->surname){
            self::$alerts['error'][] = 'El apellido es obligatorio';
        }
        return self::$alerts;
    }

    //valida un email
    public function validateEmail() : array{
        if(!$this->email){
            self::$alerts['error'][] = 'El correo es obligatorio';
        }
        if($this->email && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alerts['error'][] = 'El correo no es valido';
        }
        return self::$alerts;
    }

    public function validateTempEmail() : array{
        if(!$this->tempEmail){
            self::$alerts['error'][] = 'El correo es obligatorio';
        }
        if($this->tempEmail && !filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$alerts['error'][] = 'El correo no es valido';
        }
        return self::$alerts;
    }

    public function validatePassword() : array{
        if(!$this->password){
            self::$alerts['error'][] = 'La contraseña es obligatoria';
        }
        if($this->password && strlen($this->password) < 6){
            self::$alerts['error'][] = 'La contraseña debe de contener al menos 6 caracteres';
        }
        return self::$alerts;
    }

    public function validatePassword2() : array{
        if($this->password && !$this->password2){
            self::$alerts['error'][] = 'Vuelve a escribir la contraseña';
        }
        if($this->password && $this->password2 && $this->password !== $this->password2){
            self::$alerts['error'][] = 'Las contraseñas son diferentes';
        }
        return self::$alerts;
    }
    
    public function validatePasswordChange() : array{
        $this->validarCurrentPassword();
        $this->validateNewPassword();
        return self::$alerts;
    }

    public function validarCurrentPassword() : array{
        if(!$this->current_password){
            self::$alerts['error'][] = 'La contraseña actual es obligatoria';
        }
        if($this->current_password && strlen($this->current_password) < 6){
            self::$alerts['error'][] = 'La contraseña actual debe de contener al menos 6 caracteres';
        }
        return self::$alerts;
    }

    public function validateNewPassword() : array{ //en change-pasword password2 esta ligado a password_nuevo
        if(!$this->new_password){
            self::$alerts['error'][] = 'La contraseña nueva es obligatoria';
        }
        if($this->new_password && strlen($this->new_password) < 6){
            self::$alerts['error'][] = 'La contraseña nueva debe de contener al menos 6 caracteres';
        }
        if($this->new_password && !$this->password2){
            self::$alerts['error'][] = 'Vuelve a escribir la contraseña nueva';
        }
        if($this->new_password && $this->password2 && $this->new_password !== $this->password2){
            self::$alerts['error'][] = 'Las contraseñas nuevas son diferentes';
        }
        return self::$alerts;
    }

    //hashea password
    public function hashPassword(): void{
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    
    //generar token
    public function createToken() : void{
        $this->token = md5(uniqid());
    }

    //comprobar password
    public function comprobarPassword() : bool{
        return password_verify($this->new_password, $this->password);
    }
}