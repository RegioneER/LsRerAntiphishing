<?php

function antiphishing($body)
{
    libxml_use_internal_errors(true);
    $dom = new DOMDocument;
    $htmlpurifier = new HTMLPurifier;
    $body = $htmlpurifier->purify($body);
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

    return $body;
}

$input = <<<MAILBODY
<h1>titolone</h1>
<p>
Lorem <a href="https://google.com">gugol <a href="ftps://phish.sh">miao</a> ciao </a> dolor sit amet, 
consectetur adipisicing elit. Amet dicta dolores dolorum eos 
excepturi in, <em><a name="aa"><strong>asasaasas </strong>incidunt</a></em> inventore laboriosam natus nisi porro, 
quam quisquam reiciendis, <strong><em><a href="http://sit.it">sit</em> soluta</a></strong> temporibus totam vero voluptatibus!
</p>
MAILBODY;

echo antiphishing($input);

echo '<pre>';
echo htmlentities($input);