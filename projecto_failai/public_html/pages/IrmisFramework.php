<?php

namespace IrmisPage;

use Exception;

class IrmisFramework {
    public function view($templateName, $data) {
        $templateContent = file_get_contents($templateName.'.html');

        if (!$templateContent) {
            throw new Exception('Template not found');
        }

        foreach ($data as $key => $value) {
            $value = gettype($value) === 'array' ? join('', $value) : $value ;
            $templateContent = str_replace("{{".$key."}}", $value, $templateContent);
        }

        if (isset($_GET['debug'])) {
            return '<div template-name="'.$templateName.'">'.$templateContent.'</div>';

        }
        return $templateContent;
    }

// many
    public function viewMany($tempalteName, $list) {
        $i = 0;
        $result = [];

        foreach ($list as $key => $value) {
            $value['$i'] = $i;
            $value['$index'] = $i + 1;
            $value['$key'] = $key;
            $i++;
            $result[] = $this->view($tempalteName, $value);
        }

        return $result;
    }

    public function init() {
        try {
            $data = $this->render();
            $html = $this->view($this->template, $data);

//            $css = file_get_contents($this->template.'.css');

            echo $this->view('tpls/layout', ["body" => $html]);

        } catch (Exception $e) {
            echo $this->view('tpls/layout', ["body" => "Page not found"]);
        }
    }
}