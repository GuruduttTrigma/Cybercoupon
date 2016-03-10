<style>
.pagesize
{
	 border: 1px solid #ABADB3;
    padding: 4px;
    width: 100px;
	margin:5px;
	padding:4px;
}
</style>
<div  class="pager">
		<a class="btn_no_text btn ui-state-default ui-corner-all first" title="First Page" href="#">
	    <span class="ui-icon ui-icon-arrowthickstop-1-w"></span>
</a>
		<a class="btn_no_text btn ui-state-default ui-corner-all prev" title="Previous Page" href="#">
	<span class="ui-icon ui-icon-circle-arrow-w"></span>
</a>
<input type="text" class="pagedisplay" style="border: 1px solid #ABADB3;color: #333333;float: left;margin: 5px;padding: 4px;"/>
<a class="btn_no_text btn ui-state-default ui-corner-all next" title="Next Page" href="#">
	<span class="ui-icon ui-icon-circle-arrow-e"></span></a>
	<a class="btn_no_text btn ui-state-default ui-corner-all last" title="Last Page" href="#">
	<span class="ui-icon ui-icon-arrowthickstop-1-e"></span>
</a>
		<select class="pagesize"  title="Select page size">
			<option value="10">10 results</option>
            <option value="20" selected="selected">20 results</option>
            <option value="30">30 results</option>
            <option value="40">40 results</option>
            <option value="100">100 results</option>
            <option value="500">500 results</option>
            <option value="1000">1000 results</option>
		</select>
		<?php /*?><select class="gotoPage" title="Select page number"></select><?php */?>
	</div>