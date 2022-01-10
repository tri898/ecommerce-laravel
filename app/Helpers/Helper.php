<?php
namespace App\Helpers;
use File;
class Helper
{
    public function uploadImage($images)
	{
		foreach($images as $image)
		{
			$name = date('YmdHis').rand().'.'.$image->extension();
			$image->move(public_path().'/files/', $name);
			$data[] = $name;
		}
		return $data;
	}
	public function deleteImage($images)
	{
		foreach($images as $value) {
			$destination = 'files/'.$value;
			if (File::exists($destination)) {
				File::delete($destination);
			}
		}
	}
}
?>