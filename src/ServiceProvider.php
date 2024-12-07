<?php

namespace LaravelAdmin\Ldap;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
        if (config('admin.auth.guard') === 'ldap') {
            $this->initConfig();
        }

        $this->registerPublishing();
    }

    public function register(): void
    {
        $this->loadAdminLdapAuthConfig();
    }

    protected function initConfig(): void
    {
        config([
            'admin.auth.controller' => config('admin-ldap.controller')
        ]);
    }

    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'admin-ldap');
            $this->publishes([__DIR__ . '/../database/migrations' => database_path('migrations')], 'laravel-admin-oauth');
        }
    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadAdminLdapAuthConfig(): void
    {
        config(Arr::dot(config('admin-ldap.auth', []), 'auth.'));
    }
}
