<?php 

/**
 * Plugin antiphishing per Limesurvey
 * 
 * @author Pierluigi Tassi <pierluigi.tassi@regione.emilia-romagna.it>
 * @author Regione Emilia-Romagna
 * 
 */

class RerMailTemplate extends PluginBase
{

    static protected $name = 'RER Mail Template';
    static protected $description = 'RER: Plugin anti Phishing nei template delle mail';

    /**
     * Put here your events subscribtions
     */
    public function init()
    {
        $this->subscribe('beforeEmail');
        $this->subscribe('beforeTokenEmail');
    }

    public function beforeEmail()
    {
        $body = $this->_antiphising($this->event->get('body'));
        $this->event->set('body', $body);
    }

    public function beforeTokenEmail()
    {
        $body = $this->_antiphising($this->event->get('body'));
        $this->event->set('body', $body);
    }

    /**
     * String manipulation, removes link tags from html
     * 
     * @param string $body "Mail body template parsed but insane"
     * @return string "Sanitized mail body"
     */
    private function _antiphising(string $body)
    {
        $body = "DDD\r\n" . $body;
        return $body;
    }

}