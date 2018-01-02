<?php

namespace App\Controller\Admin\Category;
use App\Controller\Controller;
use App\DataAccess\Category\CategoryDataAccess;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use Core\Facades\Image;
use Core\Facades\File;
use Respect\Validation\Validator as v;
use PhpSlugger\PhpSlugger;


class CategoryController extends Controller
{

    public function get_index_Action(Request $request, Response $response, $args)
    {

    	$categories = CategoryDataAccess::get_all_paging(['*']);
        return $this->view->render($response, 'admin.category.index',['list'=>$categories]);
    }


    public function get_create_Action(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'admin.category.new');
    }


    public function post_create_Action(Request $request, Response $response, $args)
    {


		$phpSlugger = new PhpSlugger();

		try{
			$params = $request->getParams();
			$slug =  $phpSlugger->slugit($params['title']); // delta-euro-dollor-l-i-am-a-web-developer
			$params['slug'] = $slug ;
	        $uploadedFiles = $request->getUploadedFiles();

	        $validate = $this->validator->validate($request,[
	            'title' => v::notEmpty()
	        ]);

	        if ($validate->failed()) {
	            $this->flash->addMessage('error','ورودی مشکل دارد');
	        	return $response->withRedirect(Route('admin.category.create'));
	        }
            if (CategoryDataAccess::getOneBySlug($params['slug'])) {
                $this->flash->addMessage('error','عنوان تکراری است');
                return $response->withRedirect(Route('admin.category.create'));
            }
	        $category = CategoryDataAccess::createByFields($params);

	        if($uploadedFiles){
	             $uploadedFile = $uploadedFiles['file'];
	            if($uploadedFile->getSize()){
	                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
	                    $directory = $this->settings['app']['image']['dir'].'/temp';
	                    if(!is_dir($directory)){
	                        @mkdir($directory);
	                    }
	                    $file = File::moveUploadedFile($directory,$category->id, $uploadedFile);
	                    Image::createPhotos($file,$category->id,'category_photo');
	                    if(file_exists($file)){
	                        File::delete($file);
	                    }

	                }

	                if($category->has_pic == 'no'){
	                    CategoryDataAccess::updateFieldById($category,['has_pic'=>'yes']);
	                }
	            }
	        }

	        $this->flash->addMessage('success','طبقه جدید ایجاد شد');

	        return $response->withRedirect(Route('admin.category.edit',['id'=>$category->id]));
		} catch (Exception $e){

		}



        return $this->view->render($response, 'admin.category.new');
    }


    public function get_edit_Action(Request $request, Response $response, $args)
    {
        $category = CategoryDataAccess::getOneById((int)$args['id']);
        return $this->view->render($response, 'admin.category.edit',['category'=>$category]);
    }



    public function post_update_Action(Request $request, Response $response, $args)
    {
        $category = CategoryDataAccess::getOneById((int)$args['id']);

		try{
			$params = $request->getParams();
	        $uploadedFiles = $request->getUploadedFiles();

	        $validate = $this->validator->validate($request,[
	            'title' => v::notEmpty()
	        ]);

	        $params = $request->getParams();

	        if ($validate->failed()) {
	            $this->flash->addMessage('error','ورودی مشکل دارد');
	        	return $response->withRedirect(Route('admin.category.edit',['id'=>$category->id]));
	        }

            $fields = [
                'title' => $params['title'],
                'body'  => $params['body'],
            ];
            $phpSlugger = new PhpSlugger();

            $slug =  $phpSlugger->slugit($params['title']); // delta-euro-dollor-l-i-am-a-web-developer
            $fields['slug'] = $slug ;

            CategoryDataAccess::updateFieldById($category, $fields);
	        if($uploadedFiles){
	             $uploadedFile = $uploadedFiles['file'];
	            if($uploadedFile->getSize()){
	                if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
	                    $directory = $this->settings['app']['image']['dir'].'/temp';
	                    if(!is_dir($directory)){
	                        @mkdir($directory);
	                    }

	                    $file = File::moveUploadedFile($directory,$category->id, $uploadedFile);

                        Image::createPhotos($file,$category->id,'category_photo');
	                    if(file_exists($file)){
	                        File::delete($file);
	                    }
	                }
	                if($category->has_pic == 'no'){
	                    CategoryDataAccess::updateFieldById($category,['has_pic'=>'yes']);
	                }
	            }
	        }

	        $this->flash->addMessage('success','طبقه جدید ایجاد شد');

	        return $response->withRedirect(Route('admin.category.edit',['id'=>$category->id]));
		} catch (Exception $e){

		}

    }

    public function get_delete_Action(Request $request, Response $response, $args)
    {
        $category = $this->CategoryDataAccess->deleteById((int)$args['id']);
        $this->flash->addMessage('success','حذف طبقه');
        return $response->withRedirect(Route('admin.category.list'));
    }



}