<?php
namespace app\commands;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll(); //удаляем старые данные
        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);
        
        $crudCategories = $auth->createPermission('crudCategories');
        $crudCategories->description = 'crud Categories';
        $auth->add($crudCategories);
        
        $crudProducts = $auth->createPermission('crudProducts');
        $crudProducts->description = 'crud Products';
        $auth->add($crudProducts);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';   
        $auth->add($updatePost);
        
        //Создадим для примера права для доступа к админке
        $dashboard = $auth->createPermission('dashboard');
        $dashboard->description = 'Админ панель';
        $auth->add($dashboard);

        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $crudCategories);
        $auth->addChild($admin, $crudProducts);
        $auth->addChild($admin, $dashboard);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($author, 101);
        $auth->assign($admin, 100);
    }
}