$(window).load(function(){
	/* ================ HEIGHT ITQ-FORM =================== */
	resizeHeight();
});

function resizeHeight(){
	if($('section.itq-form .side-panel').height() > $('section.itq-form .main-panel').height()){
		$('section.itq-form').height($('section.itq-form .side-panel').height() + 20);
	}
	return false;
}

$(document).ready(function(){
	/* ================ #SLIDE IMAGE =================== */
	if($('#addSlide').length){
		$('#addSlide').click(function(){
			var _this = $(this);
			$('#containerSlide').append('<label class="item"><input type="text" name="slide[description]['+$('#stepSlide').val()+']" value="" class="txtText" style="margin-bottom: 10px;" placeholder="Mô tả ảnh" /> <input type="text" name="slide[image]['+$('#stepSlide').val()+']" value="" class="txtText" id="txtImage'+$('#stepSlide').val()+'" style="width: 65%;" placeholder="Link ảnh" /> <input type="button" value="Chọn" class="btnButton" onclick="browseKCFinder(\'txtImage'+$('#stepSlide').val()+'\', \'image\');return false;" /> <input type="button" value="Xóa" class="btnButton btnButtonRemoveSlide" /></label>');
			$('#stepSlide').val($('#stepSlide').val() + 1);
			resizeHeight();
			return false;
		});
	}
	if($('.btnButtonRemoveSlide').length){
		$('.btnButtonRemoveSlide').live('click', function(){
			$(this).parent().remove();
			resizeHeight();
			return false;
		});
	}
	/* ================ #SLIDE PRICE =================== */
	if($('#addPrice').length){
		$('#addPrice').click(function(){
			var _this = $(this);
			$('#containerPrice').append('<label class="item"><input type="text" name="price['+$('#stepPrice').val()+'][weight]" value="" class="txtText number-format" style="width: 25%;"/> <input type="text" name="price['+$('#stepPrice').val()+'][price]" value="" class="txtText number-format" style="width: 55%;"/> <input type="button" value="Xóa" class="btnButton btnButtonRemovePrice" /></label>');
			$('#stepPrice').val(parseInt($('#stepPrice').val()) + 1);
			return false;
		});
	}
	if($('.btnButtonRemovePrice').length){
		$('.btnButtonRemovePrice').live('click', function(){
			$(this).parent().remove();
			// $('#stepPrice').val(parseInt($('#stepPrice').val()) - 1);
			return false;
		});
	}
	/* ================ #CHECK-ALL =================== */
	if($('#check-all').length){
		$('#check-all').click(function(){
			if($(this).prop('checked')){
				$('.check-all').prop('checked', true).parent().parent().find('td').addClass('select');
			}
			else{
				$('.check-all').prop('checked', false).parent().parent().find('td').removeClass('select');
			}
		});
	}
	if($('.check-all').length){
		$('.check-all').click(function(){
			if($(this).prop('checked') == false){
				$(this).parent().parent().find('td').removeClass('select');
				$('#check-all').prop('checked', false);
			}
			else{
				$(this).parent().parent().find('td').addClass('select');
			}
			if($('.check-all:checked').length == $('.check-all').length){
				$('#check-all').prop('checked', true);
			}
		});
	}
	/* ================ #NUMBER-FORMAT =================== */
	if($('.number-format').length){
		$('.number-format').number(true, 0);
		$('.number-format').live('keydown', function(){
			$('.number-format').number(true, 0);
		});
		$('.number-format').live('change', function(){
			$('.number-format').number(true, 0);
		});
	}
});