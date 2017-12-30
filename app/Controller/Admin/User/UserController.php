<?php

namespace App\Controller\Admin\User;
use App\Controller\Controller;
use App\DataAccess\User\RoleDataAccess;
use App\DataAccess\User\UserDataAccess;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Core\Services\File;
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
        $user = UserDataAccess::getUserOneByMobile($args['mobile']);

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
                    $directory = $this->settings['image']['dir'].'/user';
                    if(!is_dir($directory)){
                        @mkdir($directory);
                    }
                    $file = File::moveUploadedFile($directory,$user->id, $uploadedFile);
                }

                if($user->has_pic == 'no'){
                    UserDataAccess::updateuserFieldById($user,['has_pic'=>'yes']);
                }
            }
        }

        $this->flash->addMessage('success','کاربر جدید ایجاد شد');

        return $response->withRedirect(Route('admin.user.edit',['mobile'=>$user->mobile]));
    }

    public function put_update_Action(Request $request, Response $response, $args)
    {
        $params = $request->getParams();
        $user = UserDataAccess::getUserOneByMobile($params['mobile']);

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
                    $directory = $this->settings['image']['dir'].'/user';
                    if(!is_dir($directory)){
                        @mkdir($directory);
                    }
                    $file = File::moveUploadedFile($directory,$user->id, $uploadedFile);
                }

                if($user->has_pic == 'no'){
                    UserDataAccess::updateuserFieldById($user,['has_pic'=>'yes']);
                }
            }
        }
        

        $this->flash->addMessage('success','کاربر ویرایش شد');


        return $response->withRedirect(Route('admin.user.edit',['mobile'=>$params['mobile']]));
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