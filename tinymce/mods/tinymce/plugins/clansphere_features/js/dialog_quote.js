tinyMCEPopup.requireLangPack();

var dialog_quote = {

	init : function() {

		var f = document.forms[0];
	},

	insert : function() {

		tinyMCEPopup.editor.execCommand('mceInsertContent', false, dialog_quote.output(document.forms[0].quote_source.value, document.forms[0].quote_content.value));
		tinyMCEPopup.close();
	},

  output: function(source, content) {

    content = content.replace(/</gi, "&lt;");
    content = content.replace(/>/gi, "&gt;");
    source = source.replace(/</gi, "&lt;");
    source = source.replace(/>/gi, "&gt;");
    source = source == '' ? '[quote]' : '[quote=' + source + ']';

    return '<blockquote>' + source + content + '[/quote]</blockquote>';
  }
};

tinyMCEPopup.onInit.add(dialog_quote.init, dialog_quote);