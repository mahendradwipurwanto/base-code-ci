<?php
class Uploader
{
    protected $_ci;
    public $_size = 5 * 1024;

    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->database();

        $this->_size = $this->_ci->db->get_where('tb_settings', ['key' => 'max_upload_size']);
    }

    public function uploadImageMulti($file, $fileUpload, $path, $custom_name = null)
    {
        if ($file) {
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $filename = $custom_name == null ? time() : $custom_name;

            $config['upload_path']      =  "./{$path}/";
            $config['allowed_types']    = 'jpg|png|jpeg|PNG|JPG|JPEG';
            $config['max_size']         = $this->_size;
            $config['file_name']        = "{$filename}.jpg";

            $this->_ci->load->library('upload', $config);

            if (!$this->_ci->upload->do_upload($fileUpload)) {
                $error = array('error' => $this->_ci->upload->display_errors());
                return [
                    'status'    => false,
                    'message'   => $error
                ];
            } else {
                $data = $this->_ci->upload->data();
                return [
                    'status'    => true,
                    'filename'  => $path . $data['file_name'],
                    'path'      => $path,
                    'message'   => 'Image has been uploaded'
                ];
                ob_clean();
            }
        } else {
            return [
                'status' => false,
                'message' => 'Select a file'
            ];
        }
    }

    public function uploadImage($file, $path, $custom_name = null)
    {
        if ($file) {
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $filename = $custom_name == null ? time() : $custom_name;

            $config['upload_path']      =  "./{$path}/";
            $config['allowed_types']    = 'jpg|png|jpeg|PNG|JPG|JPEG';
            $config['max_size']         = $this->_size;
            $config['overwrite']        = true;
            $config['file_name']        = "{$filename}.jpg";

            $this->_ci->load->library('upload', $config);

            if (! $this->_ci->upload->do_upload('image')) {
                $error = array('error' => $this->_ci->upload->display_errors());
                return [
                    'status'    => false,
                    'message'   => $error
                ];
            } else {
                $data = $this->_ci->upload->data();
                return [
                    'status'    => true,
                    'filename'  => $path.$data['file_name'],
                    'path'      => $path,
                    'message'   => 'Image has been uploaded'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'Select a file'
            ];
        }
    }

    public function uploadFile($file, $path, $custom_name = null)
    {
        if ($file) {
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $filename = $custom_name == null ? time() : $custom_name;

            $config['upload_path']      =  "./{$path}/";
            $config['allowed_types']    = 'pdf|pptx|doc|docx|xlx|xlxs';
            $config['max_size']         = $this->_size;
            $config['overwrite']        = true;
            $config['file_name']        = "{$filename}";

            $this->_ci->load->library('upload', $config);

            if (!$this->_ci->upload->do_upload('file')) {
                $error = array('error' => $this->_ci->upload->display_errors());
                return [
                    'status'    => false,
                    'message'   => $error
                ];
            } else {
                $data = $this->_ci->upload->data();
                return [
                    'status'    => true,
                    'filename'  => $path .$data['file_name'],
                    'path'      => $path,
                    'message'   => 'File has been uploaded'
                ];
            }
        } else {
            return [
                'status' => false,
                'message' => 'Select a file'
            ];
        }
    }
}
