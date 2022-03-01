<?php 

session_start();


const BASE_URL = "http://localhost/project_veblog/veblog/";

function dd($dd){
      die('<pre>' .var_export($dd,true) .'</pre>');
}


function  assets($url){
      return BASE_URL ."asset/" .$url;

}

function get_excerpt($content,$count =200){
      return substr($content,0,$count)."...";
}

function get_data($data_file){
      $file_address = './database/'.$data_file.'.json';
      $file = fopen($file_address,"r+");
      $database = fread($file,filesize($file_address));
      fclose($file);

      return json_decode($database,true);
} 

function set_data($data_file,$new_data){
      $new_data = json_encode($new_data);

      $address  = './database/'.$data_file.".json";
      $open_file =  fopen($address,"w+");
      $new_database = fwrite($open_file,$new_data);
      fclose($open_file);
      return true;
}


function get_post_orderby_viwe($post){
     
      uasort($post,function($first,$second){

              if($first['view'] > $second['view']){
                    return -1;
              }else{
                    return  1;
              }
      });
      
   $post = array_values($post);
   return  count($post)? $post  : null ;
}


function get_post_orderby_date($post){
      uasort($post,function ($first ,$second){
            if(strtotime($first['date']) > strtotime($second['date'])){
                  return -1;
            }else{
                  return 1 ;
            }
      });


   $post = array_values($post);
   return  count($post)? $post : null ;


}

function redirect($path){
      header("location: $path");
      exit();
}


function get_post_by_id($post_dbs,$id){
      $post = array_filter($post_dbs,function($post) use($id){
            if($post['id'] == $id){
                  return true ;
            }else{
                  return false;
            }
      });

      $post = array_values($post);
      return count($post)? $post[0] : null ;
}

function get_last_post($posts){
       uasort($posts, function($first,$secend){
            if ($first['id'] > $secend['id'] ){
                  return -1;
            }else{
                  return 1;
            }
      });

      $posts = array_values($posts);
      return $posts[0] ;
}



function get_post_by_words($post_dbs,$search){
      $search = trim($search);
    $post =  array_filter($post_dbs,function($post) use($search){
          if (strpos($post['title'],$search) !==false || strpos($post['content'],$search)!== false){
                return true;

          }else{
                return false ;
          }


         

      });
      $post = array_values($post);
      return count($post)? $post : null ;
}

function  get_post_by_category($post_dbs,$category){
   $post =   array_filter($post_dbs,function($post) use ($category){
            if($post['category'] == $category){
                  return true;
            }else{
                  return false;
            }
      });

      $post =array_values($post);
      return count($post)? $post : null;
      
}


function login($users,$email,$password){
    $user =  array_filter($users ,function($user) use ($email,$password){

      if($user['email'] == $email and $user['password'] == $password){
            return true;
      }else{
            return false;
      }

      });
      $user = array_values($user);
      return count($user)? $user[0] : null ;
}


function validate($email , $password){
      $errors= [];
      if(empty($email) and !empty($password) ){
            $errors[] = 'لطفا ایمیل خود را وارد کنید ';
      }else if (! filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors[] = 'ایمیل وارد شده معتبر نیست ';
      }

      if(empty($password) and  !empty($email) ){
            $errors[] = 'لطفا پسورد خود را وارد نمایید ';
      }
      if(empty($email) and empty($password)){
            $errors[] = 'ایمیل و پسورد نباید خالی باشد ';
      }


      return $errors;
}

function validate_post($title,$content,$category,$image){
      $errors = [];
      if(empty($title)){
            $errors[] = "please inter a title";
      }else if (strlen($title) < 3){
            $errors[] = "please inter a valid title biger of 3 chars";
      }


      if (empty($category)){
            $errors[] = "please select category this post";
      }

      if(empty($content)){
            $errors[] = "please inter a content this post ";
      }else if (strlen($content) < 10){
            $errors[] = "please inter a valid content biger of 10 char";
      }
      

      if (! is_array($image)  ){
            $errors[] = "please select a valid image";
      }else if (empty($image['name'])){
            $errors[] = "please select a valid  image ";
      }else if ($image['size'] > 50000){
            $errors[] = 'image size shuold be smaller than 5MB ';
      }else if (! in_array($image['type'] ,['image/gif','image/png','image/jpeg'])){
            $errors[] = 'please select a valid image';
      }

      return $errors;
}

function  validate_edite_post($title,$content,$category,$image){
      $errors = [];
      if(empty($title)){
            $errors[] = "please inter a title";
      }else if (strlen($title) < 3){
            $errors[] = "please inter a valid title biger of 3 chars";
      }


      if (empty($category)){
            $errors[] = "please select category this post";
      }

      if(empty($content)){
            $errors[] = "please inter a content this post ";
      }else if (strlen($content) < 10){
            $errors[] = "please inter a valid content biger of 10 char";
      }
      
      if(! empty($image['name'])){
            if (! is_array($image)  ){
                  $errors[] = "please select a valid image";
            }else if ($image['size'] > 50000){
                  $errors[] = 'image size shuold be smaller than 5MB ';
            }else if (! in_array($image['type'] ,['image/gif','image/png','image/jpeg'])){
                  $errors[] = 'please select a valid image';
            }
      
      }
     
      return $errors;
}

function athenticated(){
      if(isset($_SESSION['user'])){
            return true;
      }else{
            return false;
      }
}

function logout(){
      unset($_SESSION['user']);
      redirect('login.php');
}

function get_user_data(){
      if(athenticated()){
            return $_SESSION['user'];
      }else{
            return null ;
      }
}


function delete_post($posts, $id){
      $post = array_filter($posts,function ($post) use($id){
            if( $post['id'] != $id){
                  return true;
            }else{
                  delete_image($post['image']);
                  return false;
            }
      });

      $post = array_values($post);

      set_data('post',$post);
}


function create_post($posts,$title,$content,$category,$image){
      $last_post = get_last_post($posts);
      $id = $last_post['id'] + 1;

      $image_name = upload_image($image);

      $new_post= [
            'id' => $id,
            'title' => $title,
            'category' => $category,
            'content' => $content,
            'view' => '0',
            'image' => $image_name,
            'date' => date('Y-m-d  h:i:s')
      ];

      $posts[] = $new_post;
      set_data('post' ,$posts);
      return true;
}

function edite_post($posts,$id,$title,$content,$category,$image){
      $posts = array_map(function($post) use($id,$title,$content,$category,$image){

            if($post['id'] == $id){
                  $post['title'] = $title;
                  $post['content'] = $content;
                  $post['category'] = $category;
                  
                  if (! empty($image['name'])){
                      delete_image($post['image']);
                      $post['image'] = upload_image($image);

                  }
            }
            return $post;

      } ,$posts);

      set_data('post',$posts);
      return true;

}

function upload_image($file){
      $addrs = 'asset/images/';
      $name = $file['name'];
      $extention = pathinfo($name,PATHINFO_EXTENSION);
      $new_name = time().'.'.$extention;
      $tmp = $file['tmp_name'];

      if(move_uploaded_file($tmp,$addrs . $new_name)){
            return 'images/'.$new_name;
      }

}  

function delete_image($image){
      if(file_exists('asset/'. $image)){
            unlink('asset/' . $image);
            return true;
      }
}