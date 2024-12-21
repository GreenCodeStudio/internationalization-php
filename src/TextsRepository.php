<?php


namespace Mkrawczyk\Internationalization;


class TextsRepository
{
    private ?I18nNode $root = null;

    public function getRootNode(): I18nNode
    {
        return $this->root;
    }


    public function loadModuleFile(string $module, string $filename)
    {
        if ($this->root === null) {
            $this->root = new I18nNode();
        }

        $this->root->addChild($module, $this->parseFile($filename));
    }

    public function loadRootFile(string $filename)
    {
        $this->root = $this->parseFile($filename);
    }

    private function parseFile(string $filename)
    {
        $xml = \simplexml_load_string(file_get_contents($filename));
        if ($xml === false) throw new \Exception("Bad i18n.xml file");
        return new I18nNode($xml);
    }
}
