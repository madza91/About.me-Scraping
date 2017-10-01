<?php
/**
 * Created by PhpStorm.
 * User: Nemanja
 * Date: 27.09.2017
 * Time: 23:05
 */

/**
 * This is very simple template engine
 * By default it loads template from: templates/{template_name}/index.php
 * Class Template
 */
class Template
{
    protected $file;
    protected $values = array();
    protected $reserved = array('title', 'file', 'template');

    /**
     * Template constructor.
     * @param $template
     * @param array $variables
     */
    public function __construct($template, array $variables = [])
    {
        $this->file = dirname(dirname(__FILE__)) . "/templates/{$template}/index.php";
        $this->title = 'About.me - By Madza';
        $this->template = $template;

        if (count($variables)) {
            foreach ($variables as $key => $variable) {
                if (!in_array($key, $this->reserved))
                    $this->$key = $variable;
            }
        }
    }

    /**
     * Set variables
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->values[$key];
    }

    /**
     * Prepare template file with variables
     * @return string
     */
    public function __toString()
    {
        extract($this->values);
        @chdir(dirname($this->file));
        ob_start();

        if (!file_exists($this->file)) {
            return "Error loading template file ($this->file).";
        }

        include($this->file);

        return ob_get_clean();
    }

}
