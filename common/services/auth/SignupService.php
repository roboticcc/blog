<?php

namespace common\services\auth;

use common\models\User;
use frontend\models\SignupForm;
use Yii;
use yii\base\Exception;

/**
 * Sign-up service, used to add a user and verify its email
 */
class SignupService
{
    /**
     * @param SignupForm $form
     * @return User
     * @throws Exception
     *
     * Saves new User object to database
     */
    public function signup(SignupForm $form)
    {
        $user = new User();
        $user->username = $form->username;
        $user->generateAuthKey();
        $user->setPassword($form->password);
        $user->email = $form->email;
        $user->verification_token = Yii::$app->security->generateRandomString();
        $user->status = User::STATUS_INACTIVE;

        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }

        return $user;
    }

    /**
     * @param User $user
     * @return void
     *
     * Sends confirmation email to the email provided by user when signing up
     */
    public function sentEmailConfirmation(User $user)
    {
        $email = $user->email;

        $sent = Yii::$app->mailer
            ->compose(
                ['html' => 'user-signup-comfirm-html', 'text' => 'user-signup-comfirm-text'],
                ['user' => $user])
            ->setTo($email)
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject('Confirmation of registration')
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }

    /**
     * @param $token
     * @return void
     *
     * Checks whether verification token is correct and if so, changes user status in database
     */
    public function confirmation($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }

        $user = User::findOne(['verification_token' => $token]);
        if (!$user) {
            throw new \DomainException('User is not found.');
        }

        $user->verification_token = null;
        $user->status = User::STATUS_ACTIVE;
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }

        if (!Yii::$app->getUser()->login($user)) {
            throw new \RuntimeException('Error authentication.');
        }
    }
}