tinyMCEPopup.requireLangPack();

var dialog_php = {

	init : function() {

		var f = document.forms[0];
	},

	insert : function() {

		tinyMCEPopup.editor.execCommand('mceInsertContent', false, dialog_php.output(document.forms[0].php_content.value));
		tinyMCEPopup.close();
	},

  output: function(code) {

    code = code.replace(/</gi, "&lt;");
    code = code.replace(/>/gi, "&gt;");

    return '<code>[php]' + code + '[/php]</code>';
  }
};

tinyMCEPopup.onInit.add(dialog_php.init, dialog_php);