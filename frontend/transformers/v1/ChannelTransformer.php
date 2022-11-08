<?php

namespace frontend\transformers\v1;

use yii\helpers\Url;

class ChannelTransformer
{
    public function transform(array $channel): array
    {
        $response = ['id' => '', 'name' => '', 'description' => '', 'url' => '', 'image' => ''];

        if (isset($channel['id'])) {
            $response['id'] = $channel['id'];
        }

        if (isset($channel['title'])) {
            $response['name'] = $channel['title'];
        }

        if (isset($channel['description'])) {
            $response['description'] = $channel['description'];
        }

        if (isset($channel['url'])) {
            $response['url'] = $channel['url'];
        }

        if (isset($channel['logo'])) {
            $response['image'] = Url::base(true) . '/' . $channel['logo'];
        }

        return $response;
    }
}