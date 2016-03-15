<?php

namespace DevLucid;

class Controller{{uc(table)}} extends Controller
{
    public function ruleset(): Ruleset
    {
        return new Ruleset([
{{rules}}        ]);
    }

    public function save({{save_parameters}}bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission([]); # add required permissions to this array

        $this->ruleset()->checkParameters(func_get_args());
        $data = lucid::model('{{table}}', ${{id}}, false);

{{save_actions}}        $data->save();

        if ($do_redirect) lucid::redirect('{{table}}-table');
    }

    public function delete(int ${{id}}, bool $do_redirect=true)
    {
        lucid::$security->requireLogin();
        # lucid::$security->requirePermission('delete'); # add required permissions to this array

        lucid::model('{{table}}')->where('{{id}}', ${{id}})->delete_many();
        if ($do_redirect) lucid::redirect('{{table}}-table');
    }
}
