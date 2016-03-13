<?php
# requires parameters: $replace_selector

$alert = html::alert('warning', __('error:login_required'));
lucid::$response->replace($replace_selector, $alert->render());
