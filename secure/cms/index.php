<?php
include_once '../authorize.php';
include_once '../../includes/db_connect.php';
include_once("../../CMSUtility.php");
?>


<?php  
require_once '../secureheader.php';	
?>	

<div class="container">
	<div class="row">
        <?php
		if (!empty($_POST)): 
		
			$articleData = $_POST["articledata"];
			$articleName = $_POST["articlename"];

			for($i=0; $i < sizeOf($articleData); $i++) {
				$data = $articleData[$i];
				$name = $articleName[$i];

				CMSUtility::UpdateArticleByName($name, $data);
			}
		?>
		<div>results saved!</div>

		<?php endif; ?>
		

		<div class="span12">
			<form method="post" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>>
				<?php
					$articles = CMSUtility::GetAllArticles();
					for ($i = 0; $i < sizeOf($articles); $i++) {
						
						$article = $articles[$i];

						echo("<div class='form-group'><label for='articledata[$i]'>$article->name</label><textarea id='articledata[$i]' name='articledata[$i]' class='form-control'>". $article->data ."</textarea></div>");
						echo("<input name='articlename[$i]' type='hidden' value='$article->name'>");
					}
				?>
				
			</form>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<div class="cms-content" data-nodename="siteheadline">
				<h1>Heading 1</h1>
			</div>
			<div class="cms-content" data-nodename="sitebodycopy">
				<h2>Sub Heading</h2>
				<p>Pargraph 1</p>
				<p>
					<ul>
						<li>Item 1</li>
						<li>Item 2</li>
						<li>Item 2</li>
					</ul>
				</p>
			</div>

			<button id="Save" type="submit" class="btn btn-primary">
				<i class="glyphicon glyphicon-upload"></i>
				Save
			</button>
		</div>
	</div>
</div>
        
<?php include_once '../footerscripts.php' ?>
<script>
	var editors;
	var instantiateTextbox = function () {
		var config = {
		   ui : {
		    toolbar : {
		        items : [
		            // Limit the toolbar to insert, styles and emphasis
		            'insert',
		            'style',
		            'emphasis',
		            {
		            	label: 'Indent Group',
	            		items: ['indent', 'outdent']
		            },
		            {
		                label: 'Custom Toolbar Group',
		                items: [ 'removeformat', 'fullscreen' ]
		            }
		        ]
		    }
		  }, 
		  css : {
		      // Set the editor rendering stylesheets
		      stylesheets : [ '../content/css/textboxio.css' ], 
		      
		      
		  }
		};
		editors = textboxio.inlineAll('.cms-content', config);
        
	};

	var getEditorContent = function(){
		for (var i = 0; i < editors.length; i++)
		{
			var editor = editors[i];	
			alert(editor.content.get());
		}	
	};

	$(function(){
		instantiateTextbox();
		$('#Save').on('click', function(e){
			e.preventDefault();
			getEditorContent();
		});
	});
</script>
<?php include_once '../footer.php' ?>