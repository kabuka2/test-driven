<?php


namespace app\template;
use app\traits\TemplateTrait;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use app\interfaces\TemplateInterface;
use app\App;

class TemplateTwig implements TemplateInterface
{
    const TEMPLATE_EXTENSION = 'twig';

    use TemplateTrait;
    protected object $twig_object;

    public function __construct(object $obj)
    {
        $this->_initTwig();
        $this->setTitle($obj->title ?? '');
        $this->setTemplateName($obj->template_name);
        $this->setVariable($obj->variable);
    }


    private function _initTwig():void
    {

        $config = App::getConfig()->getConfigToPath('view/'.self::class);
        $twig_load_file_system = new FilesystemLoader(App::getConfig()->getPathView());
        $this->twig_object =  new Environment($twig_load_file_system,
            [
                'cache'           => $config['cache'],
                'auto_reload'     => $config['auto_reload'],
                'strict_variables'=> $config['strict_variables'],
                'debug'           => $config['debug'],
                'charset'         => $config['charset'],
                'autoescape'      => $config['autoescape'],
                'optimizations'   => $config['optimizations'],
            ]
        );
    }

    public function render(): void
    {
        $this->_checkLayoutsFile();
        $this->_checkTemplatePath();
        $this->setStyle(App::getConfig()->getAvailableResources('css'));
        $this->setScript(App::getConfig()->getAvailableResources('js'));
        echo $this->twig_object->render($this->page,
            array_merge(
                $this->variable,
                [
                    'style' => $this->style,
                    'script' => $this->scripts,
                    'title' => $this->title,
                    'layout' => $this->layout,
                ]
            )
        );
    }

    public function renderAjaxPage(): void
    {
        // TODO: Implement renderAjaxPage() method.
    }



}
