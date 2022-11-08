<?php

namespace frontend\controllers\api\v1;

use common\cacheKeys\ChannelsAll;
use frontend\transformers\v1\ChannelTransformer;
use frontend\repository\v1\ChannelRepository;
use Yii;
use yii\rest\Controller;
use yii\web\Response;

class ChannelsController extends Controller
{
    private ChannelRepository $repository;
    private ChannelTransformer $transformer;

    public function __construct($id, $module, ChannelTransformer $transformer, ChannelRepository $repository, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function actionIndex(): Response
    {
        $response = [];

        $cache = \Yii::$app->cache;

        $response['channels'] = $cache->getOrSet(ChannelsAll::KEY, function () {
            $channels = $this->repository->getAll();

            return array_map([$this->transformer, 'transform'], $channels);
        });

        return $this->asJson($response);
    }
}
