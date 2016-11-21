		</main>
        <footer>
			<script src="<?php echo base_url('js/jquery.plugin.min.js'); ?>"></script>
			<script src="<?php echo base_url('js/jquery.maxlength.min.js'); ?>"></script>
			<script src="<?php echo base_url('js/vendor/foundation.min.js'); ?>"></script>
            <script src="<?php echo base_url('js/repeater.min.js'); ?>"></script>
            <script src="<?php echo base_url('js/foundation-datepicker.min.js'); ?>"></script>
            <script src="<?php echo base_url('js/uploader-0.5ci.js'); ?>"></script>
			<script>
				$(document).foundation();
				$(document).ready(function(){
                    if($('#uploader').length){
                        $('#uploader').uploader({
                            location: '<?php echo site_url(); ?>',
                            uploadURL: '<?php echo site_url('ajax/upload'); ?>',
                            deleteURL: '<?php echo site_url('ajax/delete'); ?>'
                        });
                    }
                    if($('.repeater').length){
                        $('.repeater').repeater();
                    }
                    if($('.datepickerinput').length){
                        $('.datepickerinput').fdatepicker({
                            'format': 'dd/mm/yyyy'
                        })
                    }
					if($('.decline_form_button').length){
						$('.decline_form_button').click(function(){
							var form = $(this).closest('footer').find('.decline_form');
							$('.decline_form').hide();
							form.slideDown();
						});
					}
					if($('.maxlength').length){
						$('.maxlength').each(function(){
							$(this).maxlength({max: $(this).data('maxlength')});
						});
					}
				});
			</script>
		</footer>
	</body>
</html>