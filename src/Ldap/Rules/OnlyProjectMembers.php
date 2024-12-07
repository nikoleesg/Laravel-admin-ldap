<?php

namespace LaravelAdmin\Ldap\Ldap\Rules;

use Illuminate\Database\Eloquent\Model as Eloquent;
use LdapRecord\Laravel\Auth\Rule;
use LdapRecord\Models\Model as LdapRecord;
use LdapRecord\Models\ActiveDirectory\Group;

class OnlyProjectMembers implements Rule
{
    /**
     * Check if the rule passes validation.
     */
    public function passes(LdapRecord $user, Eloquent $model = null): bool
    {
        // ...
        $activeDirectoryGroupName = 'CN=LP_PA,OU=Live_Project,OU=Managed Security Groups,DC=ascentiq,DC=com,DC=sg';

//        $activeDirectoryGroup = Group::find('CN=LP_PA,OU=Live_Project,OU=Managed Security Groups,DC=ascentiq,DC=com,DC=sg');

        return in_array($activeDirectoryGroupName, $user->memberof);
    }
}
