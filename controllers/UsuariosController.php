<?php

namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class UsuariosController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($idusuarios)
    {
        return $this->render('view', [
            'model' => $this->findModel($idusuarios),
        ]);
    }

    public function actionCreate()
    {
        $model = new Usuarios();

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->avatar_path = 'temp';

            if (!$model->validate()) {
                Yii::$app->session->setFlash('error', $this->getErrorSummary($model));
                return $this->render('create', ['model' => $model]);
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->imageFile) {
                    $uploadDir = Yii::getAlias('@webroot/uploads/avatars/');
                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0775, true);
                    }

                    $fileName = uniqid() . '.' . $model->imageFile->extension;
                    $filePath = $uploadDir . $fileName;

                    if ($model->imageFile->saveAs($filePath)) {
                        $model->avatar_path = '/uploads/avatars/' . $fileName;
                    } else {
                        throw new \Exception('No se pudo guardar la imagen.');
                    }
                }

                if ($model->save(false)) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Usuario creado exitosamente.');
                    return $this->redirect(['view', 'idusuarios' => $model->idusuarios]);
                } else {
                    throw new \Exception('Error al guardar: ' . print_r($model->errors, true));
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                if (isset($filePath) && file_exists($filePath)) {
                    unlink($filePath);
                }
                Yii::$app->session->setFlash('error', $e->getMessage());
                Yii::error($e->getMessage());
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($idusuarios)
    {
        $model = $this->findModel($idusuarios);
        $oldImagePath = $model->avatar_path;

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if (!$model->validate()) {
                Yii::$app->session->setFlash('error', $this->getErrorSummary($model));
                return $this->render('update', ['model' => $model]);
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->imageFile) {
                    $uploadDir = Yii::getAlias('@webroot/uploads/avatars/');
                    $fileName = uniqid() . '.' . $model->imageFile->extension;
                    $filePath = $uploadDir . $fileName;

                    if ($model->imageFile->saveAs($filePath)) {
                        if ($oldImagePath && file_exists(Yii::getAlias('@webroot' . $oldImagePath))) {
                            unlink(Yii::getAlias('@webroot' . $oldImagePath));
                        }
                        $model->avatar_path = '/uploads/avatars/' . $fileName;
                    } else {
                        throw new \Exception('No se pudo guardar la nueva imagen.');
                    }
                }

                if ($model->save(false)) {
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Usuario actualizado exitosamente.');
                    return $this->redirect(['view', 'idusuarios' => $model->idusuarios]);
                } else {
                    throw new \Exception('Error al actualizar: ' . print_r($model->errors, true));
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', $e->getMessage());
                Yii::error($e->getMessage());
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($idusuarios)
    {
        $model = $this->findModel($idusuarios);
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($model->delete()) {
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Usuario eliminado exitosamente.');
            } else {
                throw new \Exception('No se pudo eliminar el usuario.');
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', $e->getMessage());
            Yii::error($e->getMessage());
        }

        return $this->redirect(['index']);
    }

    protected function findModel($idusuarios)
    {
        if (($model = Usuarios::findOne(['idusuarios' => $idusuarios])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El usuario solicitado no existe.');
    }

    private function getErrorSummary($model)
    {
        $errors = [];
        foreach ($model->errors as $attribute => $errorMessages) {
            $label = $model->getAttributeLabel($attribute);
            $errors[] = "$label: " . implode(', ', $errorMessages);
        }
        return implode('<br>', $errors);
    }
}
