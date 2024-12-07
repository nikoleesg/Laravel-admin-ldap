<?php

namespace LaravelAdmin\Ldap\Ldap;

use LdapRecord\Models\Model;
use LaravelAdmin\Ldap\Ldap\Scopes\BaseDN;

class User extends Model
{
    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = [
        'top',
        'person',
        'organizationalperson',
        'user',
    ];

//    protected static function boot(): void
//    {
//        parent::boot();
//
//        static::addGlobalScope(new BaseDN);
//    }
}
