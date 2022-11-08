<?php

use yii\db\Migration;

/**
 * Class m221108_112321_channel
 */
class m221108_112321_channel extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('channel', [
            'id' => $this->primaryKey(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->append('ON UPDATE CURRENT_TIMESTAMP'),

            'title' => $this->string(40)->notNull(),
            'url' => $this->string(50),
            'logo' => $this->string(50),
            'description' => $this->text(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('channel');
    }
}
