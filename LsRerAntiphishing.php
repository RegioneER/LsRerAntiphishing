<?php

class LsRerAntiphishing extends \LimeSurvey\PluginManager\PluginBase
{

    static protected $name = 'Rer: Antiphishing';
    static protected $description = 'Limesurvey plugin hardening against phishing';

    /**
     * Subscribe to Limesurvey Events
     *
     */
    public function init()
    {
        $this->subscribe('beforeEmail');
        $this->subscribe('beforeTokenEmail');
    }

    /**
     * Hooks to Events
     *
     */
    public function beforeEmail()
    {
        $this->_antiphishing();
    }

    public function beforeTokenEmail()
    {
        $this->_antiphishing();
    }

    /**
     * The real thing
     *
     */
    private function _antiphishing()
    {

        $sBody = $this->event->get('body');

        // Running HtmlPurifier only in case of htmlemail setting On
        if ('Y' == Survey::model()->find('sid='.$this->event->get('survey'))->htmlemail) 
        {
            $oPurifier = new \CHtmlPurifier();
            $oPurifier->setOptions([
                'Core.EscapeNonASCIICharacters' => true,
                'AutoFormat.DisplayLinkURI' => true,
                'CSS.AllowTricky' => false,
            ]);
            $sBody = $oPurifier->purify($sBody);
            $sBody = preg_replace('%<a>https?:\/\/.*<\/a>%', '',$sBody);
            $this->log($sBody, 'debug');
            $this->event->set('body', $sBody);    
        }
    }


    /**
     * @inheritdoc
     * Adding message to vardump if user activate debug mode
     * Use default plugin log too
     */
    public function log($message, $level = \CLogger::LEVEL_TRACE)
    {
        if(is_callable("parent::log")) {
            parent::log($message, $level);
        }
        Yii::log("[".get_class($this)."] ".$message, $level, 'vardump');
    }

} // end: class
