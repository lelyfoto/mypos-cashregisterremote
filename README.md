# Cash Register Remote API implementation for MyPos

This is a simple PHP implementation of the MyPos Cash Register Remote API as described 
on the [MyPos website](https://developers.mypos.com/en/doc/in_person_payments/v1_0/356-cash-register-remote-api).

## Requirements
 - PHP 8.1+
 - PHP extensions: bcmath, soap
 - Composer 2
 - MyPos account and physical payment terminal

## Usage
First make sure you have met the requirements of the API from MyPos. 
See the requirements section on the [developer site from MyPos](https://developers.mypos.com/en/doc/in_person_payments/v1_0/356-cash-register-remote-api).
And store your private key securely in your project. Also add the public key you received from MyPos.  

Next require this library with composer:
```bash
composer require lelyfoto/mypos-cashregisterremote
```

Then create a Config-object:
```php
$config = new Config(
    'username@email.com',
    1, // Should be 1, unless you have more than one public key send to MyPos,
    'EUR',
    '12345678', // Your teminal ID, see your dashboard,
    file_get_contents('your_private_key.pem'),
    file_get_contents('mypos_public.crt'),
    Config::MYPOS_WSDL_PRODUCTION
);
```

The config object can now be used to pair your terminal:
```php
$terminal = new Terminal($config);
$securityCode = $terminal->requestPairCodeForSubscribe();
```
Go to your terminal and go to settings->pair device and enter the returned security code.

To make a payment:
```php
$requestId = $terminal->makePurchase(42, 'reference id', MPRPurchase::TYPE_REFERENCE_NUMBER);
```
Store the returned RequestId, you will need this to check the status of the payment.
On your terminal you hit the "Enter"-key, and you can do the payment.
You can further use the methods "checkPayment" or "cancelPayment" to interact with this payment.

Finally, when you want to disconnect your terminal, you can call "requestPairCodeForUnsubscribe" and enter the
security code into the device.

### Known issues and limitations
The biggest missing thing in this library is the lack of validation of the responses from MyPos. 
This will be addressed in a future release and is my top priority. 

Also, there is no unit testing at this moment and also there isn't a lot of error checking.
I build this library fast because I needed it soon, however I will make time to complete it soon.

Keep also in mind that I don't have a development terminal/account at MyPos, so I have to do all the testing in
the production environment. The Refund and LastTxnVoid calls are untested by me at this moment. 