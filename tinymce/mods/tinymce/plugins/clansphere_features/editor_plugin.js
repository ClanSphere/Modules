(function() {

	tinymce.PluginManager.requireLangPack('clansphere_features');

	tinymce.create('tinymce.plugins.clansphere_featuresPlugin', {

		init : function(ed, url) {

			ed.addCommand('csp_quote', function() {
				ed.windowManager.open({
					file : url + '/dialog_quote.htm',
					width : 400 + parseInt(ed.getLang('clansphere_features.delta_width', 0)),
					height : 300 + parseInt(ed.getLang('clansphere_features.delta_height', 0)),
					inline : 1, resizable : 1, scrollbars : 1
				}, {
					plugin_url : url
				});
			});

			ed.addCommand('csp_php', function() {
				ed.windowManager.open({
					file : url + '/dialog_php.htm',
					width : 400 + parseInt(ed.getLang('clansphere_features.delta_width', 0)),
					height : 300 + parseInt(ed.getLang('clansphere_features.delta_height', 0)),
					inline : 1, resizable : 1, scrollbars : 1
				}, {
					plugin_url : url
				});
			});

			ed.addCommand('csp_clipbox', function() {
				ed.windowManager.open({
					file : url + '/dialog_clipbox.htm',
					width : 400 + parseInt(ed.getLang('clansphere_features.delta_width', 0)),
					height : 300 + parseInt(ed.getLang('clansphere_features.delta_height', 0)),
					inline : 1, resizable : 1, scrollbars : 1
				}, {
					plugin_url : url
				});
			});

			ed.addCommand('csp_threadlink', function() {
				ed.windowManager.open({
					file : url + '/dialog_threadlink.htm',
					width : 400 + parseInt(ed.getLang('clansphere_features.delta_width', 0)),
					height : 300 + parseInt(ed.getLang('clansphere_features.delta_height', 0)),
					inline : 1, resizable : 1, scrollbars : 1
				}, {
					plugin_url : url
				});
			});

			ed.addButton('quote', {
				title : 'clansphere_features.quote',
				cmd : 'csp_quote',
				image : url + '/img/sc_quote.png'
			});

			ed.addButton('php', {
				title : 'clansphere_features.php',
				cmd : 'csp_php',
				image : url + '/img/sc_php.png'
			});

			ed.addButton('clipbox', {
				title : 'clansphere_features.clipbox',
				cmd : 'csp_clipbox',
				image : url + '/img/sc_clipbox.png'
			});
			ed.addButton('threadlink', {
				title : 'clansphere_features.threadlink',
				cmd : 'csp_threadlink',
				image : url + '/img/sc_threadlink.png'
			});
    },

		createControl : function(n, cm) {
			return null;
		},

		getInfo : function() {
			return {
				longname : 'clansphere_features plugin',
				author : 'clansphere team',
				authorurl : 'http://www.clansphere.net',
				infourl : 'http://www.clansphere.net',
				version : "0.4"
			};
		}
	});

	tinymce.PluginManager.add('clansphere_features', tinymce.plugins.clansphere_featuresPlugin);
})();