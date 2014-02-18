<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Photos extends MX_Controller {
    //private $currenturl = '';
	private $photos_config = array();
    public function __construct() {
        parent::__construct();
		$this->photos_config = $this->load->config('photos', TRUE);
        Modules::run('users/index');
        $forgroups = array();
        Modules::run('users/in_groups',$forgroups);
    }
	public function index()
	{
		echo '<pre>';
		print_r($this->photos_config);
		//echo 'bau';
		//echo $this->photos_config['article_main_thumb_height'];
		//$this->load->view('galleries_homepage_view');
	}
	public function add_gallery()
	{

	}
	public function get_photos($id_parent, $file_for)
	{
		$id_parent = intval($id_id_parent);
		if(!empty($id_parent) && !empty($file_for))
		{
			$this->load->model('photos_model');
			$photos = $this->photos_model->get_all(array('file_for'=>$file_for,'id_parent'=>$id_parent));
			if(!empty($photos))
			{
				return $photos;
			}
			else
			{
				return false;
			}
		}
	}
	public function upload_photos($id_parent,$file_for)
	{
		//$id_article = intval($id_article);
		$data['id_parent'] = intval($id_parent);
		$data['file_for'] = $file_for;
		$this->load->model('photos_model');
		$data['photos'] = $this->photos_model->get_all(array('file_for'=>$file_for,'id_parent'=>$data['id_parent']));
		$this->load->view('upload_photos_view',$data);
	}
	public function upload_main_photo($table,$id_field,$id)
	{
		if(!empty($table) && !empty($id_field) && !empty($id))
		{
			$data['table'] = $table;
			$data['id_field'] = $id_field;
			$data['id'] = $id;
			$this->load->library('user_agent');
			$data['from'] = $this->agent->referrer();
			$this->load->view('upload_main_photo_view',$data);
		}
		else
		{
			$this->load->library('user_agent');
			redirect($this->agent->referrer());
		}

	}
	public function delete_main_photo($table,$id_field,$id)
	{
		if(!empty($table) && !empty($id_field) && !empty($id))
		{
			$this->load->model('photos_model');
			$photo = $this->photos_model->get_main_photo($table,$id_field,$id);
			if(!empty($photo))
			{
				$tbdeleted = array($photo->photo.$photo->photo_extension,$photo->photo.'_thumb'.$photo->extension);
				foreach($tbdeleted as $del)
				{
					@unlink(BASEPATH.'../photos/'.$del);
				}
			}
			if($this->photos_model->delete_main_photo($table,$id_field,$id))
			{
				$this->cache->delete($table.'_list_'.$table);
				$this->load->library('user_agent');
				redirect($this->agent->referrer());
			}
		}
		else
		{
			$this->load->library('user_agent');
			redirect($this->agent->referrer());
		}
	}
	public function upload_photos_submit()
    {
		$this->form_validation->set_rules('id_parent', 'ID article','trim|is_natural_no_zero|required');
		$this->form_validation->set_rules('file_for','File for','trim|required');
		$this->form_validation->set_rules('file_names','File names:','trim');
		if($this->form_validation->run() === FALSE)
		{
			echo 'bummer...';
			exit;
		}
		else
		{
			$id_parent = intval($this->input->post('id_parent'));
			$file_for = strip_tags($this->input->post('file_for'));
			$file_names = url_title($this->input->post('file_names'),'dash',TRUE);


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
						$this->photos_model->insert(array('id_parent'=>$id_parent, 'file_for'=>$file_for, 'type'=>'inline', 'file_name'=>$data['upload_data']['raw_name'], 'extension'=>$data['upload_data']['file_ext'], 'width'=>$data['upload_data']['image_width'],'height'=>$data['upload_data']['image_height']));
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
				$this->load->library('user_agent');
				redirect($this->agent->referrer());
				//$data['success'] = $upload_data;
			}

		}
    }
	public function upload_main_photo_submit()
    {
		$this->form_validation->set_rules('file_title','File title','trim|required');
		$this->form_validation->set_rules('file_name','File name','trim');
		$this->form_validation->set_rules('table','Table','trim|required');
		$this->form_validation->set_rules('id_field','ID field','trim|required');
		$this->form_validation->set_rules('id','ID','trim|is_natural_no_zero|required');
		$this->form_validation->set_rules('from','From','trim|required');
		if($this->form_validation->run() === FALSE)
		{
			$this->load->view('upload_main_photo_view');
		}
		else
		{
			$from = $this->input->post('from');
			$file_title = strip_tags($this->input->post('file_title'));
			$file_name = strip_tags($this->input->post('file_name'));
			$file_name = url_title($file_name,'dash',TRUE);
			if(empty($file_name))
			{
				$file_name = url_title($file_title,'dash',TRUE);
			}
			$file_name = $file_name.'-'.time();
			$table = strip_tags($this->input->post('table'));
			$id_field = strip_tags($this->input->post('id_field'));
			$id = intval($this->input->post('id'));
			// Put each errors and upload data to an array
			$error = array();
			$success = array();
			//print_r($_FILES);
			// main action to upload each file

			$this->load->library('upload');
			$upload_conf = array(
			'upload_path'   => 'photos/',
			'allowed_types' => 'gif|jpg|png|jpeg',
			'max_size'      => '30000',
			'file_name'=>$file_name
			);
			$this->upload->initialize($upload_conf);
			if (!$this->upload->do_upload('photo'))
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('upload_main_photo_view', $error);
			}
			else
			{
				$this->load->library('image_lib');
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
					$this->photos_model->insert_into_table(array('photo'=>$data['upload_data']['raw_name'], 'photo_extension'=>$data['upload_data']['file_ext'],'photo_title'=>$file_title),$id_field,$id,$table);
					$this->image_lib->clear();
				}
				else
				{
					// if got fail.
					$error['resize'][] = $this->image_lib->display_errors();
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
				redirect($from,'refresh');
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
