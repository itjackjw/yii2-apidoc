<?php


namespace itjack\apidoc;

use itjack\apidoc\Api\library\Builder;
use yii\console\Controller;
use yii\console\Exception;
use Yii;


class ApiController extends Controller
{

    public $force = false;

    public $url = "";

    public $apimodule = "api";

    public $output = "api.html";

    public $title = "测试demo";

    public $author = "作者";

    public $class = null;

    public $language = "zh-cn";

    public function options($actionID)
    {
        return ['force', 'url', 'apimodule', 'output', 'title', 'author', 'class', 'language'];
    }

    public function optionAliases()
    {
        return ['l' => 'language', 'c' => 'class', 'url' => 'url', 'm' => 'apimodule', 'o' => 'output', 'f' => 'force', 't' => "title", 'a' => 'author'];
    }

    /**获取某一个模块的api 文档
     * @throws Exception
     */
    public function actionIndex()
    {
        $apiDir = __DIR__ . DIRECTORY_SEPARATOR . 'Api' . DIRECTORY_SEPARATOR;
        $force = $this->force;
        $url = $this->url;
        $language = $this->language;
        $language = $language ? $language : 'zh-cn';
        $langFile = $apiDir . 'lang' . DIRECTORY_SEPARATOR . $language . '.php';
        if (!is_file($langFile)) {
            throw new Exception('language file not found');
        }
        $lang = include_once $langFile;

        $output_dir = Yii::getAlias("@app") . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR;
        $output_file = $output_dir . $this->output;
        if (is_file($output_file) && !$force) {
            throw new Exception("api index file already exists!\nIf you need to rebuild again, use the parameter --force=true ");
        }
        // 额外的类
        $classes = $this->class;
        // 标题
        $title = $this->title;
        // 作者
        $author = $this->author;
        // 模块
        $module = $this->apimodule;

        $moduleDir = Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR;

        if (!is_dir($moduleDir)) {
            throw new Exception('module not found');
        }

        if (version_compare(PHP_VERSION, '7.0.0', '<')) {
            throw new Exception("php版本必须大于7.0.0");
        }

        $controllerDir = $moduleDir . "constrollers" . DIRECTORY_SEPARATOR;
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($controllerDir), \RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
            if (!$file->isDir() && $file->getExtension() == 'php') {
                $filePath = $file->getRealPath();
                $classes[] = $this->get_class_from_file($filePath);
            }
        }
        $classes = array_unique(array_filter($classes));
        $config = [
            'title' => $title,
            'author' => $author,
            'description' => '',
            'apiurl' => $url,
            'language' => $language,
        ];

        $builder = new Builder($classes);
        $content = $builder->render(['config' => $config, 'lang' => $lang]);

        if (!file_put_contents($output_file, $content)) {
            throw new Exception('Cannot save the content to ' . $output_file);
        }
        echo "Build Successed!";
    }


    /** 获取所有的api 文档
     * @throws Exception
     */
    public function actionAll()
    {
        $apiDir = __DIR__ . DIRECTORY_SEPARATOR . 'Api' . DIRECTORY_SEPARATOR;
        $language = $this->language;
        $language = $language ? $language : 'zh-cn';
        $langFile = $apiDir . 'lang' . DIRECTORY_SEPARATOR . $language . '.php';
        if (!is_file($langFile)) {
            throw new Exception('language file not found');
        }
        $lang = include_once $langFile;
        $apipath = Yii::$app->params['api'];
        foreach ($apipath as $item) {
            $this->outputFile($item, $language, $lang);
        }
        echo "Build Successed!";
    }


    /**
     * 生成所有的api 文件
     */
    protected function outputFile($outapi = array(), $language, $lang)
    {

        if (!empty($outapi) && !empty($outapi['apimodule']) && !empty($outapi['author']) && !empty($outapi['title']) && !empty($outapi['output'])) {

            $output_dir = Yii::getAlias("@app") . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR;
            $output_file = $output_dir . $outapi['output'];

            // 额外的类
            $classes = null;
            // 标题
            $title = $outapi['title'];
            // 作者
            $author = $outapi['author'];
            // 模块
            $module = $outapi['apimodule'];

            $moduleDir = Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR;

            if (is_dir($moduleDir) && version_compare(PHP_VERSION, '7.0.0', '>')) {
                $controllerDir = $moduleDir . "constrollers" . DIRECTORY_SEPARATOR;
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($controllerDir), \RecursiveIteratorIterator::LEAVES_ONLY
                );
                foreach ($files as $name => $file) {
                    if (!$file->isDir() && $file->getExtension() == 'php') {
                        $filePath = $file->getRealPath();
                        $classes[] = $this->get_class_from_file($filePath);
                    }
                }


                $classes = array_unique(array_filter($classes));
                $config = [
                    'title' => $title,
                    'author' => $author,
                    'description' => '',
                    'apiurl' => "",
                    'language' => $language,
                ];
                $builder = new Builder($classes);
                $content = $builder->render(['config' => $config, 'lang' => $lang]);

                if (!file_put_contents($output_file, $content)) {
                    //throw new Exception('Cannot save the content to ' . $output_file);
                }else{

                }
            }
        }
    }


    protected function get_class_from_file($path_to_file)
    {
        //Grab the contents of the file
        $contents = file_get_contents($path_to_file);

        //Start with a blank namespace and class
        $namespace = $class = "";

        //Set helper values to know that we have found the namespace/class token and need to collect the string values after them
        $getting_namespace = $getting_class = false;

        //Go through each token and evaluate it as necessary
        foreach (token_get_all($contents) as $token) {

            //If this token is the namespace declaring, then flag that the next tokens will be the namespace name
            if (is_array($token) && $token[0] == T_NAMESPACE) {
                $getting_namespace = true;
            }

            //If this token is the class declaring, then flag that the next tokens will be the class name
            if (is_array($token) && $token[0] == T_CLASS) {
                $getting_class = true;
            }

            //While we're grabbing the namespace name...
            if ($getting_namespace === true) {

                //If the token is a string or the namespace separator...
                if (is_array($token) && in_array($token[0], [T_STRING, T_NS_SEPARATOR])) {

                    //Append the token's value to the name of the namespace
                    $namespace .= $token[1];
                } else if ($token === ';') {

                    //If the token is the semicolon, then we're done with the namespace declaration
                    $getting_namespace = false;
                }
            }

            //While we're grabbing the class name...
            if ($getting_class === true) {

                //If the token is a string, it's the name of the class
                if (is_array($token) && $token[0] == T_STRING) {

                    //Store the token's value as the class name
                    $class = $token[1];

                    //Got what we need, stope here
                    break;
                }
            }
        }

        //Build the fully-qualified class name and return it
        return $namespace ? $namespace . '\\' . $class : $class;
    }

}