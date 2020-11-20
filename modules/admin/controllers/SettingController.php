<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\Setting;

/**
 * Description of SettingController
 *
 */
class SettingController extends AppAdminController
{
    public function actionView()
    {
        return $this->render('view');
    }
    
    public function actionUpdate()
    {
        $model = new Setting();
        
        if ($model->load(\Yii::$app->request->post())) {
            $model->setSettings();
            return $this->redirect(['view']);
        }
        
        return $this->render('update', compact('model'));
    }
}
