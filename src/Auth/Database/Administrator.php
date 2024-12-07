<?php

namespace LaravelAdmin\Ldap\Auth\Database;

use Encore\Admin\Auth\Database\Administrator as BaseAdministrator;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;

class Administrator extends BaseAdministrator implements LdapAuthenticatable
{
    use AuthenticatesWithLdap;

}
