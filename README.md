# Limesurvey Antiphishing plugin

[![Catalogo del riuso software](https://img.shields.io/badge/Riuso%20AGID-Software-%230076e3)](https://developers.italia.it/it/pa/r_emiro)

This is a [Limesurvey](https://limesurvey.org) plugin. Using this piece of software, you can convert HTML links into plain text URLs, inside the body of messages sent by Limesurvey Surveys Administrators.

There is no interface or configuration, it acts silently when mails are sent, replacing all links with textual rapresentations.

## Technical info

This Limesurvey plugin leverages Yii framework using `CHTMLPurifier` class. That library is configured for securing non-ascii codes and converting `href` HTML attributes into plain texts URLs.

For additional security, in second instance we run a custom crafted functionality based on _PHP DOM Extension_.

When the survey is configured for sending plain-text mails instead of HTML, the plugin simply skips running.

## Installation

Just checkout this repository inside the `plugins` directory of your Limesurvey installation, or just download it as a zip file, then extract in the same place.

Then login into your Limesurvey administration panel and visit "Plugin Configuration" page to enable.

## Version

More informations on [changelog](CHANGELOG)
