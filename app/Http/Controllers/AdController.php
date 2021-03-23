<?php

/** *****************************************************************************/

namespace App\Http\Controllers;

/** *****************************************************************************/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/** *****************************************************************************/
class AdController extends Controller
{
    /** *************************************************************************/
    public function error($message)
    {
        return [
            'status' => 'failed', 
            'message' => $message
        ];
    }
    /** *************************************************************************/
    /** Получение списка объявлений, в случае передачи идентификатора, только конкретное объявление  */
    public function get(Request $request, $id = -1)
    {
        if ($id != -1) {
            return $this->getById($request, $id);
        }

        try {
            $main = DB::table('main')->get();

            $result = [];

            foreach ($main as $ad) {

                $images = DB::table('images')
                    ->where('id_main', $ad->images)
                    ->get();

                $images_url = [];

                foreach ($images as $url) {
                    array_push($images_url, $url->url);
                }

                $ad->images = $images_url;

               array_push($result, $ad);
            }
 
            return response()
                ->json([
                    'status' => 'success', 
                    'data' => $result
            ]);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
    /** *************************************************************************/
    /** Получение объявления по идентификатору, в параметре fields
    * можно указать доп. поля через точку с зяпятой
    */
    public function getById(Request $request, $id)
    {
        $fields = $request->get("fields");
        
        $fields_array = [];

        if ($fields !== null) {
            $fields_array = explode(";", $fields);
        }

        $isHaveImage = false;
        
        try {
            $query = DB::table('main')->select('id', 'name', 'price')->where('id', $id);
            
            foreach ($fields_array as $field) {
                $query->addSelect($field);
                if ($field == 'images') {
                    $isHaveImage = true;
                }
            }

            $main = $query->first();
            
            if ($fields !== null) {
                if ($isHaveImage) {
                    $images = DB::table('images')
                        ->where('id_main', $main->images)
                        ->get();

                    $images_url = [];

                    foreach ($images as $url) {
                        array_push($images_url, $url->url);
                    }

                    $main->images = $images_url;
                }
            }

            return response()
                ->json([
                    'status' => 'success', 
                    'data' => $main
            ]);

        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
    /** *************************************************************************/
    /**Добавление нового объявления, в случае передачи идентификатору удаление объявления */
    public function post(Request $request, $id = -1)
    {
        if ($id != -1) {
            return $this->delete($request, $id);
        }
        
        try {

            $uuid = uniqid();

            $id = DB::table('ad.main')
                ->insertGetId([
                    'id' => uniqid(), 
                    'name' => isset($request->name) ? $request->name : '', 
                    'price' => isset($request->price) ? $request->price : '',
                    'images' => $uuid,
                    'created_by' => now(),
                    'description' => isset($request->description) ? $request->description : '']
            );

            $i = true;
            foreach ((array) $request->images as $image) {
                DB::table('ad.images')
                    ->insertGetId([
                        'id' => uniqid(),
                        'id_main' => $uuid,
                        'url' => $image,
                        'isMain' => $i]
                    );

                $i = false;
            }

            return response()
                ->json([
                    'status' => 'success', 
                    'id' => $id
            ]);
        } catch (\Throwable $th) {
            return response()->json($this->error($th->getMessage()));
        }
    }
    /** *************************************************************************/
    /** Удаление изображений объявления */
    public function remove($id)
    {
        $main = DB::table('main')->where('id', $id)->first();

        DB::table('images')->where('id_main', '=', $main->images)->delete();
        DB::table('main')->where('id', '=', $id)->delete();
    }
    /** *************************************************************************/
    /** Удаление объявления */
    public function delete(Request $request, $id)
    { 
        try {
            if (!is_array($request->id)) {
                $this->remove($request->id);   
            } else {
                if (count($request->id) > 0) {
                    foreach ($request->id as $id_list) {
                        $this->remove($id_list);   
                    }
                }
            }

            return response()
                ->json([
                    'status' => 'success'
                ]);
        } catch (\Throwable $th) {
            return response()->json($this->error($th->getMessage()));
        }
    }
    /** *************************************************************************/
}
/** *****************************************************************************/
