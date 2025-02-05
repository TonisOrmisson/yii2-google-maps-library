<?php

/*
 *
 * @copyright Copyright (c) 2013-2019 2amigos
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */

namespace dosamigos\google\maps;

use Yii;
use yii\web\AssetBundle;

/**
 * MapAsset
 *
 * Registers the google maps api
 *
 * To update the key or other options like language, version, or library
 * use the Asset Bundle customization.
 * http://www.yiiframework.com/doc-2.0/guide-structure-assets.html#customizing-asset-bundles
 * To get key, please visit https://code.google.com/apis/console/
 *
 *      'components' => [
 *          'assetManager' => [
 *              'bundles' => [
 *                  'dosamigos\google\maps\MapAsset' => [
 *                      'options' => [
 *                          'key' => 'this_is_my_key',
 *                          'language' => 'id',
 *                          'version' => '3.1.18'
 *                      ]
 *                  ]
 *              ]
 *          ],
 *      ],
 *
 * @author Antonio Ramirez <hola@2amigos.us>
 *
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps
 */
class MapAsset extends AssetBundle
{
    /**
     * Sets options for the google map
     * @var array
     */
    public $options = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $params = Yii::$app->params;
        // BACKWARD COMPATIBILITY
        // To configure please, add `googleMapsApiKey` parameter to your application configuration
        // file with the value of your API key. To get yours, please visit https://code.google.com/apis/console/.
        $key = isset($params['googleMapsApiKey']) ? $params['googleMapsApiKey'] : "";;
        // To configure please, add `googleMapsLibraries` parameter to your application configuration.
        // For example "geometry,places"
        $libraries = isset($params['googleMapsLibraries']) ? $params['googleMapsLibraries'] : "";
        // To configure please, add `googleMapsLanguage` parameter to your application configuration
        $language = isset($params['googleMapsLanguage']) ? $params['googleMapsLanguage'] : "";
        $callBack = isset($params['googleMapsCallback']) ? $params['googleMapsCallback'] : "initMaps";

        $this->options = array_merge($this->options, array_filter([
            'key' => $key,
            'libraries' => $libraries,
            'language' => $language,
            'callBack' => $callBack
        ]));
        // BACKWARD COMPATIBILITY

        $this->js[] = 'https://maps.googleapis.com/maps/api/js?' . http_build_query($this->options);
    }
}
