<?php

namespace LaravelAdmin\Ldap\Ldap\Scopes;

use LdapRecord\Models\Model;
use LdapRecord\Models\Scope;
use LdapRecord\Query\Model\Builder;

class BaseDN implements Scope
{
    /**
     * Apply the scope to the given query.
     */
    public function apply(Builder $query, Model $model): void
    {
        $query->setBaseDn(config('admin-ldap.base_dn'));
    }
}
