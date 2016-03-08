<?php
# requires parameters: $replace_selector

$alert = html::alert('warning', _('error:login_required'));
lucid::$response->replace($replace_selector, $alert->render());
