<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Photos extends MX_Controller {
    //private $currenturl = '';
    public function __construct() {
        parent::__construct();
        Modules::run('users/index');
        $forgroups = array();
        Modules::run('users/in_groups',$forgroups);
    }
	public function index()
	{
		$this->load->view('galleries_homepage_view');
	}
	public function add_gallery()
	{

	}
	public function get_photos_article($id_article)
	{
		$idarticle = intval($id_article);
		$this->load->model('photos_model');
		$photos = $this->photos_model->get_all(array('file_for'=>'article','id_parent'=>$idarticle));
		if(!empty($photos))
		{
			return $photos;
		}
		else
		{
			return false;
		}
	}
	public function upload_photos_article($id_article)
	{
		//$id_article = intval($id_article);
		$data['idarticle'] = intval($id_article);
		$this->load->model('photos_model');
		$data['photos'] = $this->photos_model->get_all(array('file_for'=>'article','id_parent'=>$data['idarticle']));
		$this->load->view('upload_photos_view',$data);
	}
	public function upload_photos_article_submit()
    {
		$this->form_validation->set_rules('id_article', 'ID article','trim|is_natural_no_zero|required');
		$this->form_validation->set_rules('file_names','File names:','trim');
		if($this->form_validation->run() === FALSE)
		{
			echo 'bummer...';
			exit;
		}
		else
		{
			$id_article = intval($this->input->post('id_article'));
			$file_names = url_title($this->input->post('file_names'),'dash');


			// Change $_FILES to new vars and loop them
			foreach($_FILES['photos'] as $key=>$val)
			{
				$i = 1;
				foreach($val as $v)
				{
					if(empty($file_names))
					{
						$file_names = 'photo';
					}
					$field_name = $file_names.'-'.time().'-'.$i;
					$_FILES[$field_name][$key] = $v;
					$i++;
				}
			}
			// Unset the useless one ;)
			unset($_FILES['photos']);


			// Put each errors and upload data to an array
			$error = array();
			$success = array();
			//print_r($_FILES);
			// main action to upload each file
			$this->load->library('image_lib');
			foreach($_FILES as $field_name => $file)
			{
				$this->load->library('upload');
				$upload_conf = array(
				'upload_path'   => 'photos/',
				'allowed_types' => 'gif|jpg|png|jpeg',
				'max_size'      => '30000',
				'file_name'=>$field_name
				);
				$this->upload->initialize($upload_conf);

				if (!$this->upload->do_upload($field_name))
				{
					// if upload fail, grab error
					$error['upload'][] = $this->upload->display_errors();
				}
				else
				{
					$data['upload_data'] = $this->upload->data();
					$config['image_library'] = 'gd2';
					$config['source_image']	= $data['upload_data']['full_path'];
					$config['quality'] = '100%';
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = '130';
					$config['height'] = '130';
					$config['master_dim'] = 'width';
					$this->image_lib->initialize($config);
					if($this->image_lib->resize())
					{
						$this->load->model('photos_model');
						$this->photos_model->insert(array('id_parent'=>$id_article, 'file_for'=>'article', 'file_name'=>$data['upload_data']['raw_name'], 'extension'=>$data['upload_data']['file_ext'], 'width'=>$data['upload_data']['image_width'],'height'=>$data['upload_data']['image_height']));
						// otherwise, put each upload data to an array.
						//$success[] = $upload_data;
						$this->image_lib->clear();
					}
					else
					{
						// if got fail.
						$error['resize'][] = $this->image_lib->display_errors();
					}

				}
			}

			// see what we get
			if(!empty($error))
			{
				$data['error'] = $error;
				echo '<pre>';
				print_r($data);
				echo '</pre>';
			}
			else
			{
				redirect(site_url('articles/edit_article/'.$id_article,'refresh'));
				//$data['success'] = $upload_data;
			}

		}
    }
	public function delete($id_photo)
	{
		$id_photo = intval($id_photo);
		if(!empty($id_photo))
		{
			$this->load->model('photos_model');
			$photo = $this->photos_model->get(array('id'=>$id_photo));
			if(!empty($photo))
			{
				$tbdeleted = array($photo->file_name.$photo->extension,$photo->file_name.'_thumb'.$photo->extension);
				foreach($tbdeleted as $del)
				{
					@unlink(BASEPATH.'../photos/'.$del);
				}
			}
			$this->photos_model->delete(array('id'=>$id_photo));
			$this->load->library('user_agent');
			redirect($this->agent->referrer());
		}
	}
}
