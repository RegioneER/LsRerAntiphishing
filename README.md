# Limesurvey Rer Antiphishing plugin

This [Limesurvey](https://limesurvey.org) plugin removes `<a href=""></a>` formats plain text URIs found inside email templates.

That means all emails sent by your Limesurvey installation can’t be forged as phishing by malicious «Survey Managers»

The plugin acts silently when mails are sent, replacing all links with textual inline rapresentations. 

## Technical info

This Limesurvey plugin leverages Yii framework using `CHTMLPurifier` class, configured for securing non-ascii codes and converting `href` attributes in plain texts.

For additional security, in second instance we run a custom crafted functionality based on *PHP DOM Extension*.

## Installation

Just checkout this repository inside the `plugins` directory.

## Version

More informations on [changelog](CHANGELOG)