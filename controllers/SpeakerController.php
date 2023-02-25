<?php 

namespace Controllers;

use Classes\Pagination;
use MVC\Router;
use Models\Speaker;
use Intervention\Image\ImageManagerStatic as Image;

class SpeakerController{
    public static function index(Router $router){
        session_start();
        isAdmin();
        isLogin();

        $current_page = $_GET['page'];
        $current_page = filter_var($current_page, FILTER_VALIDATE_INT);

        if(!$current_page || $current_page < 1){header('Location: /admin/speakers?page=1');}

        $records_per_page = 5;
        $total_records = Speaker::count();          

        $pagination = new Pagination($current_page,$records_per_page,$total_records);

        if($pagination->total_page() < $current_page){header('Location: /admin/speakers?page=1');}

        $speakers = Speaker::page($records_per_page, $pagination->offset());

        // Render a la vista 
        $router->render('admin/speakers/index', [
            'title' => 'Ponentes / Conferencistas',
            'speakers' => $speakers,
            'pagination' => $pagination->pagination()
        ]);
    }

    public static function create(Router $router){
        session_start();
        isAdmin();
        isLogin();
        $alerts = [];
        $speaker = new Speaker;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
            isAdmin();
            isLogin();
            //leer imagen
            if(!empty($_FILES['image']['tmp_name'])){
                $image_folder = '../public/img/speakers';

                //crear la carpeta si no existe
                if(!is_dir($image_folder)){
                    mkdir($image_folder, 0777, true);
                }

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(800,800)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $image_name = md5(uniqid(rand(),true));

                $_POST['image'] = $image_name;
            }
                
            foreach($_POST['network'] as $key => $value){
                if($value === ''){
                    unset($_POST['network'][$key]);
                }
            }

            $_POST['network'] = json_encode($_POST['network'], JSON_UNESCAPED_SLASHES);

            $speaker->synchronize($_POST);
            $alerts = $speaker->validate();
            
            //guardar registro
            if(empty($alerts)){
                //guardar imagenes
                $image_png->save($image_folder. '/' . $image_name . '.png');
                $image_webp->save($image_folder. '/' . $image_name . '.webp');

                $result = $speaker->save($speaker->speakerId); 

                if($result){
                    header('Location: /admin/speakers');
                }
            }
        }

        // Render a la vista 
        $router->render('admin/speakers/create', [
            'title' => 'Ponentes / Conferencistas',
            'alerts' => $alerts,
            'speaker' => $speaker,
            'network' => json_decode($speaker->network)
        ]);
    }

    public static function update(Router $router){
        session_start();
        isAdmin();
        isLogin();
        $alerts = [];

        if(empty($_GET['id'])){header('Location: /admin/speakers');}

        $speakerId = $_GET['id'];
        $speakerId = filter_var($speakerId, FILTER_VALIDATE_INT);

        if(!$speakerId){header('Location: /admin/speakers');}

        $speaker = Speaker::find($speakerId);

        if(!$speaker){header('Location: /admin/speakers');}

        $speaker->current_image = $speaker->image;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            isAdmin();
            isLogin();
            if(!empty($_FILES['image']['tmp_name'])){
                $image_folder = '../public/img/speakers';

                //crear la carpeta si no existe
                if(!is_dir($image_folder)){
                    mkdir($image_folder, 0777, true);
                }

                $image_png = Image::make($_FILES['image']['tmp_name'])->fit(800,800)->encode('png', 80);
                $image_webp = Image::make($_FILES['image']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $image_name = md5(uniqid(rand(),true));

                $_POST['image'] = $image_name;
            }else{
                $_POST['image'] = $speaker->current_image;
            }

            foreach($_POST['network'] as $key => $value){
                if($value === ''){
                    unset($_POST['network'][$key]);
                }
            }

            $_POST['network'] = json_encode($_POST['network'], JSON_UNESCAPED_SLASHES);

            $speaker->synchronize($_POST);
            $alerts = $speaker->validate();

            if(empty($alerts)){
                if(isset($image_name)){
                    $image_png->save($image_folder. '/' . $image_name . '.png');
                    $image_webp->save($image_folder. '/' . $image_name . '.webp');
                }

                $result = $speaker->save($speaker->speakerId); 

                if($result){
                    header('Location: /admin/speakers');
                }
            }
        }

        // Render a la vista 
        $router->render('admin/speakers/update', [
            'title' => 'Editar Ponentes',
            'alerts' => $alerts,
            'speaker' => $speaker,
            'network' => json_decode($speaker->network)
        ]);
    }

    public static function delete(){
        session_start();
        isAdmin();
        isLogin();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            isAdmin();
            isLogin();
            $speakerId = $_POST['speakerId'];
            $speaker = Speaker::find($speakerId);

            if(!isset($speaker)){header('Location: /admin/speakers');}

            $result = $speaker->delete($speaker->speakerId);

            if($result){
                header('Location: /admin/speakers');
            }
        }
    }    
}