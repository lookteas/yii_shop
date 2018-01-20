<?php

namespace app\modules\controllers;


/**
 * Default controller for the `admin` module
 */
class IndexController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout =  "lay03";
        return $this->render('index');
    }
}
