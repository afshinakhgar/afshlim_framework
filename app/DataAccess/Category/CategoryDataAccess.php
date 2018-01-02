<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 12:20 AM
 */

namespace App\DataAccess\Category;


use App\Model\Category;
use Core\Interfaces\_DataAccess;
use PDO;

/**
 * @param CategoryDataAccess
 */

class CategoryDataAccess extends _DataAccess
{

    public static function createByFields(array $fields)
    {
        $category = new Category;
        foreach($fields as $field=>$value){
            $category->$field = $value;
        }

        $category->save();

        return $category;
    }

    public function deleteById(int $id)
    {
        $sql = "DELETE FROM categories WHERE id=:id";
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->rowCount();
    }

    public static function updateFieldById($model,array $fields)
    {
        foreach($fields as $field=>$value){
            $model->$field = $value;
        }
        $category =$model->save();


        return $category;
    }

    public static function get_all_paging(array $fields)
    {
        $category = Category::paginate($_GLOBALS['settings']['paging']['pager'],$fields);

        return $category;
    }


    public static function getOneById(int $id)
    {
        $category = Category::find($id);


        return $category;
    }



    public static function getOneBySlug(string $slug)
    {
        $category = Category::where('slug',$slug)->first();
        return $category;
    }



}