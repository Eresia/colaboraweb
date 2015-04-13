<?php 
    session_start();
	require_once("define/root_define.php");
    require_once(SERV_ROOT."/function/base.php");
	require_once(SERV_ROOT."/function/function_post.php");

	function index_page(){
	
		$result = beginPage(array(HTTP_ROOT."/css/style3.css"), 'ColLABoraWEB');
		
		$result .= begin_content();
		
		$result .= '<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
			</p>
			<p>	
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
			</p>
			<p>	
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
			</p>	
			<p>	
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla malesuada imperdiet pellentesque. Duis felis nulla, hendrerit sit amet arcu id, tempus sodales metus. Suspendisse convallis felis a nibh condimentum convallis. Proin semper blandit quam. Duis molestie accumsan dictum. Pellentesque auctor sagittis nibh nec venenatis. Mauris nunc massa, tincidunt nec magna vel, interdum sodales sapien. Ut imperdiet, lectus eget semper hendrerit, urna ligula mattis justo, quis aliquam erat risus ut velit. 
			</p>
		</div>';
		
		$result .= end_content();
		$result .= endPage();
	
		return $result;
	}
	
	echo indent(index_page());
?>