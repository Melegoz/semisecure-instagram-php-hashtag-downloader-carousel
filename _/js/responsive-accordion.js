//	Responsive Accordion v1.2, Copyright 2014, Joe Mottershaw, https://github.com/joemottershaw/
//	============================================================================================

	$(document).ready(function() {
		$('.acc').each(function() {
			// Set Expand/Collapse Icons
				$('.acc-minus', this).hide();

			// Hide panels
				$('.acc-panel', this).hide();

			// Bind the click event handler
				$('.acc-head', this).click(function(e) {
					// Get elements
						var	thisAccordion = $(this).parent().parent(),
							thisHead = $(this),
							thisPlus = thisHead.find('.acc-plus'),
							thisMinus = thisHead.find('.acc-minus'),
							thisPanel = thisHead.siblings('.acc-panel');

					// Reset all plus/mins symbols on all headers
						thisAccordion.find('.acc-plus').show();
						thisAccordion.find('.acc-minus').hide();

					// Reset all head/panels active statuses except for current
						thisAccordion.find('.acc-head').not(this).removeClass('active');
						thisAccordion.find('.acc-panel').not(this).removeClass('active').slideUp();

					// Toggle current head/panel active statuses
						if (thisHead.hasClass('active')) {
							thisHead.removeClass('active');
							thisPlus.show();
							thisMinus.hide();
							thisPanel.removeClass('active').slideUp();
							thisAccordion.removeClass('marginbottom');
						} else {
							thisHead.addClass('active');
							thisPlus.hide();
							thisMinus.show();
							thisPanel.addClass('active').slideDown();
							thisAccordion.addClass('marginbottom');
						}
				});
		});
	});