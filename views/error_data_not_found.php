<?php
namespace DevLucid;
lucid::requireParameters('replaceSelector');

$alert = html::alert('warning', _('error:data_not_found'));
lucid::$response->replace($replaceSelector, $alert->render());
