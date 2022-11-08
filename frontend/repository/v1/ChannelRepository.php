<?php

namespace frontend\repository\v1;

use yii\db\Query;

class ChannelRepository
{
    public function getAll(): array
    {
        return (new Query())
            ->select([
                'id',
                'title',
                'url',
                'logo',
                'description',
            ])
            ->from('channel')
            ->all();
    }
}