# Eloquent Encryptable

Automatically encrypt and decrypt Eloquent model attributes.

## Installation

```bash
composer require beninada/eloquent-encryptable
```

## Usage

Add this trait to your model and specify the fields you want encrypted in `$encryptable`:

```php
<?php

use Illuminate\Database\Eloquent\Model;
use BenInada\Eloquent\Encryptable;

class User extends Model
{
    use Encryptable;

    protected $encryptable = [
        'license_number',
        'phone_number',
        'secret_token'
    ]
}
```

Now, when you set these fields, they will be automatically encrypted:

```php
$user->license_number = 'ABC12345';
$user->phone_number = '(111) 111-1111';
$user->secret_token = 'supersecrettoken';
```

When you access these attributes, they will be automatically decrypted:

```php
echo $user->license_number;   // ABC12345
echo $user->phone_number;     // (111) 111-1111
echo $user->secret_token;     // supersecrettoken
```
