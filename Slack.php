<?php

namespace ambikuk\yiislack;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use Maknz\Slack\Client;

/**
 * @property string $url
 * @property string $username
 * @property string $channel
 * @property array $setting
 */

class Slack extends Component 
{
    public $url;
    public $username;
    public $channel;
    private $setting;

    public function init() 
    {
        
        if (!$this->url) {
            throw new InvalidConfigException('\$url cannot be empty.');
        }
        
        if (!$this->username) {
            throw new InvalidConfigException('\$username cannot be empty.');
        }
        
        $this->setting = [
            'username' => $this->username,
            'link_names' => true
        ];
        
        if (!empty($this->channel)) {
            $this->setting['channel'] = $this->channel;
        }

        parent::init();
    }
    
    /**
     * @return \Maknz\Slack\Client
     */
    
    public function getClient()
    {
        return new Client($this->url, $this->setting);
    }
    
    /**
     * @param array $settings
     * @return Slack
     */
    
    public function setSetting($settings = []) {
        $this->setting = array_merge($this->setting, $settings);
        return $this;
    }
    
    public function send($message, $attach = []) {
        $client = $this->getClient();
        if ($attach) {
            $client = $this->getClient()->attach($attach);
        }
        $client->send($message);
    }
    
}