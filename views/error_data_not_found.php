<?php
# requires parameters: $replace_selector

namespace DevLucid;

$alert = html::alert('warning', __('error:data_not_found'));
lucid::$response->replace($replace_selector, $alert->render());
