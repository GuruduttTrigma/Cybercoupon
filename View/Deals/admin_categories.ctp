<?php  echo $this->Html->css('/js/backend/ext-2.0.1/resources/css/ext-custom.css'); ?>
<?php  echo $this->Html->script('/js/backend/ext-2.0.1/ext-custom.js'); ?>
<script type="text/javascript">
$(document).ready(function(){
	$('.x-tree-node-anchor').live('click',function(){
		var abc =$(this).parents().attr('ext:tree-node-id');
		//alert(ajax_url)
		window.location.href= ajax_url+"admin/Deals/edit_category/"+abc;
	});
});
Ext.BLANK_IMAGE_URL = '<?php echo $this->Html->url('/js/backend/ext-2.0.1/resources/images/default/s.gif') ?>';

Ext.onReady(function(){

	var getnodesUrl = '<?php echo $this->Html->url('/admin/Deals/getnodes') ?>';
	//alert(getnodesUrl);return false;
	var reorderUrl = '<?php echo $this->Html->url('/admin/Deals/reorder') ?>';
	var reparentUrl = '<?php echo $this->Html->url('/admin/Deals/reparent') ?>';
	
	var Tree = Ext.tree;
	
	var tree = new Tree.TreePanel({
		el:'tree-div',
		autoScroll:true,
		animate:true,
		enableDD:true,
		containerScroll: true,
		rootVisible: true,
		loader: new Ext.tree.TreeLoader({
			dataUrl:getnodesUrl
		}),
		viewConfig: {
            plugins: {
                ptype: 'treeviewdragdrop'
            }
        },
	});
	
	var root = new Tree.AsyncTreeNode({
		text:'Deal Categories',
		draggable:false,
		id:'root'
	});
	tree.setRootNode(root);
	
	
	// track what nodes are moved and send to server to save
	
	var oldPosition = null;
	var oldNextSibling = null;
	
	tree.on('startdrag', function(tree, node, event){
		oldPosition = node.parentNode.indexOf(node);
		oldNextSibling = node.nextSibling;
	});
	
	tree.on('movenode', function(tree, node, oldParent, newParent, position){
		
		if (oldParent == newParent){
			var url = reorderUrl;
			var params = {'node':node.id, 'delta':(position-oldPosition)};
		} else {
			var url = reparentUrl;
			var params = {'node':node.id, 'parent':newParent.id, 'position':position};
		}
		
		// we disable tree interaction until we've heard a response from the server
		// this prevents concurrent requests which could yield unusual results
		
		tree.disable();
		
		Ext.Ajax.request({
			url:url,
			params:params,
			success:function(response, request) {
			
				// if the first char of our response is not 1, then we fail the operation,
				// otherwise we re-enable the tree
				
				//console.log(response.responseText.charAt(0));
				//console.log('jj')
				//console.log($.trim(response.responseText));
				if ($.trim(response.responseText) != 1){
					request.failure();
				} else {
					tree.enable();
				}
				/*if (response.responseText.charAt(0) != 1){
					request.failure();
				} else {
					tree.enable();
				}*/
			},
			failure:function() {
			
				// we move the node back to where it was beforehand and
				// we suspendEvents() so that we don't get stuck in a possible infinite loop
				
				tree.suspendEvents();
				oldParent.appendChild(node);
				if (oldNextSibling){
					oldParent.insertBefore(node, oldNextSibling);
				}
				
				tree.resumeEvents();
				tree.enable();
				alert("Oh no!Your changes could not be saved!");
			}
		
		});
	
	});
	
	// render the tree
	tree.render();
	root.expand();

});
</script>
<div id="page-layout">
	<div id="page-content">
		<div id="page-content-wrapper">
			<?php
			if($subadmin_type==1||@$modulepermissions['Deals']['module_edit']==1) 
			{ 		  
			?>
				<a href="<?php echo HTTP_ROOT ?>admin/Deals/add_category" class="ui-state-default ui-corner-all float-right ui-button">
					Add Category
				</a>
			<?php 
			}
			?>
			<div class="inner-page-title">
				<h2>Deal Categories</h2>
                
				 <div style="float:left; margin-top:-16px; height:20px; margin-left:378px;">
				<span class="ui-icon ui-icon-pencil" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:88px; float:left; border:0px;"> - Edit Category</span>
				<span class="ui-icon ui-icon-circle-close" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:93px; float:left; border:0px;"> - Delete Category</span>
				<span class="ui-icon ui-icon-lightbulb" style="float:left; padding:0px; border:none;"></span><span style="font-size:10px; width:120px; float:left; border:0px;"> - Status of Category</span>
				
				</div>        
               <span></span>
			</div>
            <?php if($this->Session->check('success')){ ?>
				<div class="response-msg success ui-corner-all">
					<span>Success message</span>
					<?php echo $this->Session->read('success');?>
				</div>
				<?php unset($_SESSION['success']); ?>
			<?php } ?>	
            
            
            <div class="content-box content-box-header search_list" style="border:none;">
           	<div id="tree-div" style="height:400px;"></div>
			</div>
			<div class="clearfix"></div>

			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>
