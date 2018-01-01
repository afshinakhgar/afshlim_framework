<?php

namespace App\Controller\Admin\User;
use App\Controller\Controller;
use App\DataAccess\User\RoleDataAccess;
use App\DataAccess\User\UserDataAccess;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Core\Facades\Image;
use Core\Facades\File;

use Respect\Validation\Validator as v;

class UserController extends Controller
{

    public function index_Action(Request $request, Response $response, $args)
    {
        $list = UserDataAccess::getAllUsers();
        return $this->view->render($response, 'admin.user.index',[
            'list'=>$list
        ]);
    }




    public function get_info_Action(Request $request, Response $response, $args)
    {
        // $user = UserDataAccess::getUserOneByMobile($args['mobile']);
        $user = UserDataAccess::getUserOneByMobile($args['mobile']);
        if(!$user->id){
            $user = UserDataAccess::getUserOneByUsername($args['mobile']);
        }
        if(!$user){
            return '404';
        }

        return $this->view->render($response, 'admin.user.info',[
            'user'=>$user
        ]);
    }



    public function get_edit_Action(Request $request, Response $response, $args)
    {


        $user = UserDataAccess::getUserOneByMobile($args['mobile']);
        if(!$user->id){
            $user = UserDataAccess::getUserOneByUsername($args['mobile']);
        }
        $allRolesList = $this->_getAllRoles();
        $user_roleList = UserDataAccess::getUserRoles($user->id);
        $roleList = '';
        foreach($user_roleList as $roles){
            $roleList .= $roles->id.',';
        }
        $current_roleList = rtrim($roleList,',');
        if(!$user){
            return '404';
        }
        return $this->view->render($response, 'admin.user.edit',[
            'user'=>$user,
            'roles'=>$allRolesList,
            'user_roleList' => $user_roleList,
            'current_roles_id' => $current_roleList
        ]);
    }





    public function get_new_Action(Request $request, Response $response, $args)
    {
        $allRolesList = $this->_getAllRoles();
        return $this->view->render($response, 'admin.user.new',['roles'=>$allRolesList]);
    }



    public function post_store_Action(Request $request, Response $response, $args)
    {
        $params = $request->getParams();
        foreach($params as $key=>$param){
            $fields[$key] = $param;
        }

        unset($fields['roles']);
        $user = UserDataAccess::createUsersByFields($fields);
        $attachedRoles = explode(',', rtrim($params['roles'],','));
        // $attachRolesToUsers = 
        if($attachedRoles){
            $user->roles()->sync($attachedRoles);
            $user->save();
        }

        $uploadedFiles = $request->getUploadedFiles();
        if($uploadedFiles){
             $uploadedFile = $uploadedFiles['file'];
            if($uploadedFile->getSize()){
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                    $directory = $this->settings['app']['image']['dir'].'/temp';
                    if(!is_dir($directory)){
                        @mkdir($directory);
                    }
                    $file = File::moveUploadedFile($directory,$user->id, $uploadedFile);
                    Image::createPhotos($directory.'/'.$file,$user->id);
                    if(file_exists($file)){
                        File::delete($file);
                    }


                }

                if($user->has_pic == 'no'){
                    UserDataAccess::updateuserFieldById($user,['has_pic'=>'yes']);
                }
            }
        }

        $this->flash->addMessage('success','کاربر جدید ایجاد شد');

        return $response->withRedirect(Route('admin.user.edit',['mobile'=>$user->username]));
    }

    public function put_update_Action(Request $request, Response $response, $args)
    {
        $params = $request->getParams();
        $user = UserDataAccess::getUserOneByUsername($params['username']);
        if(!$user->id){
            $user = UserDataAccess::getUserOneByMobile($params['mobile']);
        }


        $validate = $this->validator->validate($request,[
            'username' => v::noWhitespace()->notEmpty()
        ]);

        $params = $request->getParams();

        if ($validate->failed()) {
            $this->flash->addMessage('error','ورودی مشکل دارد');
            $userField = $params['username'] ? $params['username'] : $params['mobile'];
            return $response->withRedirect(Route('admin.user.edit',['mobile'=>$userField]));
        }
        foreach($params as $key=>$param){
            $fields[$key] = $param;
        }
        unset($fields['roles']);

        UserDataAccess::updateuserFieldById($user,$fields);

        $attachedRoles = explode(',', rtrim($params['roles'],','));
        // $attachRolesToUsers = 
        if($attachedRoles){
            $user->roles()->sync($attachedRoles);
            $user->save();
        }

        $uploadedFiles = $request->getUploadedFiles();
        if($uploadedFiles){
             $uploadedFile = $uploadedFiles['file'];
            if($uploadedFile->getSize()){
                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                    $directory = $this->settings['app']['image']['dir'].'/temp';
                    if(!is_dir($directory)){
                        @mkdir($directory);
                    }
                    $file = File::moveUploadedFile($directory,$user->id, $uploadedFile);
                    Image::createPhotos($file,$user->id);
                    if(file_exists($file)){
                        File::delete($file);
                    }




                }

                if($user->has_pic == 'no'){
                    UserDataAccess::updateuserFieldById($user,['has_pic'=>'yes']);
                }
            }
        }
        

        $this->flash->addMessage('success','کاربر ویرایش شد');
        $userField = $params['username'] ? $params['username'] : $params['mobile'];
        return $response->withRedirect(Route('admin.user.edit',['mobile'=>$userField]));
    }



    public function get_userrole(Request $request, Response $response, $args)
    {
        $userid = (int)$args['userid'];
        $user_roleList = [];
        $user = UserDataAccess::getUserById($userid);
        $user_roleList = UserDataAccess::getUserRoles($userid);

      
        $allRolesList = $this->_getAllRoles();
        return $this->view->render($response, 'admin.user.userrole_form',[
            'user'=>$user,
            'user_roleList'=>$user_roleList,
            'all_roles'=>$allRolesList,
        ]);
    }


    private function _getAllRoles()
    {
        $all_roles = RoleDataAccess::listAllRoles();
        foreach($all_roles as $role){
            $allRolesList[$role->id] = $role->display_name;
        }

        return $allRolesList;
    }


    public function post_userrole(Request $request, Response $response, $args)
    {
        $list = UserDataAccess::getAllUsers();
        return $this->view->render($response, 'admin.user.index',[
            'list'=>$list
        ]);
    }
}