// http://docs.cksource.com/CKEditor_3.x/Tutorials/Timestamp_Plugin

CKEDITOR.plugins.add( 'preformat',
{
	init: function( editor )
	{
		editor.addCommand( 'insertPreformat',
		{
			exec : function( editor )
			{    
				editor.insertHtml( '<pre><code>insert code here</code></pre>' );
			}
		});

		editor.ui.addButton( 'Preformat',
		{
			label: 'Preformat code',
			command: 'insertPreformat',
			icon: this.path + 'image/preformat.png'
		});
	}
} );
