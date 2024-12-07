<?php

namespace LaravelAdmin\Ldap\Controllers;

use Encore\Admin\Form;
use Illuminate\Http\Request;
use Encore\Admin\Controllers\AuthController as BaseController;

class AuthController extends BaseController
{
    /**
     * Handle a login request.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function postLogin(Request $request)
    {
        $this->loginValidator($request->all())->validate();

        $credentials = $request->only([$this->username(), 'password']);
        $remember = $request->get('remember', false);

        $ldapCredentials = [
            'samaccountname' => $credentials['username'],
            'password' => $credentials['password'],
        ];

        if ($this->guard()->attempt($ldapCredentials, $remember)) {
            return $this->sendLoginResponse($request);
        }

        return back()->withInput()->withErrors([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }

    /**
     * Model-form for user setting.
     *
     * @return Form
     */
    protected function settingForm()
    {
        $class = config('admin.database.users_model');

        $form = new Form(new $class());

        $form->display('username', trans('admin.username'));
        $form->text('name', trans('admin.name'))->rules('required')->disable();
        $form->image('avatar', trans('admin.avatar'));

        // Ldap login not allow to change password
//        $form->password('password', trans('admin.password'))->rules('confirmed|required');
//        $form->password('password_confirmation', trans('admin.password_confirmation'))->rules('required')
//            ->default(function ($form) {
//                return $form->model()->password;
//            });

        $form->setAction(admin_url('auth/setting'));

        $form->ignore(['password_confirmation']);

        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = Hash::make($form->password);
            }
        });

        $form->saved(function () {
            admin_toastr(trans('admin.update_succeeded'));

            return redirect(admin_url('auth/setting'));
        });

        return $form;
    }
}
