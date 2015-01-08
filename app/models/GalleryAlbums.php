<?php
/**
 * Created by PhpStorm.
 * User: savenkoff
 * Date: 24.10.14
 * Time: 21:22
 */
class GalleryAlbums extends Eloquent {

    protected $table = 'gallery_albums';
    protected $softDelete = true;
    protected $guarded = array(
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    );

    ### Нормализация связей

    public function photos()  {
        return $this->morphMany('GalleryImages', 'ref');
    }

    public function author() {
        return $this->belongsTo('User','user_id');
    }

    public static function getValidAlbAdmAdd() {
        $validation = array(
          'name' => array(
              'required',
              'regex:/^[A-Za-zА-Яа-я]/',
              'min:3'
          ),
          'slug' => array(
              'regex:/^[A-Za-z]/',
              'min:3',
              'unique:gallery_albums'
          ),
            'position' => array(
                'integer'
            )
        );
        return $validation;
    }
    public static function getValidAlbAdmEdit()
    {
        $validation = array(
            'name' => array(
                'required',
                'regex:/^[A-Za-zА-Яа-я]/',
                'min:3'
            ),
            'slug' => array(
                'regex:/^[A-Za-z]/',
                'min:3',
            ),
            'position' => array(
                'integer'
            )
        );
        return $validation;
    }

    public static function mapTree($dataset) {
        $tree = array();
        foreach ($dataset as $id=>&$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            }
            else {
                $dataset[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    public static function view_albums($dataset)
    {
        $result = '';
        foreach ($dataset as $menu) {
            $result.= '<li><a href="'.URL::route('gallery',array(

            )).'">' . $menu["name"] . '</a>';
            if (array_key_exists('childs', $menu)) {
                $result.= '<ul class="submenu">';
                $result.= self::view_albums($menu['childs']);
                $result.= '</ul>';
            }
            $result.= '</li>';
        }
        return $result;
    }

    public static function getMenu($indx_gallery = null) {
        $data = array();
        if (!is_null($indx_gallery)) {
            $albums =  self::select('id','name','parent_id','slug')->remember(30)->orderBy('parent_id','asc')->get()->toArray();
        } else {
            $albums =  self::select('id','name','parent_id','slug')->remember(30)->orderBy('parent_id','asc')->get()->toArray();
        }
        foreach($albums as $value) {
            $data[$value['id']] = $value;
        }
        $data = self::mapTree($data);
        return self::view_albums($data);
    }

    public static function build_tree($albums,$parent_id,$only_parent = false){
        if(is_array($albums) and array_key_exists($parent_id,$albums)){
            $tree = '<ul class="list">';
            if($only_parent==false){
                foreach($albums[$parent_id] as $album){
                    $tree .= '<li><i class="fa fa-picture-o"></i> <a href="'.URL::route('gallery',['album' =>  $album["slug"]]).'">'.$album['name'].'</a>';
                    $tree .=  self::build_tree($albums,$album['id']);
                    $tree .= '</li>';
                }
            }elseif(is_numeric($only_parent)){
                $cat = $albums[$parent_id][$only_parent];
                $tree .= '<li><i class="fa fa-picture-o"></i>'.$albums['name'].' #'.$cat['id'];
                $tree .=  self::build_tree($albums,$albums['id']);
                $tree .= '</li>';
            }
            $tree .= '</ul>';
        }
        else return null;
        return $tree;
    }

    public static function getMenu2($indx_gallery = null) {
        $albums =  self::select('id','name','parent_id','slug')->remember(30)->where('is_system','=',false)->orderBy('parent_id','asc')->get()->toArray();
        foreach($albums as $album) {
            $cats_ID[$album['id']][] = $album;
            $cats[$album['parent_id']][$album['id']] =  $album;
        }
        $data = self::build_tree($cats,$indx_gallery);
        return $data;
    }

    public static function getArrayAlbums($parent_id, $result = null) {
        if (is_null($result)) {
            $result = array();
        }
        $albums = self::where('parent_id','=',$parent_id)->get();
        foreach ($albums as $album) {
            $result[] = $album->id;
            $result = $result + self::getArrayAlbums($album->id,$result);
        }
        return $result;
    }
}