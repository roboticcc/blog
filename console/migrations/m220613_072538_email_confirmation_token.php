<?php

use yii\db\Migration;

/**
 * Class m220613_072538_email_confirmation_token
 */
class m220613_072538_email_confirmation_token extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'email_confirm_token', $this->string()->unique()->after('email'));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'email_confirm_token');
    }

}
