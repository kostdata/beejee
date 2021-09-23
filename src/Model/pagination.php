<?php
defined('_APP_EXEC') or die('Доступ запрещен');
class Pagination 
{
	
	var $limitstart = null;
    var $limit = null;
    var $total = null;
    var $link = '';
		function __construct($total, $limitstart, $limit,$link)
	{
		$this->total		= $total;
		$this->limitstart	= $limitstart;
        $this->limit        = $limit;
		$this->link		= $link;

		if ($this->limit > $this->total) {
			$this->limitstart = 0;
		}

		if (!$this->limit)
		{
			$this->limit = $total;
			$this->limitstart = 0;
		}
        if($this->limitstart > 0)
            $this->limitstart = ($this->limitstart-1)*$this->limit;
		if ($this->limitstart > $this->total) {
			$this->limitstart -= $this->limitstart % $this->limit;
		}
	}
    function showPageNavigation() {
        $totalpages = ceil( $this->total / $this->limit );
        $currentpage = ceil( ($this->limitstart+1) / $this->limit );
        echo '<nav aria-label="Page navigation"><ul class="pagination">';
        for($i = 1;$i <= $totalpages;$i++){
            echo '<li class="page-item"><a class="page-link" href="'.$this->link.'&page='.($i-1).'">'.$i.'</a></li>';    
        }
        echo '</ul></nav>';
    
}	 
	
}
