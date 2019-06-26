<?php
/**
 * Plugin LimeSurvey Rer Antiphishing
 *
 * @author "Pierluigi Tassi" <pierluigi.tassi@regione.emilia-romagna.it>
 * @license "MIT"
 * @version 0.2.0
 */

use LimeSurvey\PluginManager\PluginBase;

class LsRerAntiphishing extends PluginBase
{

    static protected $name = 'Rer Antiphishing';
    static protected $description = 'Limesurvey plugin hardening against phishing';

    /**
     * Subscribe to Limesurvey Events
     *
     */
    public function init()
    {
//        $this->subscribe('beforeActivate');
        $this->subscribe('beforeEmail');
        $this->subscribe('beforeTokenEmail');
    }

    /**
     * Hooks to Events
     *
     */
    public function beforeActivate()
    {
        if (extension_loaded('dom') == false) {
            $event  = $this->getEvent();
            $event->set('message', 'DOM extension is missing in your PHP configuration. This plugin can\'be activated.');
            $event->set('success', false);
        }
    }

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
        $body = $this->event->get('body');
        $htmlpurifier = new CHtmlPurifier;
        $htmlpurifier->setOptions([
            'Core.EscapeNonASCIICharacters' => true,
            'AutoFormat.DisplayLinkURI' => true,
            'CSS.AllowTricky' => false,
        ]);
        $body = $htmlpurifier->purify($body);

        if (extension_loaded('dom')) {
            libxml_use_internal_errors(true);
            $dom = new DOMDocument;
            $dom->loadHTML($body);
            foreach ($dom->getElementsByTagName('a') as $aElement) {
                if ($aElement->hasAttribute('href') == true) {
                    $aElement->nodeValue = htmlspecialchars($aElement->nodeValue);
                    $sElement = $dom->createElement('span');
                    $sElement->textContent = sprintf('[%s](%s)', $aElement->getAttribute('href'), htmlspecialchars($aElement->nodeValue));
                    $aElement->parentNode->replaceChild($sElement, $aElement);
                }
            }
            $body = $dom->saveHTML();
        }

        $this->event->set('body', $body);
    }

} // end: class
