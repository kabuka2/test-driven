<?php


namespace app\Interfaces;

interface PageBuilderInterface
{

    /**@return PageBuilderInterface**/
    public function create():PageBuilderInterface;

    /**
     * @param string $title
     * @return PageBuilderInterface
    **/
    public function setTitle(string $title):PageBuilderInterface;

    /**
     * @param string $body
     * @return PageBuilderInterface
     */
    public function setPageTemplate(string $body):PageBuilderInterface;

    /**
     * @param array $styles
     * @return PageBuilderInterface
     */
    public function setStyle(array $styles):PageBuilderInterface;

    /**
     * @param array $scripts
     * @return PageBuilderInterface
     */
    public function setScripts(array $scripts):PageBuilderInterface;

    /**
     * @param array $meta_data
     * @return PageBuilderInterface
    */
    public function setMetaData(array $meta_data):PageBuilderInterface;

    /**
     * @param array $variable
     * @return PageBuilderInterface
     */
    public function setVariable(array $variable):PageBuilderInterface;

    /**@param string $path * */
    public function setLayout(string $path):PageBuilderInterface;

    /**
     * @param string $template_name
     * @return PageBuilderInterface
    **/
    public function setTemplateName(string $template_name):PageBuilderInterface;

    /**
        for update class object
     **/
    public function setDataObject(object $obj):PageBuilderInterface;

    /**
     * @return PageBuilder
     */
    public function buildPage();

    /**
     * @param string $class - template render class name
     * @return PageBuilderInterface
     **/
    public function setTemplateClass(string $class):PageBuilderInterface;

    public function renderPage();



}