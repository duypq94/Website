 <section id="home" class="row">
                        <header class="">
                           <i class="fa fa-home"></i>
                           <span>Đăng Ký</span>
                        </header>
                        <!--List_news-->
						
						

<body>								
	<table class="table table-bordered"> 
	  <tr class="info">
        <td class="text-center"><b ><?php echo 'Khóa học'.' '.$class['Name'].'-'.$hpid?></b></td>
      </tr>
	  <tr >
		    <td>
    <label class="col-sm-2 control-label">Nội dung khóa học:</label>

    <label >
         <?php
    echo $ND['content']; 
    //text-center
        ?> </label>

      </td>
      </tr>
	  </table>

   
  <table class="table table-bordered"> 
    <tr class="danger">
      
      
      </tr>
  <form class="t-form form_action" method="post" action=""  >
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
    <tr class="danger">
    
    <td>
      <label class="col-sm-2 control-label">Cập nhật:</label>
      <textarea name="gv_comment" class="txtTextarea wysiwygEditor" id="txtDescription"><?php echo set_value('description', '');?></textarea>
    <label class="col-sm-2 control-label">Thao tác:</label>
    <button type="submit" name="gv_submit" value="Cập Nhật" class="btn btn-default">Cập nhật thông tin</button>
    <button type="submit" name="gv_back" value="back" class="btn btn-default"><a href="<?php echo site_url('list_class_of_teacher/home?semester='.$semester.'&')?>">Quay về</a></button>
    </td>
    </tr>
  </form>
    </table>





<script type="text/javascript" src="plugin/tinymce_3.5.11/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
  // General options
  mode : "textareas",
  editor_selector : "wysiwygEditor", // Sử dụng với class
  entity_encoding : "raw", // Thay Ch&agrave;o c&aacute;c bạn = Chào các bạn
  theme : "advanced",
  plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
  file_browser_callback: 'openKCFinder',  
  // Theme options
  theme_advanced_buttons1 : "preview,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,bullist,numlist,|,blockquote,|,sub,sup",
  theme_advanced_buttons2 : "tablecontrols,|,link,unlink,anchor,image,|,forecolor,backcolor,|,charmap,emotions,iespell,media,advhr,|,hr,removeformat,visualaid,|,fullscreen,|,code",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_statusbar_location : "bottom",
  theme_advanced_resizing : true,

  // Skin options
  skin : "o2k7",
  skin_variant : "silver",
  height: 168,

  language : 'en',

  // Example content CSS (should be your site CSS)
  content_css : "",
  
  // Cấu hình để font-size to hơn
  setup : function(ed){
    ed.onInit.add(function(ed){
      ed.getDoc().body.style.fontSize = '11px';
    });
  },

  // Drop lists for link/image/media/template dialogs
  template_external_list_url : "js/template_list.js",
  external_link_list_url : "js/link_list.js",
  external_image_list_url : "js/image_list.js",
  media_external_list_url : "js/media_list.js",

  // Replace values for the template plugin
  template_replace_values : {
      username : "Some User",
      staffid : "991234"
  },

  // Link của chính nó
  // Cấu hình link thực
  relative_urls : 0,
  remove_script_host : 0,
});


tinyMCE.init({
  // General options
  mode : "textareas",
  editor_selector : "wysiwygEditorContent", // Sử dụng với class
  entity_encoding : "raw", // Thay Ch&agrave;o c&aacute;c bạn = Chào các bạn
  theme : "advanced",
  plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
  file_browser_callback: 'openKCFinder',  
  // Theme options
  theme_advanced_buttons1 : "preview,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,bullist,numlist,|,blockquote,|,sub,sup",
  theme_advanced_buttons2 : "tablecontrols,|,link,unlink,anchor,image,|,forecolor,backcolor,|,charmap,emotions,iespell,media,advhr,|,hr,removeformat,visualaid,|,fullscreen,|,code",
  theme_advanced_toolbar_location : "top",
  theme_advanced_toolbar_align : "left",
  theme_advanced_statusbar_location : "bottom",
  theme_advanced_resizing : true,

  // Skin options
  skin : "o2k7",
  skin_variant : "silver",
  height: 368,

  language : 'en',

  // Example content CSS (should be your site CSS)
  content_css : "",
  
  // Cấu hình để font-size to hơn
  setup : function(ed){
    ed.onInit.add(function(ed){
      ed.getDoc().body.style.fontSize = '11px';
    });
  },

  // Drop lists for link/image/media/template dialogs
  template_external_list_url : "js/template_list.js",
  external_link_list_url : "js/link_list.js",
  external_image_list_url : "js/image_list.js",
  media_external_list_url : "js/media_list.js",

  // Replace values for the template plugin
  template_replace_values : {
      username : "Some User",
      staffid : "991234"
  },

  // Link của chính nó
  // Cấu hình link thực
  relative_urls : 0,
  remove_script_host : 0,
});

function openKCFinder(field_name, url, type, win) {
    tinyMCE.activeEditor.windowManager.open({
        file: 'plugin/kcfinder_2.51/browse.php?opener=tinymce&lang=vi&type=' + type,
        title: 'KCFinder',
        width: 1150,
        height: 600,
        resizable: "yes",
        inline: true,
        close_previous: "no",
        popup_css: false
    }, {
        window: win,
        input: field_name
    });
    return false;
}

function browseKCFinder(field, type) {
    window.KCFinder = {
        callBack: function(url) {
      document.getElementById(field).value = url;
            window.KCFinder = null;
        }
    };
    window.open('plugin/kcfinder_2.51/browse.php?type='+type+'&lang=vi', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=1150, height=600'
    );
}
</script>
  </body> 
	
   
  
     
  	
	
					

						<!--End List_news-->   
                           