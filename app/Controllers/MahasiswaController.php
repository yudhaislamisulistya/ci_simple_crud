<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;

class MahasiswaController extends ResourceController
{
    use ResponseTrait;
	public function index()
	{
		return view('index');
	}

    public function tampilDataMahasiswa()
    {
        $model = new MahasiswaModel();
        $data = $model->findAll();
        return $this->respond([
            "data" => $data
        ], 200);
    }

    public function simpanDataMahasiswa()
    {
        try {
            $model = new MahasiswaModel();
            $data = [
                'stambuk' => $this->request->getPost('stambuk'),
                'nama' => $this->request->getPost('nama'),
                'kelas' => $this->request->getPost('kelas'),
            ];
    
            $data = json_decode(file_get_contents("php://input"));
            $model->insert($data);
            $reponse = [
                'status' => 200,
                'message' => "Data Berhasil Ditambahkan",
            ];
    
            return $this->respondCreated($reponse, 200);
        } catch (Exception $e) {
            return $this->respond(["status" => 401, "message" => "Data Gagal Ditambahkan"], 401);
        }

    }

    public function hapusDataMahasiswa($id = null)
    {
        try {
            $model = new MahasiswaModel();
            $data = $model->find($id);
            if($data){
                $model->delete($id);
                $reponse = [
                    'status' => 200,
                    'message' => "Data Berhasil Dihapus",
                ];
                return $this->respondDeleted($reponse);
            }else{
                $reponse = [
                    'status' => 401,
                    'message' => "Data Gagal Dihapus",
                ];
                return $this->failNotFound("Data Tidak Ada");
            }
        } catch (Exception $e) {
            return $this->respond(["status" => 401, "message" => "Data Gagal Dihapus"], 401);
        }
    }

    public function lihatDataMahasiswa($id = null)
    {
        $model = new MahasiswaModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if($data){
            return $this->respond($data, 200);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }

    public function ubahDataMahasiswa($id = null)
    {
        try {
            $model = new MahasiswaModel();
            $json = $this->request->getJSON();
            if($json){
                $data = [
                    'nama' => $json->nama,
                    'stambuk' => $json->stambuk,
                    'kelas' => $json->kelas,
                ];
            }else{
                $input = $this->request->getRawInput();
                $data = [
                    'nama' => $input['nama'],
                    'stambuk' => $input['stambuk'],
                    'kelas' => $input['kelas'],
                ];
            }
    
            $model->update($id, $data);
    
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => "Data Berhasil Diubah"
            ];
            return $this->respond($response);
        } catch (Exception $th) {
            $response = [
                'status'   => 401,
                'error'    => null,
                'messages' => "Data Gagal Diubah"
            ];
            return $this->respond($response);
        }
    }
}