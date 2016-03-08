<?php
# requires parameters: $replace_selector

$alert = html::alert('warning', _('error:permission_denied'));
lucid::$response->replace($replace_selector, $alert->render());
