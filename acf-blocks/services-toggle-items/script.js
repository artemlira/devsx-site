jQuery(document).ready(function ($) {

    // Спочатку відкриті ВСІ
    $('.accordion-item').addClass('active').find('.accordion-content').show();

    $('.what-we-do .accordion-header').on('click', function () {

        var $accordionItem = $(this).closest('.accordion-item');
        var $accordionContent = $accordionItem.find('.accordion-content');

        // Перемикаємо активний стан (закрити або відкрити)
        if ($accordionItem.hasClass('active')) {

            $accordionContent.stop().slideUp(300);
            $accordionItem.removeClass('active');

        } else {

            $accordionContent.stop().slideDown(300);
            $accordionItem.addClass('active');

        }

    });

});