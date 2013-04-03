<?php

class RequestController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $menu2;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','barChart','returnJson'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Request;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Request']))
		{
			$model->attributes=$_POST['Request'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Request']))
		{
			$model->attributes=$_POST['Request'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Request');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Request('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Request']))
			$model->attributes=$_GET['Request'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Request the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Request::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Request $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='request-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionBarChart()
	{
		$model=new Request;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Request']))
		{
			$model->attributes=$_POST['Request'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('barChart',array(
			'model'=>$model,
		));
	}
        
        public function actionReturnJson()
        {
            if (Yii::app()->request->isAjaxRequest) {
                
                //get open_time parameter from
                $par_open_time_from = isset($_POST['open_time_from']) ? $_POST['open_time_from'] : "";
                $par_open_time_from = Yii::app()->Globals->convertDate($par_open_time_from);                
                $par_open_time_from == " " ? "1900-01-01" : $par_open_time_from;
                
                //get open_time parameter to
                $par_open_time_to = isset($_POST['open_time_to']) ? $_POST['open_time_to'] : "";
                $par_open_time_to = Yii::app()->Globals->convertDate($par_open_time_to);
                $par_open_time_to == " " ? "2030-12-31" : $par_open_time_to;
                
                //get all filters JSON and parse it
                $par_filters_JSON = isset($_POST['filters_array']) ? $_POST['filters_array'] : "";
                
                
                $par_type_id = Yii::app()->Globals->parseParameters($par_filters_JSON);
                //$par_type_id = " AND type_id IN(3)";
                //$par_type_id = "";
                
                
                $requests = Request::model()->findAll(
                            array(
                                'select'=>array("count(id) as id","Date(open_time) as open_time"),
                                'group'=>'Date(open_time)',
                                'condition'=>"open_time>='$par_open_time_from' AND open_time<='$par_open_time_to' $par_type_id "
                            )
                        );
                
                $result = array();
                    foreach($requests as $request){
                        $date = new DateTime($request->open_time);
                        $open_day = $date->format('d-m-y');
                        $result[] = array(
                            //'openTime' => $request->open_time,
                            'id' => $request->id,
                            'open_time' => $open_day//$request->open_time,
                    );


                }
            
                echo CJSON::encode($result);
            
            }
        }
        
        public function getReqType()
        {
            $requests = Request::model()->findAll(
                        array(
                            'group'=>"t.type_id"
                        )
                    );
            
            $result  = array();
            
            foreach ($requests as $request)
            {
                $result[] = array(
                    'filterGroupName'=>"reqType",
                    //'fk_field'=>substr($requests->group, 3),
                    'itemId'=>$request->type->id,
                    'label'=>$request->type->name
                        
                );
            }
            
            return $result;
        }
        
        public function getFilterValues($fk_field,$model_name)
        {
           $requests = Request::model()->findAll(
                        array(
                            'group'=>"t.$fk_field"
                        )
                    );
            
            $result  = array();
            
            foreach ($requests as $request)
            {
                $result[] = array(
                    'filterGroupName'=>$model_name,
                    'itemId'=>$request->$model_name->id,
                    'fk_field'=>$fk_field,
                    'label'=>$request->$model_name->name
                        
                );
            }
            
            return $result; 
        }
        
        
}
