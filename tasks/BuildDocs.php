<?php
namespace Lucid\Task;

class BuildDocs extends Task implements TaskInterface
{
    public static $trigger = 'build-docs';

    public function __construct()
    {
        $this->parameters[] = new \Lucid\Task\Parameter('output',  'labeled', true, getcwd().'/docs/documentation.pdf');
        $this->parameters[] = new \Lucid\Task\Parameter('doc-root',  'labeled', true, getcwd().'/docs/');
    }

    public function run()
    {
        include(getcwd().'/vendor/autoload.php');

        $navStructure = include(getcwd().'/docs/navigation.php');
        echo("Loading markdown...\n");
        $markdown = $this->findMarkdown($navStructure);
        echo("Converting markdown to html...\n");
        $Parsedown = new \Parsedown();
        $html = $Parsedown->text($markdown);

        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        #$pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('My Documentation');
        #$pdf->SetSubject('TCPDF Tutorial');
        #$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetFont('helvetica', '', 20);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, 0, true, 0);
        $pdf->lastPage();
        echo("Writing PDF...\n");
        $pdf->Output($this->config['output'], 'F');
        echo("Complete.\n");
    }

    public function findMarkdown($links)
    {
        $markdown = '';
        foreach ($links as $link) {
            $lucidPath = '../vendor/dev-lucid/lucid/docs/';
            $file = $link['file'];
            $file = str_replace('lucid/', $lucidPath, $file);
            $filePath = $this->config['doc-root'].$file.'.md';
            echo("  $filePath...\n");
            $markdown .= file_get_contents($filePath)."\n";
            if (isset($link['children']) === true && count($link['children']) > 0) {
                $markdown .= $this->findMarkdown($link['children']);
            }
        }
        return $markdown;
    }
}

Container::addTask(new BuildDocs());