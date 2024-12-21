<?php


namespace Mkrawczyk\Internationalization;


class Translator
{
    public static Translator $default;
    private TextsRepository $repository;
    private LanguagesHierarchy $languageHierarchy;

    public function __construct(TextsRepository $repository, LanguagesHierarchy $languagesHierarchy)
    {
        $this->repository = $repository;
        $this->languageHierarchy = $languagesHierarchy;
    }

    /**
     * @throws I18nNodeNotFoundException
     */
    public function translate(string $q): I18nValue
    {
        $path = explode('.', $q);
        $node = $this->repository->getRootNode();
        foreach ($path as $nodeName) {
            $node = $node->getChild($nodeName);
        }
        return $node->getValue($this->languageHierarchy);
    }
}

Translator::$default = new Translator(LanguagesHierarchy::ReadFromUser());
