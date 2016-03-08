<?php
# requires parameters: $replace_selector

$alert = html::alert('warning', _('error:data_not_found'));
lucid::$response->replace($replace_selector, $alert->render());
