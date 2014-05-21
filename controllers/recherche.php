<?php
class recherche 
{
	public function default_action()
	{
		if (empty($this->req->keywords))
		{
			
		}
		$tpls = array_diff(array('..', '.'), scandir('views/'));
		foreach ($tpls as $t)
		{
			if (strpos($t, $this->req->keywords))
			{
				Debug::show($t);
			}
		}
	}
}
?>