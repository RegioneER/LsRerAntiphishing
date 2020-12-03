# Limesurvey Antiphishing plugin

[![Catalogo del riuso software](https://img.shields.io/badge/Riuso%20AGID-Software-%230076e3)](https://developers.italia.it/it/pa/r_emiro)

This [Limesurvey](https://limesurvey.org) plugin `<a href=""></a>` links from HTML mails sent by survey admins. Then formats URIs in plain-text.

This plugin has no interface, acts silently when mails are sent, replacing all links with textual inline rapresentations.

## Technical info

This Limesurvey plugin leverages Yii framework using `CHTMLPurifier` class, configured for securing non-ascii codes and converting `href` attributes in plain texts.

For additional security, in second instance we run a custom crafted functionality based on _PHP DOM Extension_.

When the survey is not configured for HTML mails, the plugin simply doesn't run.

## Installation

Just checkout this repository inside the `plugins` directory or download it as a zip file, then extract.

Login into your Limesurvey administration panel and visit "Plugin Configuration" page and enable the plugin.

## Version

More informations on [changelog](CHANGELOG)
